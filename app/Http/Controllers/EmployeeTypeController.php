<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee_Types;

class EmployeeTypeController extends Controller
{
    //
    public function getList(){
    	$employee_type = Employee_Types::paginate(10);
    	return view('admin/employee_type/list',['employee_type'=>$employee_type]);
    }

    public function getAdd(){
    	return view('admin/employee_type/add');
    }

    public function postAdd(Request $request){
    	$this->validate($request,
    		[
    			'emp_type'=>'required|min:2'
    		],
    		[
    			'emp_type.required'=>'Please enter employee type',
    			'emp_type.min'=>'Employee types minimum 2 characters'
    		]);

    	$employee_type = new Employee_Types;
    	$employee_type->type = $request->emp_type;
    	$employee_type -> save();

    	return redirect('admin/employee_type/add')->with('thongbao','You add success');
    }

    public function getEdit($id){
    	$employee_type = Employee_Types::find($id);
    	return view('admin/employee_type/edit',['employee_type'=>$employee_type]);
    }

    public function postEdit(Request $request, $id){
    	$this->validate($request,
    		[
    			'emp_type'=>'required|min:2|unique:employee_types,type'
    		],
    		[
    			'emp_type.required'=>'Please enter employee type',
    			'emp_type.min'=>'Employee types minimum 2 characters',
    			'emp_type.unique'=>'Employee types is exits'
    		]);
    	$employee_type = Employee_Types::find($id);
    	$employee_type->type = $request->emp_type;
    	$employee_type -> save();

    	return redirect('admin/employee_type/edit/'.$id)->with('thongbao','You edit success');
    }

    public function getDelete($id){
        $user = Employee_Types::find($id);
        $user->delete();

        return redirect('admin/employee_type/list')->with('thongbao','You delete success');
    }
}
