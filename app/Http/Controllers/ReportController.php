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
                        customers.name as customer_name,
    					users.id as ID,
    					(CONCAT(CASE WHEN FLOOR((SUM(time_entries.working_time)+SUM(time_entries.overtime))/60) < 10 THEN '0' ELSE '' END,
    						FLOOR((SUM(time_entries.working_time)+SUM(time_entries.overtime))/60),':',CASE WHEN MOD((SUM(time_entries.working_time)+SUM(time_entries.overtime)),60) < 10 THEN '0' ELSE '' END,MOD((SUM(time_entries.working_time)+SUM(time_entries.overtime)),60))) as total_working_time,
    					users.firstname,
    					users.lastname"))
    	->whereIn('users.id', $request->user_id)
    	->whereDate("time_entries.date_time_entries",">=",$request->from)
    	->whereDate("time_entries.date_time_entries","<=",$request->to)
    	->groupBy('users.id')->groupBy('customers.id')->groupBy('projects.name')
    	->get();

    	$report2 = $this->reportInfo()
    	->select(DB::raw("projects.name, 
    					tasks.taskname,
    					users.id as user_ID,
    					(CONCAT(CASE WHEN FLOOR((SUM(time_entries.working_time)+SUM(time_entries.overtime))/60) < 10 THEN '0' ELSE '' END,
    						FLOOR((SUM(time_entries.working_time)+SUM(time_entries.overtime))/60),':',CASE WHEN MOD((SUM(time_entries.working_time)+SUM(time_entries.overtime)),60) < 10 THEN '0' ELSE '' END,MOD((SUM(time_entries.working_time)+SUM(time_entries.overtime)),60))) as total_time,
    					users.firstname,
    					users.lastname"))
    	->whereIn('users.id', $request->user_id)
    	->whereDate("time_entries.date_time_entries",">=",$request->from)
    	->whereDate("time_entries.date_time_entries","<=",$request->to)
    	->groupBy('users.id')
    	->get();

    	return view('admin/report/listReport',compact('report'),compact('report2'));
    }

    public function reportInfo(){
    	return Timesheet::join('tasks','tasks.id','=','time_entries.task_id')
  					->join('projects','projects.id','=','tasks.project_id')
  					->join('users','users.id','=','time_entries.user_id')
                    ->join('customers','customers.id','=','projects.customer_id');
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
    					projects.name as projects_name,
    					customers.id as ID,
    					customers.name as customer_name, 
    					(CONCAT(CASE WHEN FLOOR((SUM(time_entries.working_time)+SUM(time_entries.overtime))/60) < 10 THEN '0' ELSE '' END,
    						FLOOR((SUM(time_entries.working_time)+SUM(time_entries.overtime))/60),':',CASE WHEN MOD((SUM(time_entries.working_time)+SUM(time_entries.overtime)),60) < 10 THEN '0' ELSE '' END,MOD((SUM(time_entries.working_time)+SUM(time_entries.overtime)),60))) as total_working_time,
    					users.lastname"))
    	->whereIn("customers.id",$request->customer_id)
    	->whereDate("time_entries.date_time_entries",">=",$request->from)
    	->whereDate("time_entries.date_time_entries","<=",$request->to)
    	->groupBy('customers.id')->groupBy('projects.id')->groupBy('users.id')
    	->get();

    	$report2 = $this->reportInfoCustomer()
    	->select(DB::raw("users.firstname,
    					customers.id as customers_ID,
    					customers.name as customer_name, 
    					(CONCAT(CASE WHEN FLOOR((SUM(time_entries.working_time)+SUM(time_entries.overtime))/60) < 10 THEN '0' ELSE '' END,
    						FLOOR((SUM(time_entries.working_time)+SUM(time_entries.overtime))/60),':',CASE WHEN MOD((SUM(time_entries.working_time)+SUM(time_entries.overtime)),60) < 10 THEN '0' ELSE '' END,MOD((SUM(time_entries.working_time)+SUM(time_entries.overtime)),60))) as total_time,
    					users.lastname"))
    	->whereIn("customers.id",$request->customer_id)
    	->whereDate("time_entries.date_time_entries",">=",$request->from)
    	->whereDate("time_entries.date_time_entries","<=",$request->to)
    	->groupBy('customers.id')
    	->get();

    	return view('admin/report/listCustomer',compact('report'),compact('report2'));
    }

    public function reportInfoCustomer(){
    	return Timesheet::join('tasks','tasks.id','=','time_entries.task_id')
  					->join('projects','projects.id','=','tasks.project_id')
  					->join('users','users.id','=','time_entries.user_id')
  					->join('customers','customers.id','=','projects.customer_id');
    }

    public function getChartCustomer(){
        $customer = Customer::all();
        return view('admin.report_chart.chart_customer',['customer'=>$customer]);
    }

    public function getChartUser(){
        return view('admin.report_chart.chart_user');
    }

    public function getDrawChartCustomer(Request $request){
        $data = $this->reportInfoCustomer()
                        ->select(DB::raw(
                            "customers.name as customer_name,
                            projects.name as project_name,
                            projects.id as project_id,
                            users.firstname as firstname,
                            users.lastname as lastname,
                            (SUM(time_entries.working_time) + SUM(time_entries.overtime)) as time"))
                        ->where('customers.id','=',$request->id)
                        ->whereDate("time_entries.date_time_entries",">=",$request->from)
                        ->whereDate("time_entries.date_time_entries","<=",$request->to)
                        ->groupBy('customers.id')->groupBy('projects.id')->groupBy('users.id')
                        ->get();
        return $data;
    }
}
