<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Task;
use App\Timesheet;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class Timesheet_02Controller extends Controller
{

    //
    public function getTimesheet(){
    	$create_date = date('Y-m-d');
    	// $time_entries = Timesheet::find($create_date);
    	$time_entries = Timesheet::where('date_time_entries',$create_date)->where('user_id',Auth::user()->id)->get();
    	// $time_entries = Timesheet::all();
    	// die($q);
    	$project = Project::all();
    	$task = Task::all();
    	return view('user.timesheet',['project'=>$project,'task'=>$task,'time_entries'=>$time_entries]);
    }

    // get timesheet khi edit datetime
    public function getTimesheet2(Request $request){
        $data = $request->create_date;
        $time_entries = Timesheet::where('date_time_entries',$data)->where('user_id',Auth::user()->id)->get();
        
        echo($time_entries);
    }

    public function postTimesheet(Request $r){
		if($r->ajax()){
		    $timesheet = new Timesheet();
		    $timesheet->project_id = $r->project_id;
		    $timesheet->task_id = $r->task_id;
		    $timesheet->user_id = Auth::user()->id;
		    $timesheet->note = $r->note;
		    $timesheet->working_time = $r->working_time;
		    $timesheet->date_time_entries = $r->date_time_entries;
		    $timesheet->overtime = 0;
		    $timesheet->create_date = date('Y-m-d');
		      
		    if($timesheet->save()){
		      return response(['msg'=>'inserted successfully']);
		    }	
	  	}
	}

	public function readByAjax(){
  		$timesheet = Timesheet::join('tasks','tasks.id','=','time_entries.task_id')
  					->join('projects','projects.id','=','tasks.project_id')
                    ->select('time_entries.*','tasks.taskname as taskname','projects.name as projectname')
                    ->where('time_entries.user_id','=',Auth::user()->id)
                    ->orderBy('time_entries.id','DESC')
                    ->limit(10)
                    ->get();
  		return view('user.readByAjax',compact('timesheet'));
	}

	public function deleteByAjax(Request $r){
		if($r->ajax()){
			$timesheet = Timesheet::destroy($r->id);
			return response(['id'=>$r->id]);
		}
	} 

	public function getEditAjax(Request $r){
		if($r->ajax()){
			return response(Timesheet::	find($r->id));
		}
	}

	public function updateByAjax(Request $r){
		if($r->ajax()){
			$timesheet = Timesheet::find($r->id);
			$timesheet->project_id = $r->project_id;
			$timesheet->task_id = $r->task_id;
			$timesheet->working_time = $r->working_time;
			$timesheet->overtime = $r->overtime;
			$timesheet->date_time_entries = $r->date_time_entries;
			$timesheet->note = $r->note;
			$timesheet->create_date = date('Y-m-d');
			$timesheet->save();
			
			return response(['msg'=>'update successfully']);
		}
	}
}
