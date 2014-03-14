<?php namespace Ganapatih\Facade;

use Illuminate\Support\Facades\Facade;

class Token extends Facade
{

    protected static function getFacadeAccessor() { return 'ganapatih.ioc.token'; }

}
