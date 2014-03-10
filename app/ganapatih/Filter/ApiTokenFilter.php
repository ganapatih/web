<?php namespace Ganapatih\Filter;

use Ganapatih\Exception\ApiException;

use Input;
use Session;
use Token;

class ApiTokenFilter {

	/*
	beforeFilter
	 */
	public function filter($route, $request)
	{
		$checkToken = $this->checkToken(trim(Input::get('_token')));				
		if (!$checkToken) {	
			Token::delete(trim(Input::get('_token')));
			throw new ApiException('Invalid Token');
		}
	}

	private function checkToken($token)
	{
		$check = Token::isRegistered($token);
		return $check;
	}	

}