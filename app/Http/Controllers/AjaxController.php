<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;

class AjaxController extends Controller
{
    // Dung de hien thi cac task dung voi cac project
    public function getTask($project_id){
        $task = Task::where('project_id',$project_id)->get();
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
}
