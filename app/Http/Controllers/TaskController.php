<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Project;

class TaskController extends Controller
{
    //
    public function getList(){
    	$task = Task::all();
    	return view('admin/task/list',['task'=>$task]);
    }

    public function getAdd(){
    	$project = Project::all();
    	return view('admin/task/add',['project'=>$project]);
    }

    public function postAdd(Request $request){
    	$this->validate($request,
    		[
    			'taskname'=>'required|min:3',
    			'project_id'=>'required'
    		],
    		[
    			'taskname.required'=>'Please enter task name',
    			'taskname.min'=>'Task name has at least 3 characters',
    			'project_id.required'=>'Please select project name'
    		]);

    	$taskname = new Task;
    	$taskname->taskname = $request->taskname;
    	$taskname->project_id = $request->project_id;
    	$taskname->comments = $request->comments;
    	$taskname->save();

    	return redirect('admin/task/add')->with('thongbao','You add success');
    }
}
