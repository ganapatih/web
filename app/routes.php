<?php

//homepage
Route::get('/', array('as'=>'home','uses'=>'HomeController@getIndex'));

/*
login user
 */
Route::post('login', array('as'=>'login.post',function(){
	
	if (Auth::attempt(array('email' => Input::get('email'), 'password' => Input::get('password')))) {
		return Redirect::intended('dashboard');
	} else {
		return Redirect::route('login.get')->with('auth.failed', 'Username atau password Anda salah.');
	}

}));

Route::get('login', array('as' => 'login.get', function() {
	return View::make('users/login');
}));

Route::get('logout', array('as' => 'logout.get', function() {
	Auth::logout();
	return Redirect::route('login.get');
}));

Route::get('register', array('as' => 'register.get', function() {
	return View::make('users/register');
}));

Route::post('register', array('as' => 'register.post', function() {

	/*
	validasi dulu input fieldnya
	 */
	$validator = Validator::make(Input::all(), array(		
		'email' => 'required|email',
		'password' => 'required|min:4'
	));

	/*
	jika gagal akan dikembalikan ke 
	halaman register dengan input sebelumnya
	+ validasi message
	 */
	if ($validator->fails()) {//validasi gagal
		return Redirect::route('register.get')->withErrors($validator);
	} else {
		return Redirect::route('login.get')->with('register.success', 'Silahkan login menggunakan akun Anda.');
	}

}));

/*
dashboard sementara ga diprotect -> auth filter
 */
Route::get('dashboard', array('before' => 'auth','as'=>'dashboard','uses'=>'HomeController@getDashboard'));

/*
khusus utk api
 */
Route::group(array('prefix' => 'api'), function() {

	Route::get('token', array('uses' => 'ApiController@token'));	
	Route::post('register', array('uses' => 'ApiController@register'));
	Route::post('korban', array('uses' => 'ApiController@korban'));
	Route::post('relawan', array('uses' => 'ApiController@relawan'));

});