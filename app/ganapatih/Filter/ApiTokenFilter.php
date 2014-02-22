<?php namespace Ganapatih\Filter;

use Ganapatih\Exception\ApiException;

use Input;
use Session;

class ApiTokenFilter {

	/*
	beforeFilter
	 */
	public function filter($route, $request)
	{
		$checkToken = $this->checkToken(Input::get('_token'));				
		if (!$checkToken) {	
			Session::flush();				
			throw new ApiException('Invalid Token');
		}
	}

	private function checkToken($token)
	{
		if (Session::has('__token_api')) {

			if ($token == Session::get('__token_api')) {
				Session::flush();
				return true;
			}

		}

		return false;
	}	

}