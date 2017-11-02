<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// import thu vien nay dung de login
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    //
    // Ham login with admin
    public function getLoginAdmin(){
        return view('admin.login');
    }

    public function postLoginAdmin(Request $request){
 		
        $this->validate($request,
            [
                'email'=>'required',
                'password'=>'required'
            ],
            [
                'email.required'=>'Email is not empty',
                'password.required'=>'Passwords is not empty'
            ]); 


        if(Auth::attempt(['username'=>$request->email, 'password'=>$request->password])){
            return redirect('admin/user/list');
        }else{
            return redirect('admin/login')->with('thongbao','Login unsuccessful...!!!');
        }
    }

    // Ham logout
    public function getLogoutAdmin(){

    	//$users->rememberToken();
        Auth::logout();
        return redirect('admin/login');
    }

    function getLoginUser(){
        return view('pages.login');
    }

    function postLoginUser(Request $request){

        $this->validate($request,
            [
                'email'=>'required',
                'password'=>'required'
            ],
            [
                'email.required'=>'Email is not empty',
                'password.required'=>'Passwords is not empty'
            ]); 
        
        if(Auth::attempt(['username'=>$request->email, 'password'=>$request->password])){
            return redirect('user/timesheet');
        }else{
            return redirect('login')->with('thongbao','Login unsuccessful...!!!');
        }
    }

    function getLogoutUser(){
        Auth::logout();
        return redirect('login');
    }
}

