<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //
    protected $table = "tasks";
    public $timestamps = false;

    public function project(){
    	return $this->belongsTo('App\Project','project_id','id');
    }

    public function timesheet(){
    	return $this->belongsTo('App\Timesheet','task_id ','id');
    }
}
