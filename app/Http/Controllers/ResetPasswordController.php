<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Users;
use App\Password_Resets;
use Carbon\Carbon; 

class ResetPasswordController extends Controller
{
    //
    // get change pass when send mail (forgot password)
    public function getResetPass($token){
        $username = Password_Resets::where('token',$token)->get();

        if($username->isEmpty()){
            return redirect('sendMail')->with('thongbao','username_null');
        }
        return view('pages.change_password',['username'=>$username,'token'=>$token]);
    }

    // // post change pass when send mail (forgot password)
    public function postResetPass(Request $request){

        $this->validate($request,
            [
                'password'=>'required|min:3|max:32',
                // same-> kiem tra passwordAgain co giong voi password
                'passwordAgain'=>'required|same:password'
            ],
            [
                'password.required'=>'new_password',
                'password.min'=>'password_min',
                'password.max'=>'password_max',
                'passwordAgain.required'=>'confirm_password',
                'passwordAgain.same'=>'confirmation_password'
            ]);

        $temp = Users::join('password_resets','password_resets.email','=','users.username')
                    ->select('users.username','users.password','password_resets.created_at')
                    ->where('password_resets.token',$request->token)
                    ->where('password_resets.email',$request->username)->first();

        $date_now = Carbon::now();
        $date_old = new Carbon();
        $date_old = Carbon::parse($temp->created_at);
        $date_old->addMinutes(30);
        
        // check token qua 30 minutes
        if($date_old > $date_now){
            // die('Now: '.$date_now.'  Old: '.$date_old.' Ok! Change pass.');
            $user = Users::where('username',$request->username)->first();
            $user->password = bcrypt($request->password);
            $user->save();

            // $this->deleteToken($request->username);

            return redirect('login')->with('send','Change password success.');

        }
        else{
            // die('Qua 30 phut roi, khong change duoc');
            return redirect('sendMail')
                        ->with('thongbao',"expired");
        }
    }

    // public function deleteToken($email){
    //     $token = Password_Resets::where('email',$email)->delete();
    // }
}
