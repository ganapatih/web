<?php

class HomeController extends BaseController {

	public function getIndex()
	{
		return View::make('homepage.index');
	}

	public function getDashboard()
	{
		return View::make('homepage.dashboard');
	}
	
}