<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\UserEmail;

class mailController extends Controller
{
    //
    public function send(){
    	  $data = array('name'=>"Phan Dinh Van");
   
        Mail::send(['text'=>'emails/sendemail'], $data, function($message) {
            $message->to('pdvan.it@gmail.com', 'To Dinh Van')->subject
                ('Laravel Basic Testing Mail');
            $message->from('pdvan.it@gmail.com','Phan Van');
        });
          echo "Basic Email Sent. Check your inbox.";
    }
}
