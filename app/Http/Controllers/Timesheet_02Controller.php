<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Task;
use App\Timesheet;
use App\Users;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class Timesheet_02Controller extends Controller
{

    //
    public function getTimesheet(Request $request){


    	$create_date = date('Y-m-d');
    	$time_entries = Timesheet::where('date_time_entries',$create_date)->where('user_id',Auth::user()->id)->get();
    	$project = Project::all();
    	$task = Task::all();
    	$users = Users::all();
    	return view('user.timesheet',['project'=>$project,'task'=>$task,'time_entries'=>$time_entries,'users'=>$users]);
    }


    public function postTimesheet(Request $r){
		if($r->ajax()){
			$position = Auth::user()->position;
		    $timesheet = new Timesheet();
		    $timesheet->project_id = $r->project_id;
		    $timesheet->task_id = $r->task_id;
		    $timesheet->user_id = ($position==1)? $r->user_id : Auth::user()->id;
		    $timesheet->note = $r->note;
		    $timesheet->working_time = ($position==1)? $r->working_time_admin : $r->working_time_users;
		    $timesheet->date_time_entries = $r->date_time_entries;
		    $timesheet->overtime = 0;
		    $timesheet->create_date = date('Y-m-d H:m:s');
		      
		    if($timesheet->save()){
		      return response(['msg'=>'inserted successfully']);
		    }	
	  	}
	}

	//get table timesheet
	public function readByAjax(){
		$id = Auth::user()->id;
		$users = Users::find($id);
		if($users->position == 1){
			$timesheet = Timesheet::join('tasks','tasks.id','=','time_entries.task_id')
  					->join('projects','projects.id','=','tasks.project_id')
  					->join('users','users.id','=','time_entries.user_id')
                    ->select('time_entries.*','tasks.taskname as taskname','projects.name as projectname','users.firstname as firstname','users.lastname as lastname','users.position as position')
                    ->where('time_entries.date_time_entries','=',date('Y-m-d'))
                    ->orderBy('time_entries.id','DESC')
                    ->paginate(50);
		}
		else{

	  		$timesheet = Timesheet::join('tasks','tasks.id','=','time_entries.task_id')
	  					->join('projects','projects.id','=','tasks.project_id')
	                    ->select('time_entries.*','tasks.taskname as taskname','projects.name as projectname')
	                    ->where('time_entries.user_id','=',$id)->where('time_entries.date_time_entries','=',date('Y-m-d'))
	                    ->orderBy('time_entries.id','DESC')
	                    ->paginate(50);
        }

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

			$position = Auth::user()->position;

			if($position==1){
				$h1 = strtotime($r->overtime_admin_edit);
				$hour = date("H", $h1);
				$minute = date("i", $h1);
				$overtime = $hour*60 + $minute;
				
				$h2 = strtotime($r->working_time_admin_edit);
				$hour = date("H", $h2);
				$minute = date("i", $h2);
				$working_time = $hour*60 + $minute;
			}
			else{

				$h1 = strtotime($r->overtime_users_edit);
				$hour = date("H", $h1);
				$minute = date("i", $h1);
				$overtime = $hour*60 + $minute;

				$h2 = strtotime($r->working_time_users_edit);
				$hour = date("H", $h2);
				$minute = date("i", $h2);
				$working_time = $hour*60 + $minute;
			}
			
			
			$timesheet = Timesheet::find($r->id);
			$timesheet->project_id = $r->project_id;
			$timesheet->task_id = $r->task_id;
			// $timesheet->working_time = ($position==1)? $r->working_time_admin_edit : $r->working_time_users_edit;
			$timesheet->working_time = $working_time;
			// $timesheet->overtime = ($position==1)? $r->overtime_admin_edit : $r->overtime_users_edit;
			$timesheet->overtime = $overtime;
			$timesheet->date_time_entries = $r->date_time_entries;
			$timesheet->note = $r->note;
			$timesheet->create_date = date('Y-m-d H:m:s');
			$timesheet->user_id = ($position==1)? $r->user_id_edit : Auth::user()->id;
			$timesheet->save();
			
			return response(['msg'=>'update successfully']);
		}
	}

	//get table timesheet when change day
	public function readByAjax_ChangeDay(Request $r){
		$id = Auth::user()->id;
		$users = Users::find($id);
		if($users->position == 1){
			$timesheet = Timesheet::join('tasks','tasks.id','=','time_entries.task_id')
	  					->join('projects','projects.id','=','tasks.project_id')
	  					->join('users','users.id','=','time_entries.user_id')
	                    ->select('time_entries.*','tasks.taskname as taskname','projects.name as projectname','users.firstname as firstname','users.lastname as lastname','users.position as position')
	                    ->where('time_entries.date_time_entries','=',$r->create_date)
	                    ->orderBy('time_entries.id','DESC')
	                    ->paginate(50);
        }
        else{

        	$timesheet = Timesheet::join('tasks','tasks.id','=','time_entries.task_id')
	  					->join('projects','projects.id','=','tasks.project_id')
	                    ->select('time_entries.*','tasks.taskname as taskname','projects.name as projectname')
	                    ->where('time_entries.user_id','=',Auth::user()->id)->where('time_entries.date_time_entries','=',$r->create_date)
	                    ->orderBy('time_entries.id','DESC')
	                    ->paginate(50);
        }

  		return view('user.readByAjax',compact('timesheet'));
	}

	public function search(Request $r){
		$term = $r->term;
		$id = Auth::user()->id;
		$users = Users::find($id);
		$timesheet = Timesheet::join('tasks','tasks.id','=','time_entries.task_id')
  					->join('projects','projects.id','=','tasks.project_id')
  					->join('users','users.id','=','time_entries.user_id')
                    ->select('time_entries.*','tasks.taskname as taskname','projects.name as projectname','users.firstname as firstname','users.lastname as lastname','users.position as position')
                    ->where('name','LIKE','%'.$term.'%')->Orwhere('taskname','LIKE','%'.$term.'%')->Orwhere('firstname','LIKE','%'.$term.'%')->Orwhere('lastname','LIKE','%'.$term.'%')->Orwhere('date_time_entries','LIKE','%'.$term.'%')
                    ->orderBy('time_entries.id','DESC')
                    ->paginate(5);

		if(count($timesheet) == 0){
			$searchResult[] = 'No item found';
		}else{
			foreach ($timesheet as $key => $value) {
				$searchResult[] = $value->taskname;
			}
		}

		return $searchResult;
        // return view('user.search',['timesheet'=>$timesheet]);
	}

}
