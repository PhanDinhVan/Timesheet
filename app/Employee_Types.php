<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee_Types extends Model
{
    //
        // declare table - khai bao table
    protected $table = "Employee_Types";
    // them thang nay de khong tu dong insert `updated_at`, `created_at` vao table
    public $timestamps = false;

    // public function users(){
    // 	return $this->hasMany('App\Users','idTheLoai','id');
    // }
}
