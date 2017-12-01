<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Password_Resets;

class UserEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $token;
    public $lastname;
    public function __construct($token)
    {
        //
        $this->token= $token;
        $user = Password_Resets::join('users','users.username','=','password_resets.email')
                                    ->select('users.lastname')
                                    ->where('token',$token)->first();
        $this->lastname = $user->lastname;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Reset Password')->view('emails.sendemail');
    }
}
