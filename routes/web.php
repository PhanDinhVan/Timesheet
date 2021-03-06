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
    return view('pages.login');
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

	Route::group(['prefix'=>'permisson'],function(){
		Route::get('list','PermissonController@getList');

		Route::get('add','PermissonController@getAdd');
		Route::post('add','PermissonController@postAdd');

		Route::get('edit/{id}','PermissonController@getEdit');
		Route::post('edit/{id}','PermissonController@postEdit');

		Route::get('delete/{id}','PermissonController@getDelete');
	});

	Route::group(['prefix'=>'report'],function(){
		Route::get('user_report','ReportController@getReport');
		Route::get('showReport','ReportController@showReport');
		Route::get('customer_report','ReportController@getCustomerReport');
		Route::get('showReportCustomer','ReportController@showReportCustomer');
		
	});

	Route::group(['prefix'=>'report_chart'],function(){
		Route::get('chart_customer','ReportController@getChartCustomer');
		Route::get('chart_user','ReportController@getChartUser');
		Route::get('getchart','ReportController@getDrawChartCustomer');
		Route::get('getchartUsers','ReportController@getDrawChartUser');
	});
});

//====================== users ============================ 

Route::get('login','LoginController@getLoginUser');
Route::post('login','LoginController@postLoginUser');
Route::get('logout','LoginController@getLogoutUser');
Route::get('sendMail','ForgotPasswordController@getSendMail');
Route::post('sendMail','ForgotPasswordController@postSendMail');
Route::get('resetPass/{token}','ResetPasswordController@getResetPass');
Route::post('resetPass','ResetPasswordController@postResetPass');


Route::get('send','mailController@send');


// Route::get('/send_email', array('uses' => 'LoginController@sendEmailReminder')); getResetPassword


// =============================== User lam lai ============================
Route::group(['prefix'=>'user','middleware'=>'userLogin'],function(){
	Route::get('timesheet','Timesheet_02Controller@getTimesheet');
	Route::post('timesheet','Timesheet_02Controller@postTimesheet');
	Route::get('setting','LoginController@getSettingUser');
	Route::post('setting','LoginController@postSettingUser');
});


// get task name ung voi project khi add timesheet
Route::get('task/{project_id}','Ajax_02Controller@getTask');  
Route::get('readByAjax','Timesheet_02Controller@readByAjax');
Route::post('deleteByAjax','Timesheet_02Controller@deleteByAjax');
Route::get('getEditAjax','Timesheet_02Controller@getEditAjax');
Route::post('updateByAjax','Timesheet_02Controller@updateByAjax');
Route::get('task_edit/{project_id}','Ajax_02Controller@getTaskEdit'); 
Route::get('taskname/{task_id}','Ajax_02Controller@getTaskName');
Route::get('projectname/{project_id}','Ajax_02Controller@getProjectName');
Route::get('readByAjax_ChangeDay','Timesheet_02Controller@readByAjax_ChangeDay');
Route::get('project_user/{user_id}','Ajax_02Controller@getProject_User');
Route::get('search','Timesheet_02Controller@search');  

