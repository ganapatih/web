<?php

class ApiController extends BaseController {

    protected $gearman;

    public function __construct()
    {
        $this->gearman = new GearmanClient();
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
			'location' => explode(',', Input::get('location'))
		);

		/*
		send to gearman
		@TODO : dirapikan menjadi custom lib
		 */
        $job = $this->sendToQueue('korban', $input);

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
			'location' => explode(',', Input::get('location'))
		);

		/*
		send to gearman
		@TODO : dirapikan menjadi custom lib
		 */
        $job = $this->sendToQueue('relawan', $input);

        return $job;
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
