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

    // public function getTimesheet_Edit($id){
    //     $timesheet = Timesheet::find($id);
    //     $project_edit = Project::all();
    //     $task_edit = Task::all();
    //     $string = "";
    //     $project_id = "";
    //     $projectname_edit = "";

    //     foreach ($timesheet as $value) {
    //         $string = $value->task_id;
    //     }

    //     // foreach ($task_edit as $value) {
    //     //     if($value->id == $string){
    //     //         $project_id = $value->project_id;
    //     //     }
    //     // }

    //     // foreach ($project_edit as $value) {
    //     //     if($value->id == $project_id){
    //     //         $projectname_edit = $value->name;
    //     //     }
    //     // }
    //     echo $string;
    // }
}
