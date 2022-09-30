<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function index(REQUEST $request){
        $user = Auth::user();
        if($user != null){
            $id = $user->id;
            $items = Item::where('user_id','!=',$id)->get();
        }
        else{
            $items = Item::get();
        }

        //search
        if($request->ajax()){
            $result = '';


            $items = Item::where('item_name','LIKE','%'.$request->search.'%')
                ->orWhere('price','LIKE','%'.$request->search.'%')
                ->orWhere('description','LIKE','%'.$request->search.'%')
                ->get();

            if(!$request->search){
                $request = '';
            }
            else{
                foreach($items as $item){
                    $result .= "
                    <div class='col-6 col-md-4'>
                    <h4>Search Result</h4>
                      <a href='item/detail/$item->id' style='text-decoration:none;color:black'>
                        <div class='card mb-3 cg-card'>
                            <div class='card-body'>
                                <div>
                                    <img src='http://localhost:8000/items/$item->image' class='card-img'>
                                    <p class='fw-bolder card-text'>".$item->item_name."</p>
                                    <p class='card-text'>".$item->price." ကျပ်</p>
                                </div>
                            </div>
                        </div>
                      </a>
                    </div>
                    ";
                }
            }

            return response()->json($result);
        }

        return view("homePage/index")->with(['user' => $user,'items' => $items]);
    }
}
