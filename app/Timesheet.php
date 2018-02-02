<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timesheet extends Model
{
    //
    protected $table = "time_entries";
    public $timestamps = false;

    // public function task(){
    // 	return $this->hasMany('App\Task');
    // }

    public function task(){
    	return $this->hasMany('App\Task','id ','id');
    }
}
