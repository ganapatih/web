<?php

//homepage
Route::get('/', array('as'=>'home','uses'=>'HomeController@getIndex'));

/*
login user
 */
Route::post('login', array('as'=>'login',function(){
	return Redirect::route('dashboard');
}));

/*
dashboard sementara ga diprotect -> auth filter
 */
Route::get('dashboard', array('as'=>'dashboard','uses'=>'HomeController@getDashboard'));

Route::group(array('prefix' => 'api'), function() {

	Route::get('token', array('uses' => 'ApiController@token'));	
	Route::post('register', array('uses' => 'ApiController@register'));
	Route::post('korban', array('uses' => 'ApiController@korban'));
	Route::post('relawan', array('uses' => 'ApiController@relawan'));

});