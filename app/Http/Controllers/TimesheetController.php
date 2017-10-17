<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TimesheetController extends Controller
{
    //
    public function getTimesheet(){
    	return view('pages.timesheet');
    }
}
