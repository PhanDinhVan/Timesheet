<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Project;

class TaskController extends Controller
{
    //
    public function getList(){
    	$task = Task::groupBy('tasks.project_id')->groupBy('tasks.taskname')->groupBy('tasks.availability')->get();
    	return view('admin/task/list',['task'=>$task]);
    }

    public function getAdd(){
    	$project = Project::all();
    	return view('admin/task/add',['project'=>$project]);
    }

    public function postAdd(Request $request){

        // Check taskname and project name have exits?
        $temp = Task::where('taskname',$request->taskname)->where('project_id',$request->project_id)->get();
        if($temp->isEmpty()){

            $taskname = new Task;
            $taskname->taskname = $request->taskname;
            $taskname->project_id = $request->project_id;
            $taskname->comments = $request->comments;
            $taskname->availability = $request->availability;
            $taskname->save();

            return redirect('admin/task/list')->with('thongbao','You add success');
            
        }else{
            return redirect('admin/task/add')->with('error','taskname_exits');
        }
    	
    }

    public function getEdit($id){
        $task = Task::find($id);
        $project = Project::all();
        return view('admin/task/edit',['task'=>$task,'project'=>$project]);
    }

    public function postEdit(Request $request, $id){

        // Check taskname and project name have exits?
        $temp = Task::where('taskname',$request->taskname)->where('project_id',$request->project_id)->get();
        if($temp->isEmpty()){

            $task = Task::find($id);
            $task->taskname = $request->taskname;
            $task->project_id = $request->project_id;
            $task->comments = $request->comments;
            $task->availability = $request->availability;
            $task->save();

            return redirect('admin/task/list')->with('thongbao','You edit success');
            
        }else{

            // $check_task = Task::where('comments',$request->comments)->where('availability',$request->availability)->get();
            // if($check_task->isEmpty()){
            //     $task = Task::find($id);
            //     $task->taskname = $request->taskname;
            //     $task->project_id = $request->project_id;
            //     $task->comments = $request->comments;
            //     $task->availability = $request->availability;
            //     $task->save();

            //     return redirect('admin/task/list')->with('thongbao','You edit success');
            // }

            $task = Task::find($id);
            if($task->comments != $request->comments || $task->availability != $request->availability){
                
                $task->comments = $request->comments;
                $task->availability = $request->availability;
                $task->save();

                return redirect('admin/task/list')->with('thongbao','You edit success');
            }

            return redirect('admin/task/edit/'.$id)->with('error','taskname_exits');
            
        }
        
    }

    public function getDelete($id){
        $task = Task::find($id);
        $task->delete();

        return redirect('admin/task/list')->with('thongbao','You delete success');
    }
}
