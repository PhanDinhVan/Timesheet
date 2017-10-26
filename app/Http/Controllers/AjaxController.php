<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Project;

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
}
