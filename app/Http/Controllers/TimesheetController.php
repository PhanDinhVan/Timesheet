<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Task;
use App\Timesheet;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class TimesheetController extends Controller
{
    //
    public function getTimesheet(){
    	$create_date = date('Y-m-d');
    	// $time_entries = Timesheet::find($create_date);
    	$time_entries = Timesheet::where('create_date',$create_date)->get();
    	// $time_entries = Timesheet::all();
    	// die($q);
    	$project = Project::all();
    	$task = Task::all();
    	return view('pages.timesheet',['project'=>$project,'task'=>$task,'time_entries'=>$time_entries]);
    }

    public function getTimesheet2(Request $request){
        $data = $request->x;
        $time_entries = Timesheet::where('create_date',$data)->get();
        
        $project = Project::all();
        $task = Task::all();

        echo($time_entries);
        // echo($project);
        // echo($task);
        
    }


    public function postAddTimesheet(Request $request){
    	$this->validate($request,
    		[
    			'project_id'=>'required',
    			'task_id'=>'required',
    			'user_id'=>'required',
    			'working_time'=>'required',
    			'start_date'=>'required',
    			'note'=>'required|min:5|max:500'
    		],
    		[
    			'project_id.required'=>'Please select project name',
    			'task_id.required'=>'Please select task name',
    			'user_id.required'=>'Please select user name',
    			'working_time.required'=>'Please enter working time',
    			'start_date.required'=>'Please select start date',
    			'note.required'=>'Please enter note',
    			'note.min'=>'Enter at least 3 characters',
    			'note.max'=>'Enter up to 500 characters'
    		]);

    	$time_entries = new Timesheet;

    	$time_entries->task_id = $request->task_id;
    	$time_entries->user_id = $request->user_id;
    	$time_entries->working_time = $request->working_time;
    	$time_entries->start_date = $request->start_date;
    	$time_entries->note = $request->note;
    	$time_entries->overtime = 0;
    	$time_entries->create_date = date('Y-m-d');

    	$time_entries->save();

    	return redirect('timesheet')->with('thongbao','Add timesheet success');
    	
    }

    public function getFullCalendar(){
    	return view('pages.fullcalendar');
    }
}
