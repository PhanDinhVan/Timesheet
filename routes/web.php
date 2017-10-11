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


Route::group(['prefix'=>'admin'],function(){
	
	Route::group(['prefix'=>'user'],function(){
		Route::get('list','UserController@getList');

		Route::get('edit/{id}','UserController@getEdit');
		Route::post('edit/{id}','UserController@postEdit');

		Route::get('add','UserController@getAdd');
		Route::post('add','UserController@postAdd');

		Route::get('delete/{id}','UserController@getDelete');
	});

});