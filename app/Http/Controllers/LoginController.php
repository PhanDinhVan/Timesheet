<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// import thu vien nay dung de login
use Illuminate\Support\Facades\Auth;
use App\Users;
use App\Employee_Types;


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
                'email.required'=>'email',
                'password.required'=>'password'
            ]); 


        if(Auth::attempt(['username'=>$request->email, 'password'=>$request->password])){
            return redirect('admin/user/list');
        }else{
            return redirect('admin/login')->with('thongbao','incorrect');
        }
    }

    // Ham logout
    public function getLogoutAdmin(){

    	//$users->rememberToken();
        Auth::logout();
        return redirect('admin/login');
    }

    public function getLoginUser(){
        return view('pages.login');
    }

    public function postLoginUser(Request $request){

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

    public function getLogoutUser(){
        Auth::logout();
        return redirect('login');
    }

    public function getSettingUser(){
        $id = Auth::user()->id;
        $user = Users::find($id);
        $employee_types = Employee_Types::all();
        return view('user.setting',['user'=>$user,'employee_types'=>$employee_types]);
    }

    public function postSettingUser(Request $request){
        $id = Auth::user()->id;
        $this->validate($request,
            [
                'firstname'=>'required',
                'lastname'=>'required'
            ],
            [
                'firstname.required'=>'Please enter your firstname',
                'lastname.required'=>'Please enter your lastname',
            ]);

        $user = Users::find($id);
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;

        if($request->changePassword == "on"){
            $this->validate($request,
            [
                'password'=>'required|min:3|max:32',
                // same-> kiem tra passwordAgain co giong voi password
                'passwordAgain'=>'required|same:password'
            ],
            [
                'password.required'=>'Please enter your password',
                'password.min'=>'Password must be at least 3 characters',
                'password.max'=>'Passwords of up to 32 characters',
                'passwordAgain.required'=>'Please enter your password again',
                'passwordAgain.same'=>'Passwords again not like password'
            ]);

            $user->password = bcrypt($request->password);
        }

        $user->save();
        return redirect('user/setting')->with('thongbao','You edit success');
    }
}

