<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\User;


Route::get('/', function () {
    return view('welcome');
});

Route::get('admin/login','LoginController@getLoginAdmin');
Route::post('admin/login','LoginController@postLoginAdmin');
Route::get('admin/logout','LoginController@getLogoutAdmin');

Route::group(['prefix'=>'admin','middleware'=>'adminLogin'],function(){
	
	Route::group(['prefix'=>'user'],function(){
		Route::get('list','UserController@getList');

		Route::get('add','UserController@getAdd');
		Route::post('add','UserController@postAdd');

		Route::get('edit/{id}','UserController@getEdit');
		Route::post('edit/{id}','UserController@postEdit');

		Route::get('delete/{id}','UserController@getDelete');
	});

	Route::group(['prefix'=>'employee_type'],function(){
		Route::get('list','EmployeeTypeController@getList');

		Route::get('add','EmployeeTypeController@getAdd');
		Route::post('add','EmployeeTypeController@postAdd');

		Route::get('edit/{id}','EmployeeTypeController@getEdit');
		Route::post('edit/{id}','EmployeeTypeController@postEdit');

		Route::get('delete/{id}','EmployeeTypeController@getDelete');
	});

	Route::group(['prefix'=>'customer'],function(){
		Route::get('list','CustomerController@getList');

		Route::get('add','CustomerController@getAdd');
		Route::post('add','CustomerController@postAdd');

		Route::get('edit/{id}','CustomerController@getEdit');
		Route::post('edit/{id}','CustomerController@postEdit');

		Route::get('delete/{id}','CustomerController@getDelete');
	});

	Route::group(['prefix'=>'project'],function(){
		Route::get('list','ProjectController@getList');

		Route::get('add','ProjectController@getAdd');
		Route::post('add','ProjectController@postAdd');

		Route::get('edit/{id}','ProjectController@getEdit');
		Route::post('edit/{id}','ProjectController@postEdit');

		Route::get('delete/{id}','ProjectController@getDelete');
	});

	Route::group(['prefix'=>'task'],function(){
		Route::get('list','TaskController@getList');

		Route::get('add','TaskController@getAdd');
		Route::post('add','TaskController@postAdd');

		Route::get('edit/{id}','TaskController@getEdit');
		Route::post('edit/{id}','TaskController@postEdit');

		Route::get('delete/{id}','TaskController@getDelete');
	});
});

Route::group(['prefix'=>'users','middleware'=>'userLogin'],function(){
	Route::get('timesheet','TimesheetController@getTimesheet');
	Route::get('timesheet/{create_date}','TimesheetController@getTimesheet2');
	Route::post('timesheet','TimesheetController@postAddTimesheet');
	Route::get('fullcalendar','TimesheetController@getFullCalendar');
	Route::get('edit_timesheet/{id}','TimesheetController@getEditTimesheet');
	Route::post('timesheet_edit/{id}','TimesheetController@postEditTimesheet');
});



Route::get('login','LoginController@getLoginUser');
Route::post('login','LoginController@postLoginUser');
Route::get('logout','LoginController@getLogoutUser');

// get task name ung voi project khi add timesheet
Route::get('task/{project_id}','AjaxController@getTask');  
Route::get('taskname/{task_id}','AjaxController@getTaskName');
Route::get('projectname/{task_id}','AjaxController@getProjectName');
// get task name ung voi project khi edit timesheet
Route::get('task_edit/{project_id}','AjaxController@getTaskEdit'); 

Route::get('timesheet_edit/{id}','AjaxController@getTimesheet_Edit');