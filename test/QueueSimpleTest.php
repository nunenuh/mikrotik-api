<?php
use MikrotikAPI\Talker\Talker;
use MikrotikAPI\Commands\Queue\QueueSimple;
use PHPUnit\Framework\TestCase;

/**
*  Set QueuePCQ test
*/
class QueueSimpleTest extends TestCase
{
	public function testQueueSimpleAdd()
	{	
		//load enviroment variables
		$dotenv = new Dotenv\Dotenv(__DIR__);
		$dotenv->load();

		//create conection
		$talker = Talker::create( $_ENV['MKT_IP'], $_ENV['MKT_USER'], $_ENV['MKT_PASS']);		
	    $talker->initialize();
		
		$queue   = new QueueSimple($talker);
		$result  = $queue->set([ 'comment' => ' editado'],'*2A');
		echo($result);

		$results = $queue->getAll();
		echo(PHP_EOL);
		foreach($results as $result){
			echo($result['.id'].' '.$result['name'].PHP_EOL);
		}
		echo(PHP_EOL);

	}
	
}
