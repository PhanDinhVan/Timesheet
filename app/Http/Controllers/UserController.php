<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Users;
use App\Employee_Types;

class UserController extends Controller
{
    //
    public function getList(){
        $user = Users::all();
        return view('admin.user.list',['user'=>$user]);
    }

    public function getAdd(){
        $employee_types = Employee_Types::all();
        return view('admin.user.add',['employee_types'=>$employee_types]);
    }

    public function postAdd(Request $request){
        $this->validate($request,
            [
            	'firstname'=>'required',
            	'lastname'=>'required',
                'start_date'=>'required',
                'end_date'=>'required',
                // kiem tra email k rong, k duoc trung trong table users voi field email, no co phai la email?
                'email'=>'required|unique:users,username|email',
                'password'=>'required|min:3|max:32',
                // same-> kiem tra passwordAgain co giong voi password
                'passwordAgain'=>'required|same:password'
            ],
            [
            	'firstname.required'=>'Please enter your firstname',
            	'lastname.required'=>'Please enter your lastname',
                'start_date.required'=>'Please select start date',
                'end_date.required'=>'Please select end date',
                'email.required'=>'Please enter your username',
                'email.unique'=>'Username is exits',
                'email.email'=>'Username invalidate',
                'password.required'=>'Please enter your password',
                'password.min'=>'Password must be at least 3 characters',
                'password.max'=>'Passwords of up to 32 characters',
                'passwordAgain.required'=>'Please enter your password again',
                'passwordAgain.same'=>'Passwords again not like password'
            ]);

        $user = new Users;
        // $user->name = $request->name;
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->username = $request->email;
        $user->start_date = $request->start_date;
        $user->end_date = $request->end_date;
        // lay ngay hien tai
        // $user->end_date = date('Y-m-d H:i:s');
        $user->employee_type_id = $request->employee_type_id;
        $user->password = bcrypt($request->password);
        $user->position = $request->quyen;
        $user->status = 1;
        $user->save();

        return redirect('admin/user/add')->with('thongbao','You add success');

    }

    public function getEdit($id){
	    $user = Users::find($id);
	    $employee_types = Employee_Types::all();
	    return view('admin/user/edit',['user'=>$user,'employee_types'=>$employee_types]);
    }

    public function postEdit(Request $request, $id){
    	$this->validate($request,
            [
                'firstname'=>'required',
                'lastname'=>'required',
                'start_date'=>'required',
                'end_date'=>'required'
            ],
            [
                'firstname.required'=>'Please enter your firstname',
                'lastname.required'=>'Please enter your lastname',
                'start_date.required'=>'Please select start date',
                'end_date.required'=>'Please select end date'
            ]);

        $user = Users::find($id);
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->position = $request->quyen;
        $user->start_date = $request->start_date;
        $user->end_date = $request->end_date;
        $user->employee_type_id = $request->employee_type_id;

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

        return redirect('admin/user/edit/'.$id)->with('thongbao','You edit success');
    }

    public function getDelete($id){
        $user = Users::find($id);
        $user->delete();

        return redirect('admin/user/list')->with('thongbao','You delete success');
    }

    
}
