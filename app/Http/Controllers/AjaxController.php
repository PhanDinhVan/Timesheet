<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Project;
use App\Timesheet;

class AjaxController extends Controller
{
    // Dung de hien thi cac task dung voi cac project
    public function getTask($project_id){
        $task = Task::where('project_id',$project_id)->where('availability',1)->get();
        foreach ($task as $value) {
            echo "<option value='".$value->id."'>".$value->taskname."</option>";
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
    	$taskname = Task::where('id',$task_id)->get();
    	$string = "";
    	foreach ($taskname as $value) {
    		$string = $value->taskname;
    	}
    	echo $string;
    }

     // Dung de hien thi cac task dung voi cac project khi Edit timesheet
    // public function getTaskEdit2($project_id, $task_id){
    //     $task = Task::where('project_id',$project_id)->where('availability',1)->get();
    //     foreach ($task as $value) {
    //         // echo "<option value='".if($value->id == $task_id)."' selected>".$value->taskname."</option>";
    //         echo "<option". if($value->id == $task_id)."' selected'". " value='"$value->id."'>". $value->taskname."</option>";
    //     }
    // }

    public function getTaskNameEdit($task_id){
        $taskname = Task::where('id',$task_id)->get();
        $string = "";
        foreach ($taskname as $value) {
            echo "<option value='".$value->id."'>".$value->taskname."</option>";
        }
    }


    public function getProjectName($task_id){
        $taskname = Task::where('id',$task_id)->get();
        $project = Project::all();
        $string = "";
        $projectname = "";
        foreach ($taskname as $value) {
            $string = $value->project_id;
        }
        // echo $string;
        foreach ($project as $value) {
            if($value->id == $string){
                $projectname = $value->name;
            }
        }
        echo $projectname;
    }


    // get info timesheet when edit
    public function getEditTimesheet(Request $request){
        if($request->ajax()){
            $timesheet = Timesheet::find($request->id);
            return response($timesheet);
        }
    }

    // update timesheet when edit
    public function update(Request $request){
        if($request->ajax()){
            $timesheet = Timesheet::find($request->id);
            $timesheet['project_id']=$request['project_id_edit'];
            $timesheet['task_id']=$request['task_id_edit'];
            $timesheet['note']=$request['note_edit'];
            $timesheet['date_time_entries']=$request['date_time_entries'];
            $timesheet['overtime']=$request['overtime'];
            $timesheet['working_time']=$request['working_time_edit'];
            $timesheet->save();
            // $timesheet->update($request->all()); Laravel 5.5
            return response($timesheet);
        }
    }
}
