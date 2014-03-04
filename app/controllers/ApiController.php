<?php

use Ganapatih\Exception\ApiException as ApiException;

class ApiController extends BaseController {

    protected $gearman;
	protected $gearmanNode;

    public function __construct()
    {
    	$this->beforeFilter('ganapatih.filter.token', array('except' => 'token'));
        $this->gearman = new GearmanClient();
		$this->gearmanNode = new GearmanClient();
    }

	public function token()
	{
		Session::put('__token_api', base64_encode(time()));
		return Response::json(array('_token' => Session::get('__token_api')));
	}

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
        $job = $this->sendToQueue('register', $input);        
        return $job;
	}

	public function korban()
	{		
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
		
		$input['location'] = explode(',', Input::get('location'));
       	$this->sendToNode('newMarker', $input);

        return $job;
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
			'location' => array(Input::get('location'))
		);

		/*
		send to gearman
		@TODO : dirapikan menjadi custom lib
		 */
        $job = $this->sendToQueue('relawan', $input);
		
		$input['location'] = explode(',', Input::get('location'));
        $this->sendToNode('newMarker', $input);
        
        return $job;
	}
	
	private function sendToNode($name, $workload)
	{
		$host = Config::get('queue.connections.gearman.host');
        $port = Config::get('queue.connections.gearman.port');

        try {
            $this->gearmanNode->addServer($host, $port);
            $job = $this->gearmanNode->doBackground($name, json_encode($workload));

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
