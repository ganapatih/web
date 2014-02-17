<?php

class ApiController extends BaseController {	

	public function token()
	{
		Session::put('__token_api', base64_encode(time()));		
		return Response::json(array('_token' => Session::get('__token_api')));
	}

	public function register()
	{

		$this->proceedToken();

		/*
		setup data
		 */
		$input = array(
			'name' => Input::get('name'),
			'phone' => Input::get('phone'),
			'email' => Input::get('email'),
			'datetime' => date('Y-m-d H:i:s'),
			'gcmid' => Input::get('gcmId')
		);

		/*
		send to gearman
		@TODO : dirapikan menjadi custom lib
		 */
		$gearman = new GearmanClient();
		$gearman->addServer();

		$job = $gearman->doBackground('register', json_encode($input));

		return Response::json(array('success' => 1));
	}

	public function korban()
	{

		$this->proceedToken();

		list($lat, $long) = explode(',', Input::get('location'));

		$input = array(
			'name' => Input::get('name'),
			'phone' => Input::get('phone'),			
			'datetime' => date('Y-m-d H:i:s'),
			'type_victim' => 0,
			'location' => array('lat' => $lat, 'long' => $long)
		);

		/*
		send to gearman
		@TODO : dirapikan menjadi custom lib
		 */
		$gearman = new GearmanClient();
		$gearman->addServer();

		$job = $gearman->doBackground('korban', json_encode($input));
		return Response::json(array('success' => 1));
	}

	public function relawan()
	{

		$this->proceedToken();

		list($lat, $long) = explode(',', Input::get('location'));
		$input = array(
			'name' => Input::get('name'),
			'phone' => Input::get('phone'),
			'desc' => Input::get('desc'),
			'datetime' => date('Y-m-d H:i:s'),
			'status' => Input::get('keadaan'),
			'type_victim' => 1,
			'location' => array('lat' => $lat, 'long' => $long)
		);

		/*
		send to gearman
		@TODO : dirapikan menjadi custom lib
		 */
		$gearman = new GearmanClient();
		$gearman->addServer();

		$job = $gearman->doBackground('relawan', json_encode($input));
		return Response::json(array('success' => 1));
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

	private function proceedToken()
	{
		$checkToken = $this->checkToken(Input::get('_token'));

		if (!$checkToken) {
			throw new ApiException('Invalid Token');
		}
	}

}