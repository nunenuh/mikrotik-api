<?php
use MikrotikAPI\Talker\Talker;
use MikrotikAPI\Commands\Queue\QueueSimple;
use PHPUnit\Framework\TestCase;

/**
*  Set QueuePCQ test
*/
class QueueSimpleText extends TestCase
{
	public function testQueueSimpleGetAll()
	{	
		//load enviroment variables
		$dotenv = new Dotenv\Dotenv(__DIR__);
		$dotenv->load();

		//create conection
		$talker = Talker::create( $_ENV['MKT_IP'], $_ENV['MKT_USER'], $_ENV['MKT_PASS']);		
	    $talker->initialize();
		
		$queue   = new QueueSimple($talker);

		$results = $queue->getAll();
		
		foreach($results as $result){

			echo(PHP_EOL);
			foreach ($result as $key => $value) {
				# code...
				echo($key.':'.$value.' '.PHP_EOL);

				// foreach ($value as $key => $value) {
				// 	# code...
				// 	echo($key.':'.$value.PHP_EOL);
				// }

			}	
		}
		echo(PHP_EOL);

	}
	
}
