<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee_Types;

class EmployeeTypeController extends Controller
{
    //
    public function getList(){
    	$employee_type = Employee_Types::get();
    	return view('admin/employee_type/list',['employee_type'=>$employee_type]);
    }

    public function getAdd(){
    	return view('admin/employee_type/add');
    }

    public function postAdd(Request $request){

    	$employee_type = new Employee_Types;
    	$employee_type->type = $request->emp_type;
    	$employee_type -> save();

    	return redirect('admin/employee_type/list')->with('thongbao','You add success');
    }

    public function getEdit($id){
    	$employee_type = Employee_Types::find($id);
    	return view('admin/employee_type/edit',['employee_type'=>$employee_type]);
    }

    public function postEdit(Request $request, $id){
    	$this->validate($request,
    		[
    			'emp_type'=>'unique:employee_types,type'
    		],
    		[
    			'emp_type.unique'=>'employee_exits'
    		]);
    	$employee_type = Employee_Types::find($id);
    	$employee_type->type = $request->emp_type;
    	$employee_type -> save();

    	return redirect('admin/employee_type/list')->with('thongbao','You edit success');
    }

    public function getDelete($id){
        $user = Employee_Types::find($id);
        $user->delete();

        return redirect('admin/employee_type/list')->with('thongbao','You delete success');
    }
}
