<?php

class ApiController extends BaseController {

	public function register()
	{
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
		$input = array(
			'name' => Input::get('name'),
			'phone' => Input::get('phone'),			
			'datetime' => date('Y-m-d H:i:s'),
			'type_victim' => 0,
			'location' => explode(',', Input::get('location'))
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
		$input = array(
			'name' => Input::get('name'),
			'phone' => Input::get('phone'),
			'desc' => Input::get('desc'),
			'datetime' => date('Y-m-d H:i:s'),
			'status' => Input::get('keadaan'),
			'type_victim' => 1,
			'location' => explode(',', Input::get('location'))
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

}