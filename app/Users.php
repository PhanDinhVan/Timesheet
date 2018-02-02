<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    //
    // declare table - khai bao table
    protected $table = "users";
    public $timestamps = false;

    public function employee_types(){
    	return $this->belongsTo('App\Employee_Types','employee_type_id','id');
    }

}
