<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee_Types;

class EmployeeTypeController extends Controller
{
    //
    public function getList(){
    	$employee_type = Employee_Types::all();
    	return view('admin/employee_type/list',['employee_type'=>$employee_type]);
    }
}
