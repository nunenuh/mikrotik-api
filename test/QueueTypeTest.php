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
		$param = array(
				'name'           => '1M 31 Marzo',
				'kind'           => 'pcq',
				'pcq-rate'       => '1048576',
				'pcq-classifier' => 'src-address',
			);
		
		$result = $queueType->add($param);

		echo(PHP_EOL);
		echo($result);
	}
	
}
