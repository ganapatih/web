<?php
Route::get('/', array('as'=>'home','uses'=>'HomeController@getIndex'));
Route::post('login', array('as'=>'login',function(){
	return Redirect::route('dashboard');
}));
Route::get('dashboard', array('as'=>'dashboard','uses'=>'HomeController@getDashboard'));
