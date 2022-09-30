<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function profile(){
        $user = Auth::user();
        return view('homePage.user.profile')->with(['user' => $user]);
    }

    //edit page
    public function editPage(){
        $user = Auth::user();
        return view('homePage.user.edit')->with(['user' => $user]);
    }

    //edit
    public function edit(REQUEST $request){
        //validation
        $validator = $this->userEditValidator($request);
        if ($validator->fails()) {
            return redirect('profile/edit')
                        ->withErrors($validator)
                        ->withInput();
        }
        //end validation
        $id = $request->user_id;
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ];

        User::find($id)->update($data);

        return redirect()->route('profile/edit')->with(['edit'=>'သင့်ပရိုဖိုင်အချက်အလက် ပြောင်းလဲသွားပါပြီ။']);
    }

    //user Edit validator
    public function userEditValidator($request){

        return Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);
    }

    //change password
    public function changePassword(){
        $user = Auth::user();
        return view('homePage.user.change-password')->with(['user' => $user]);
    }

    public function change(REQUEST $request){
        $user = Auth::user();
        //validation
        $validator = $this->passwordValidator($request);
        if ($validator->fails()) {
            return redirect('profile/change-password')
                        ->withErrors($validator)
                        ->withInput();
        }
        //end validation

        $userpw = $request->oldPassword;
        $dbpw = $user->password;
        $hashpw = Hash::make($request->confirmPassword);
        $data = [
            'password' => $hashpw,
        ];
        //check
        if (Hash::check($userpw,$dbpw)) {
                User::find($user->id)->update($data);
                return redirect()->route('profile/change-password')->with(['changePass'=>'စကားဝှက်ပြောင်းသွားပါပြီ။']);
           }
        else{
            return redirect()->route('profile/change-password')->with(['op'=>'Your old password is incorrect']);
        }
    }

    //change password validator
    public function passwordValidator($request){

        return Validator::make($request->all(), [
            'oldPassword' => 'required',
            'newPassword' => 'required|min:8',
            'confirmPassword' => 'required|same:newPassword',
        ]);
    }
}
