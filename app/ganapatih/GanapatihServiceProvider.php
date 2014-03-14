<?php namespace Ganapatih;

use Ganapatih\Exception\ApiException;
use Ganapatih\Exception\MongoException;
use Ganapatih\Exception\GearmanException;

use Ganapatih\Filter\ApiTokenFilter;
use Ganapatih\Token;

use Illuminate\Support\ServiceProvider;
use App;
use Response;
use View;
use Route;

class GanapatihServiceProvider extends ServiceProvider
{

    protected $defer = false;

    /**
     * Bootstrap process
     * -> register custom exception handler
     *
     * @throws Exception\GearmanException
     * @throws Exception\MongoException
     * @return void
     */
    public function boot()
    {
        require_once app_path() . '/ganapatih/helpers.php';

        // Custom listeners
        $this->setCustomExceptionListener();

        /*
        Cek apakah pecl mongo sudah terinstall atau tidak
         */
        if (!class_exists('MongoClient')) {
            throw new MongoException('Please install pecl mongo to use this application.');
        }

        /*
        Cek apakah pecl gearman terinstall atau belum
         */
        if (!class_exists('GearmanClient')) {
            throw new GearmanException('Please install pecl gearman to use this application');
        }
    }

    /**
     * Register IoC Container
     * @return void
     */
    public function register()
    {
        $this->app->bind('ganapatih.ioc.apitoken', function () {
            return new ApiTokenFilter;
        });

        $this->app->bind('ganapatih.ioc.token', function () {
            return new Token;
        });

        $this->setCustomFilterHandler();
    }

    public function providers()
    {
        return array('ganapatih.ioc.apitoken', 'ganapatih.ioc.token');
    }

    private function setCustomExceptionListener()
    {
        App::error(function (GearmanException $exception) {
            return View::make('exceptions.pecl', array('message' => $exception->getMessage()));
        });

        App::error(function (ApiException $exception) {
            return Response::json(array('status' => 'error', 'message' => $exception->getMessage()));
        });
    }

    private function setCustomFilterHandler()
    {
        Route::filter('ganapatih.filter.token', 'ganapatih.ioc.apitoken');
    }

}
