<?php
use MikrotikAPI\Talker\Talker;
use MikrotikAPI\Commands\Ping\Ping;
use PHPUnit\Framework\TestCase;

/**
*  Set QueuePCQ test
*/
class PingTest extends TestCase
{
	public function testPingGet()
	{	
		//load enviroment variables
		$dotenv = new Dotenv\Dotenv(__DIR__);
		$dotenv->load();

		//create conection
		$talker = Talker::create( $_ENV['MKT_IP'], $_ENV['MKT_USER'], $_ENV['MKT_PASS']);		
	    $talker->initialize();
		
		$ping   = new Ping($talker);

		$results = $ping->get(['address' => '192.168.44.11', 'count' => 5]);
		
		foreach($results as $result){

			echo(PHP_EOL);
			foreach ($result as $key => $value) {
				# code...
				echo($key.':'.$value.' ');

				// foreach ($value as $key => $value) {
				// 	# code...
				// 	echo($key.':'.$value.PHP_EOL);
				// }

			}	
		}
		echo(PHP_EOL);

	}
	
}
