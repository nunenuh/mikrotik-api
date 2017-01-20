<?php
use MikrotikAPI\Talker\Talker;
use MikrotikAPI\Commands\Queue\Simple;
use MikrotikAPI\Commands\IP\Address;
use PHPUnit\Framework\TestCase;

/**
*  Set QueuePCQ test
*/
class AddressTest extends TestCase
{
	public function testGetAllIp()
	{	
		//load enviroment variables
		$dotenv = new Dotenv\Dotenv(__DIR__);
		$dotenv->load();

		//create conection
		$talker = Talker::create( $_ENV['MKT_IP'], $_ENV['MKT_USER'], $_ENV['MKT_PASS']);		
	    $talker->initialize();
		
		$queue = new Simple($talker);
		// setQueuePCQ($target,$pcq_down,$pcq_up) {
		$result = $queue->setQueuePCQ('192.168.0.1','ejemplo2','1M Down','1M Up');

		echo ($result);		
	}
	
}
