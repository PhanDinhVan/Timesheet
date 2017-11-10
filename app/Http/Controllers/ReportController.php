<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Timesheet;
// use App\Project;
// use App\Task;
// use App\Customer;

class ReportController extends Controller
{
    //
    public function getReport(){
    	return view('admin/report/report');
    }

    public function showReport(Request $request){

    	$report = $this->reportInfo()
    	->select("projects.name",
    			"tasks.taskname",
    			"time_entries.date_time_entries",
    			"time_entries.working_time",
    			"time_entries.overtime",
    			"users.firstname",
    			"users.lastname")
    	->whereDate("time_entries.date_time_entries",">=",$request->from)
    	->whereDate("time_entries.date_time_entries","<=",$request->to)
    	->get();
    	return view('admin/report/listReport',compact('report'));
    }

    public function reportInfo(){
    	return Timesheet::join('tasks','tasks.id','=','time_entries.task_id')
  					->join('projects','projects.id','=','tasks.project_id')
  					->join('users','users.id','=','time_entries.user_id');
    }
}
