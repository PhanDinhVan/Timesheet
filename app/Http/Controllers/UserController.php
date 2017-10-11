<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Users;

class UserController extends Controller
{
    //
    public function getList(){
        $user = Users::all();
        return view('admin.user.list',['user'=>$user]);
    }

   public function getAdd(){
        //$user = Users::all();
        return view('admin.user.add');
    }
}
