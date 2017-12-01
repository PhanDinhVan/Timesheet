<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Users;
use Mail;
use App\Mail\UserEmail;
use App\Password_Resets;

class ForgotPasswordController extends Controller
{
    //
    // get form send mail when forgot password
    public function getSendMail(){
        return view('pages.forgot_password');
    }

    // post form send mail when forgot password
    public function postSendMail(Request $request){

        $this->validate($request,
            [
                'email'=>'required'
            ],
            [
                'email.required'=>'Email is not empty'
            ]); 

        $username = $request->email;
        $temp = Users::where('username',$username)->get();
        
        if(empty(count($temp))){

            return redirect('sendMail')->with('thongbao',"We can't find a user with that e-mail address.");
        }
        else{

            $length = 50;
            $token = bin2hex(random_bytes($length));

            // save token and username in table password_resets
            $password_resets = new Password_Resets;
            $password_resets->email = $username;
            $password_resets->token = $token;
            $password_resets->created_at = date('Y-m-d H:i:s');
            $password_resets->save();

            Mail::to($username)->send(new UserEmail($token));
        
            return redirect('login')->with('send','We have send email to you. Please check your inbox.');
        }
    }
}
