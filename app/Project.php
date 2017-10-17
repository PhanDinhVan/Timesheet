<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    //
    protected $table = "Projects";
    public $timestamps = false;

     public function customer(){
    	return $this->belongsTo('App\Customer','customer_id','id');
    }

    public function task(){
    	return $this->hasMany('App\Task','project_id','id');
    }
}
