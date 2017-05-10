<?php
use MikrotikAPI\Talker\Talker;
use MikrotikAPI\Commands\Queue\QueueType;
use PHPUnit\Framework\TestCase;

/**
*  Set QueuePCQ test
*/
class QueueTypeTest extends TestCase
{
	public function testQueueTypeAdd()
	{	
		//load enviroment variables
		$dotenv = new Dotenv\Dotenv(__DIR__);
		$dotenv->load();

		//create conection
		$talker = Talker::create( $_ENV['MKT_IP'], $_ENV['MKT_USER'], $_ENV['MKT_PASS']);		
	    $talker->initialize();
		
		$queueType = new QueueType($talker);

		$result  = $queueType->set(['name' => '2mb', 'pcq-rate' => '2048'],'*4D');
		$results = $queueType->print();

		echo(PHP_EOL);
		foreach($results as $result){
			echo($result['.id'].' '.$result['name'].PHP_EOL);
		}
		echo(PHP_EOL);
	}
	
}
