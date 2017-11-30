<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Users;
use App\Password_Resets;

class ResetPasswordController extends Controller
{
    //
    // get change pass when send mail (forgot password)
    public function getResetPass($token){
        $username = Password_Resets::where('token',$token)->get();
        return view('pages.change_password',['username'=>$username,'token'=>$token]);
    }

    // // post change pass when send mail (forgot password)
    public function postResetPass(Request $request){

        $this->validate($request,
            [
                'username'=>'required|email',
                'password'=>'required|min:3|max:32',
                // same-> kiem tra passwordAgain co giong voi password
                'passwordAgain'=>'required|same:password'
            ],
            [
                'username.required'=>'Please enter your username',
                'username.email'=>'Username invalidate',
                'password.required'=>'Please enter your password',
                'password.min'=>'Password must be at least 3 characters',
                'password.max'=>'Passwords of up to 32 characters',
                'passwordAgain.required'=>'Please enter your password again',
                'passwordAgain.same'=>'The password confirmation does not match.'
            ]);

        $temp = Users::join('password_resets','password_resets.email','=','users.username')
                    ->select('users.username','users.password')
                    ->where('password_resets.token',$request->token)
                    ->where('password_resets.email',$request->username)->first();

        if(empty(count($temp))){

            $check_user = Users::where('username',$request->username)->first();

            if($check_user){
                return redirect('sendMail')
                            ->with('thongbao',"You have made a change of password, please send again mail.");
            }
            else{
                return redirect('resetPass/'.$request->token)
                            ->with('thongbao',"We can't find a user with that e-mail address.");
            }
        }
        else{

            $user = Users::where('username',$request->username)->first();
            $user->password = bcrypt($request->password);
            $user->save();

            $this->deleteToken($request->username);

            return redirect('login')->with('send','Change password success.');
        }
    }

    public function deleteToken($email){
        $token = Password_Resets::where('email',$email)->delete();
    }
}
