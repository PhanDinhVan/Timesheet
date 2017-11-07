<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Project;
use App\Timesheet;
use App\Permisson;

class Ajax_02Controller extends Controller
{
    // Dung de hien thi cac task dung voi cac project
    public function getTask($project_id){
        $task = Task::where('project_id',$project_id)->where('availability',1)->get();
        foreach ($task as $value) {
            echo "<option value='".$value->id."'>".$value->taskname."</option>";
        }
    }

    // show task name dung voi tung project when modal add first load
    // public function getTask2($user_id){
    //     $task = Task::join('permisson_users_projects','permisson_users_projects.project_id','=','tasks.project_id')->select('tasks.*','permisson_users_projects.user_id as user_id')->where('tasks.availability','=',1)->where('permisson_users_projects.user_id','=',$user_id)->get();
    //     // $task = Task::where('project_id',$project_id)->where('availability',1)->get();
    //     foreach ($task as $value) {
    //         echo "<option value='".$value->id."'>".$value->taskname."</option>";
    //     }
    // }

	public function postTimesheet(Request $r){
		if($r->ajax()){
		    $timesheet = new Timesheet();
		    $timesheet->project_id = $r->project_id;
		    $timesheet->task_id = $r->task_id;
		    $time_entries->user_id = Auth::user()->id;
		    $timesheet->note = $r->note;
		    $timesheet->working_time = $r->working_time;
		    $timesheet->date_time_entries = $r->date_time_entries;
		    $time_entries->overtime = 0;
		    $time_entries->create_date = date('Y-m-d');
		      
		    if($timesheet->save()){
		      return response(['msg'=>'inserted successfully']);
		    }	
	  	}
	}

	// Dung de hien thi cac task dung voi cac project khi Edit timesheet
    public function getTaskEdit($project_id){
        $task = Task::where('project_id',$project_id)->where('availability',1)->get();
        foreach ($task as $value) {
            echo "<option value='".$value->id."'>".$value->taskname."</option>";
        }
    }

    public function getTaskName($task_id){
    	$task = Task::where('id',$task_id)->get();
    	$taskname = "";
    	foreach ($task as $value) {
    		$taskname = $value->taskname;
    	}
    	echo $taskname;
    }

    // public function getProjectName($project_id){
    //     $project = Project::where('id',$project_id)->get();
        
    //     $projectname = "";
    //     foreach ($project as $value) {
    //             $projectname = $value->name;
    //     }
    //     echo $projectname;
    // }

    // get project name dung voi tung user name
    public function getProject_User($user_id){
        $project = Permisson::join('projects','projects.id','=','permisson_users_projects.project_id')->select('permisson_users_projects.*','projects.name as projectname','projects.id as project_ID')->where('user_id',$user_id)->get();
        foreach ($project as $value) {
            echo "<option value='".$value->project_ID."'>".$value->projectname."</option>";
        }
    }
}
