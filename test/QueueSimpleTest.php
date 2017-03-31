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
		
		$queue = new QueueSimple($talker);
		$param = array(
				'target'    => '192.168.0.1',
				'name'      => 'Prueba 1- 31 Marzo',
				'max-limit' => '1M',
				);
		$result = $queue->add($param);

		echo(PHP_EOL);
		echo($result);

		$param = array(
				'target' => '192.168.0.1',
				'name'   => 'Prueba 2 - 31 Marzo',
				'queue'  => '1MB Down/1MB Up',
				);
		$result = $queue->add($param);

		echo(PHP_EOL);
		echo($result);
	}
	
}
