<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create someng great!
|
*/


Route::group(['prefix'=>'msg/user','namespace'=>'Msg'],function(){
	Route::match(['post','get'],'login','UserController@login');
	Route::match(['post','get'],'register','UserController@register');
	Route::match(['post','get'],'resetpwd','UserController@resetpwd');
	Route::any('logout','UserController@logout');
});
Route::get('/msg/user/captcha','Msg\UserController@captcha');
Route::resource('/msg/msg','Msg\MsgController')->middleware('web');
Route::group(['prefix'=>'msg/msg','namespace'=>'Msg'],function(){
	Route::get('create','MsgController@create');
	Route::post('store','MsgController@store');
	Route::get('{msg}','MsgController@show');
	Route::get('{msg}/edit','MsgController@edit');
	Route::put('{msg}','MsgController@update');
	Route::delete('{msg}','MsgController@destroy');
});
Route::resource('/msg/rmsg','Msg\RmsgController')->middleware('web');
Route::group(['prefix'=>'msg/rmsg','namespace'=>'Msg'],function(){
	Route::get('{rmsg}/create','RmsgController@create');
	Route::post('store','RmsgController@store');
	Route::get('{rmsg}','RmsgController@show');
	Route::get('{rmsg}/edit','RmsgController@edit');
	Route::put('{rmsg}','RmsgController@update');
	Route::delete('{rmsg}','RmsgController@destroy');
});
