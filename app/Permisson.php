<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permisson extends Model
{
    //
    // declare table - khai bao table
    protected $table = "permisson_users_projects";
    public $timestamps = false;

    //nhieu tro toi 1 (nhieu permisson thuoc 1 user)
    public function user(){
    	return $this->belongsTo('App\Users','user_id','id');
    }

    public function project(){
    	return $this->belongsTo('App\Project','project_id','id');
    }
}
