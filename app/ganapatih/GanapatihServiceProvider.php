<?php namespace Ganapatih;

use Ganapatih\Exception\ApiException;
use Ganapatih\Exception\MongoException;
use Ganapatih\Exception\GearmanException;

use Ganapatih\Filter\ApiTokenFilter;

use Illuminate\Support\ServiceProvider;
use App;
use Response;
use View;
use Route;

class GanapatihServiceProvider extends ServiceProvider {

	protected $defer = false;

	/**
	 * Bootstrap process
	 * -> register custom exception handler
	 * 
	 * @return void
	 */
	public function boot() 
	{

		require_once app_path().'/ganapatih/helpers.php';		
		
		//custom listeners
		$this->setCustomExceptionListener();

		/*
		cek apakah pecl mongo sudah terinstall atau tidak
		 */
		if (!class_exists('MongoClient')) {
			throw new MongoException('Please install pecl mongo to use this application.');
		}

		/*
		cek apakah pecl gearman terinstall atau belum
		 */
		if (!class_exists('GearmanClient')) {
			throw new GearmanException('Please install pecl gearman to use this application');
		}		
	}

	/**
	 * Register ioc container
	 * @return void
	 */
	public function register()
	{
		$this->app->bind('ganapatih.ioc.apitoken', function() {
			return new ApiTokenFilter;
		});		

		$this->setCustomFilterHandler();
	}

	private function setCustomExceptionListener()
	{
		App::error(function(GearmanException $exception) {
			return View::make('exceptions.pecl', array('message' => $exception->getMessage()));
		});

		App::error(function(ApiException $exception) {	
			return Response::json(array('status' => 'error', 'message' => $exception->getMessage()));
		});
	}

	private function setCustomFilterHandler()
	{
		Route::filter('ganapatih.filter.token', 'ganapatih.ioc.apitoken');
	}

}