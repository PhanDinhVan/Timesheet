<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Timesheet;
use App\Users;
use DB;
// use App\Project;
// use App\Task;
use App\Customer;

class ReportController extends Controller
{
    //
    public function getReport(){
    	$username = Users::all();
    	return view('admin/report/user_report',['username'=>$username]);
    }

    public function showReport(Request $request){
    	// dung thang nay de debug
    	// \Log::debug($request->user_id);
    	// $report = $this->reportInfo()
    	// ->select("projects.name",
    	// 		"tasks.taskname",
    	// 		"time_entries.working_time",
    	// 		"time_entries.overtime",
    	// 		"users.firstname",
    	// 		"users.lastname")
    	// ->whereIn('users.id', $request->user_id)
    	// ->whereDate("time_entries.date_time_entries",">=",$request->from)
    	// ->whereDate("time_entries.date_time_entries","<=",$request->to)
    	// ->groupBy('users.lastname')->groupBy('projects.name')->groupBy('tasks.taskname')
    	// ->get();


    	$report = $this->reportInfo()
    	->select(DB::raw("projects.name, 
    					tasks.taskname,
    					(CONCAT(CASE WHEN FLOOR((SUM(time_entries.working_time)+SUM(time_entries.overtime))/60) < 10 THEN '0' ELSE '' END,
    						FLOOR((SUM(time_entries.working_time)+SUM(time_entries.overtime))/60),':',CASE WHEN MOD((SUM(time_entries.working_time)+SUM(time_entries.overtime)),60) < 10 THEN '0' ELSE '' END,MOD((SUM(time_entries.working_time)+SUM(time_entries.overtime)),60))) as total_working_time,
    					users.firstname,
    					users.lastname"))
    	->whereIn('users.id', $request->user_id)
    	->whereDate("time_entries.date_time_entries",">=",$request->from)
    	->whereDate("time_entries.date_time_entries","<=",$request->to)
    	->groupBy('users.id')->groupBy('projects.name')
    	->get();

    	return view('admin/report/listReport',compact('report'));
    }

    public function reportInfo(){
    	return Timesheet::join('tasks','tasks.id','=','time_entries.task_id')
  					->join('projects','projects.id','=','tasks.project_id')
  					->join('users','users.id','=','time_entries.user_id');
    }

    public function getCustomerReport(){
    	$customer = Customer::all();
    	return view('admin/report/customer_report',['customer'=>$customer]);
    }

    public function showReportCustomer(Request $request){

    	// $report = $this->reportInfoCustomer()
    	// ->select("projects.name as project_name",
    	// 		"customers.name as customer_name",
    	// 		"tasks.taskname",
    	// 		"time_entries.working_time",
    	// 		"time_entries.overtime",
    	// 		"users.firstname",
    	// 		"users.lastname")
    	// ->whereIn("customers.id",$request->customer_id)
    	// ->whereDate("time_entries.date_time_entries",">=",$request->from)
    	// ->whereDate("time_entries.date_time_entries","<=",$request->to)
    	// ->groupBy('tasks.taskname')
    	// ->get();

    	$report = $this->reportInfoCustomer()
    	->select(DB::raw("users.firstname,
    					customers.name as customer_name, 
    					(CONCAT(CASE WHEN FLOOR((SUM(time_entries.working_time)+SUM(time_entries.overtime))/60) < 10 THEN '0' ELSE '' END,
    						FLOOR((SUM(time_entries.working_time)+SUM(time_entries.overtime))/60),':',CASE WHEN MOD((SUM(time_entries.working_time)+SUM(time_entries.overtime)),60) < 10 THEN '0' ELSE '' END,MOD((SUM(time_entries.working_time)+SUM(time_entries.overtime)),60))) as total_working_time,
    					users.lastname"))
    	->whereIn("customers.id",$request->customer_id)
    	->whereDate("time_entries.date_time_entries",">=",$request->from)
    	->whereDate("time_entries.date_time_entries","<=",$request->to)
    	->groupBy('customers.id')->groupBy('users.id')
    	->get();

    	return view('admin/report/listCustomer',compact('report'));
    }

    public function reportInfoCustomer(){
    	return Timesheet::join('tasks','tasks.id','=','time_entries.task_id')
  					->join('projects','projects.id','=','tasks.project_id')
  					->join('users','users.id','=','time_entries.user_id')
  					->join('customers','customers.id','=','projects.customer_id');
    }
}
