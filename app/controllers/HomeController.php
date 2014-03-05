<?php

class HomeController extends BaseController {
	
	public function __construct()
	{
		View::share('is_login', Auth::check());
	}

	public function getIndex()
	{
		return View::make('homepage.index');
	}

	public function getDashboard()
	{		
		return View::make('homepage.dashboard');
	}
	
}