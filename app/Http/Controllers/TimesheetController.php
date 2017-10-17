<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Task;

class TimesheetController extends Controller
{
    //
    public function getTimesheet(){
    	$project = Project::all();
    	$task = Task::all();
    	return view('pages.timesheet',['project'=>$project,'task'=>$task]);
    }
}
