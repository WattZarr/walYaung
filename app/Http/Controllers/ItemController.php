<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //add item
    public function addItem(){
        $user = Auth::user();
        return view('homePage.add-item')->with(['user' => $user]);
    }

    public function add(REQUEST $request){
        //validation
        $validator = $this->addItemValidator($request);

        if ($validator->fails()) {
            return redirect('add-item')
                        ->withErrors($validator)
                        ->withInput();
        }
        //end validation

        //adding data
        $file = $request->file('image');
        $filename = uniqid()."_".$file->getClientOriginalName();
        $file->move(public_path().'/items/',$filename);
        $data = [
            'item_name' => $request->name,
            'image' => $filename,
            'price' => $request->price,
            'description' => $request->description,
            'category' => $request->category,
            'user_id' => $request->user_id,
        ];
        $user = Auth::user();

        Item::create($data);

        return redirect()->route('add-item')->with(['add' => 'ပစ္စည်းကို အရောင်းစာရင်းတွင် ထည့်သွင်းထားသည်။','user' => $user]);
    }

    //add-item validator
    public function addItemValidator($request){

        return Validator::make($request->all(), [
            'name' => 'required',
            'image' => 'required|image|mimes:png,jpg,jpeg|max:5000',
            'price' => 'required',
            'description' => 'required',
            'category' => 'required',
        ]);
    }

    //item detail
    public function detail($id){
        $user = Auth::user();

        $item = Item::where('items.id',$id)
                    ->join('users','users.id','items.user_id')
                    ->get();
        $cgid = $item[0]->category;

        $sitems = Item::where('category',$cgid)
                        ->where('id','!=',$id)
                        ->get();

        return view('homePage/item/item-detail')->with(['user' => $user,'item' => $item,'sitems' => $sitems]);
    }

    //item filter
    public function filter($id){
        $user = Auth::user();
        $items = Item::where('category',$id)->get();

        return view('homePage.index')->with(['items'=>$items,'user' => $user]);
    }

    public function itemList(){
        $user = Auth::user();
        $items = Item::where('user_id',$user->id)->get();
        return view('homePage.item.item-list')->with(['user' => $user,'items'=>$items]);
    }

    //edit item
    public function editPage($id){
        $user = Auth::user();
        $item = Item::where('id',$id)->get();

        return view('homePage.item.edit')->with(['user'=>$user,'item' => $item]);
    }

    public function edit(REQUEST $request){

        //validation
        $validator = $this->editItemValidator($request);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        //end validation

        $dbData = Item::where('id',$request->item_id)->get();
        $dbImage = $dbData[0]->image;

        if($request->image == null){
            $data = [
                'item_name' => $request->name,
                'image' => $dbImage,
                'price' => $request->price,
                'description' => $request->description,
                'category' => $request->category,
                'user_id' => $request->user_id,
            ];
        }
        else{
            $file = $request->file('image');
            $filename = uniqid()."_".$file->getClientOriginalName();
            $file->move(public_path().'/items/',$filename);
            $data = [
                'item_name' => $request->name,
                'image' => $filename,
                'price' => $request->price,
                'description' => $request->description,
                'category' => $request->category,
                'user_id' => $request->user_id,
            ];

            if(File::exists(public_path().'/items/'.$dbImage)){
                File::delete(public_path().'/items/'.$dbImage);
            }
        }

        Item::where('id',$request->item_id)->update($data);

        return redirect()->route('item/item-list')->with(['edit'=>'ပစ္စည်းဒေတာများကို ပြောင်းလဲပြီးပါပြီ။']);

    }

    //add-item validator
    public function editItemValidator($request){

        return Validator::make($request->all(), [
            'name' => 'required',
            'image' => 'image|mimes:png,jpg,jpeg|max:5000',
            'price' => 'required',
            'description' => 'required',
            'category' => 'required',
        ]);
    }

    //sold item
    public function sold($id){
        Item::where('id',$id)->update(['is_sold'=>1]);
        return redirect()->back()->with(['sold'=>'သင့်ပစ္စည်းကို ရောင်းပြီးသည့်အရာအဖြစ် ပြောင်းလဲထားသည်။']);
    }

    //sold item list
    Public function soldItemList($id){
        $user = Auth::user();
        $items = Item::where('is_sold',1)
                     ->where('user_id',$id)->get();

        return view('homePage.item.sold-item-list')->with(['user'=>$user,'items'=>$items]);
    }

    //not sold item list
    public function notSoldItemList($id){
        $user = Auth::user();
        $items = Item::where('is_sold',0)
                     ->where('user_id',$id)->get();

        return view('homePage.item.not-sold-item-list')->with(['user'=>$user,'items'=>$items]);
    }


}
