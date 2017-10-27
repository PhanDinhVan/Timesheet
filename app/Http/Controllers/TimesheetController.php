<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Task;
use App\Timesheet;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class TimesheetController extends Controller
{
    function __construct(){
        

        // $theloai = TheLoai::all();
        // $slide = Slide::all();
        // view()->share('theloai',$theloai);
        // view()->share('slide',$slide);
        
        
    }

    //
    public function getTimesheet(){
    	$create_date = date('Y-m-d');
    	// $time_entries = Timesheet::find($create_date);
    	$time_entries = Timesheet::where('date_time_entries',$create_date)->where('user_id',Auth::user()->id)->get();
    	// $time_entries = Timesheet::all();
    	// die($q);
    	$project = Project::all();
    	$task = Task::all();
    	return view('pages.timesheet',['project'=>$project,'task'=>$task,'time_entries'=>$time_entries]);
    }

    // get timesheet khi edit datetime
    public function getTimesheet2(Request $request){
        $data = $request->create_date;
        $time_entries = Timesheet::where('date_time_entries',$data)->where('user_id',Auth::user()->id)->get();
        
        echo($time_entries);
    }


    public function postAddTimesheet(Request $request){
        // die($request->working_time);
    	$this->validate($request,
    		[
    			'project_id'=>'required',
    			'task_id'=>'required',
    			'start_date'=>'required',
    			'note'=>'required|min:5|max:500'
    		],
    		[
    			'project_id.required'=>'Please select project name',
    			'task_id.required'=>'Please select task name',
    			'start_date.required'=>'Please select start date',
    			'note.required'=>'Please enter note',
    			'note.min'=>'Enter at least 3 characters',
    			'note.max'=>'Enter up to 500 characters'
    		]);

    	$time_entries = new Timesheet;

    	$time_entries->task_id = $request->task_id;
    	$time_entries->user_id = Auth::user()->id;
    	$time_entries->working_time = $request->working_time;
    	$time_entries->date_time_entries = $request->start_date;
    	$time_entries->note = $request->note;
    	$time_entries->overtime = 0;
    	$time_entries->create_date = date('Y-m-d');

    	$time_entries->save();

    	return redirect('users/timesheet')->with('thongbao','Add timesheet success');
    }

    public function getEditTimesheet($id){
        $time_entries_edit = Timesheet::find($id);
        // die($time_entries_edit);
        return $time_entries_edit;
    }

    public function getFullCalendar(){
    	return view('pages.fullcalendar');
    }
}
