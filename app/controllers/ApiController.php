<?php

class ApiController extends BaseController {

    protected $gearman;    

    public function __construct()
    {
        $this->gearman = new GearmanClient();        
    }

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
        $job = $this->sendToQueue('register', $input);
        Log::info('register op:'.json_encode($input));

        return $job;
	}

	public function korban()
	{

		$this->proceedToken();		

		$input = array(
			'name' => Input::get('name'),
			'phone' => Input::get('phone'),
			'datetime' => date('Y-m-d H:i:s'),
			'type_victim' => 0,
			'location' => array(Input::get('location'))
		);

		//nodejs worker
        $this->sendToQueue('newMarker', $input);

		/*
		send to gearman
		@TODO : dirapikan menjadi custom lib
		 */
        $job = $this->sendToQueue('korban', $input);  
        Log::info('korban op:'.json_encode($input));      
        return $job;
	}

	public function relawan()
	{

		$this->proceedToken();
		
		$input = array(
			'name' => Input::get('name'),
			'phone' => Input::get('phone'),
			'desc' => Input::get('desc'),
			'datetime' => date('Y-m-d H:i:s'),
			'status' => Input::get('keadaan'),
			'type_victim' => 1,
			'location' => array(Input::get('location'))
		);

		/*
		send to gearman
		@TODO : dirapikan menjadi custom lib
		 */
        $job = $this->sendToQueue('relawan', $input);       
        Log::info('relawan op:'.json_encode($input)); 
        return $job;
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

    // TODO: Ini seharusnya dibikin jadi Queue::push()
    private function sendToQueue($name, $workload)
    {
        $host = Config::get('queue.connections.gearman.host');
        $port = Config::get('queue.connections.gearman.port');

        try {
            $this->gearman->addServer($host, $port);
            $job = $this->gearman->doBackground($name, json_encode($workload));

            if ($job)
                return array('success' => 1);
        }
        catch (GearmanException $e)
        {
            Log::error($e);
            return array('error', $e->getMessage());
        }
        catch (ErrorException $e)
        {
            Log::error($e);
            return array('error', $e->getMessage());
        }
        catch (\Exception $e)
        {
            Log::error($e);
            return array('error', $e->getMessage());
        }
    }
}
