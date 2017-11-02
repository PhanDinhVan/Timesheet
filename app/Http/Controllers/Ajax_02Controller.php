<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Project;
use App\Timesheet;

class Ajax_02Controller extends Controller
{
    // Dung de hien thi cac task dung voi cac project
    public function getTask($project_id){
        $task = Task::where('project_id',$project_id)->where('availability',1)->get();
        foreach ($task as $value) {
            echo "<option value='".$value->id."'>".$value->taskname."</option>";
        }
    }

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
}
