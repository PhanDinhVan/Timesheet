<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Employee_Types;
use App\Customer;

class ProjectController extends Controller
{
    //
	public function getList(){
		$project = Project::get();
		return view('admin/project/list',['project'=>$project]);
	}

	public function getAdd(){
		$employee_type = Employee_Types::all();
		$customer = Customer::all();
		return view('admin/project/add',['employee_type'=>$employee_type,'customer'=>$customer]);
	}

	public function postAdd(Request $request){
		$this->validate($request,
			[
				'name'=>'unique:projects,name'
			],
			[
				'name.unique'=>'projectname_exits'
			]);

		$project = new Project;
		$project->name = $request->name;
		$project->start_date = $request->start_date;
		$project->end_date = $request->end_date;
		$project->department = $request->department;
		$project->status = $request->status;
		$project->customer_id = $request->customer_id;
		$project->save();

		return redirect('admin/project/add')->with('thongbao','You add success');
	}

	public function getEdit($id){
		$project = Project::find($id);
		$customer = Customer::all();
		$employee_type = Employee_Types::all();
		return view('admin/project/edit',['project'=>$project,'customer'=>$customer,'employee_type'=>$employee_type]);
	}

	public function postEdit(Request $request, $id){

		$project = Project::find($id);
		$project->name = $request->name;
		$project->start_date = $request->start_date;
		$project->end_date = $request->end_date;
		$project->department = $request->department;
		$project->status = $request->status;
		$project->customer_id = $request->customer_id;
		$project->save();

		return redirect('admin/project/edit/'.$id)->with('thongbao','You edit success');
	}

	public function getDelete($id){
        $user = Project::find($id);
        $user->delete();

        return redirect('admin/project/list')->with('thongbao','You delete success');
    }
}
