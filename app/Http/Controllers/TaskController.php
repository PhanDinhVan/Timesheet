<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Project;

class TaskController extends Controller
{
    //
    public function getList(){
    	$task = Task::paginate(10);
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

        // Check taskname and project name have exits?
        $temp = Task::where('taskname',$request->taskname)->where('project_id',$request->project_id)->get();
        if($temp->isEmpty()){

            $taskname = new Task;
            $taskname->taskname = $request->taskname;
            $taskname->project_id = $request->project_id;
            $taskname->comments = $request->comments;
            $taskname->availability = 1;
            $taskname->save();

            return redirect('admin/task/add')->with('thongbao','You add success');
            
        }else{
            return redirect('admin/task/add')->with('error','Taskname and project name is exits');
        }
    	
    }

    public function getEdit($id){
        $task = Task::find($id);
        $project = Project::all();
        return view('admin/task/edit',['task'=>$task,'project'=>$project]);
    }

    public function postEdit(Request $request, $id){
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

        // Check taskname and project name have exits?
        $temp = Task::where('taskname',$request->taskname)->where('project_id',$request->project_id)->get();
        if($temp->isEmpty()){

            $task = Task::find($id);
            $task->taskname = $request->taskname;
            $task->project_id = $request->project_id;
            $task->comments = $request->comments;
            $task->availability = $request->availability;
            $task->save();

            return redirect('admin/task/edit/'.$id)->with('thongbao','You edit success');
            
        }else{
            return redirect('admin/task/edit/'.$id)->with('error','Taskname and project name is exits');
        }
        
    }


    public function getDelete($id){
        $task = Task::find($id);
        $task->delete();

        return redirect('admin/task/list')->with('thongbao','You delete success');
    }
}
