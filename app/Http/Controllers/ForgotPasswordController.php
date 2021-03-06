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
                'email.required'=>'send_mail_null'
            ]); 

        $username = $request->email;
        $temp = Users::where('username',$username)->get();

        try{

            if(empty(count($temp))){
                return redirect('sendMail')->with('thongbao',"not_found_email");
            }
            else{

                $this->deleteToken($username);

                $length = 50;
                $token = bin2hex(random_bytes($length));

                // save token and username in table password_resets
                $password_resets = new Password_Resets;
                $password_resets->email = $username;
                $password_resets->token = $token;
                $password_resets->created_at = date('Y-m-d H:i:s');
                $password_resets->save();

                Mail::to($username)->send(new UserEmail($token));
            
                return redirect('login')->with('send','send_success');
            }
        }
        catch(\Exception $e){
            return redirect('sendMail')->with('thongbao',"no_internet");
        }
        
        
    }

    public function deleteToken($email){
        $token = Password_Resets::where('email',$email)->delete();
    }
}
