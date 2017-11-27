<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;

class mailController extends Controller
{
    //
    public function send(){
    	 Mail::send(['text'=>'mail'],['name','Admin'],function($message){
            $message->to('pdvan.it@gmail.com','To Dinh Van')->subject('Test Email');
            $message->from('pdvan.it@gmail.com','Phan Van');
        });
    }
}
