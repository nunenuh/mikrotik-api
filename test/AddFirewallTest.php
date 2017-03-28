<?php
use MikrotikAPI\Talker\Talker;
use MikrotikAPI\Commands\IP\Firewall\FirewallAddressList;
use MikrotikAPI\Commands\IP\Address;
use PHPUnit\Framework\TestCase;

/**
*  Set QueuePCQ test
*/
class AddFirewallTest extends TestCase
{
	public function testAddFirewallAddress()
	{	
		//load enviroment variables
		$dotenv = new Dotenv\Dotenv(__DIR__);
		$dotenv->load();

		//create conection
		$talker = Talker::create( $_ENV['MKT_IP'], $_ENV['MKT_USER'], $_ENV['MKT_PASS']);		
	    $talker->initialize();
		
		$address = new FirewallAddressList($talker);
		// setQueuePCQ($target,$pcq_down,$pcq_up) {
		//$result = $address->add(['list' => 'morosos' ,'address' => '192.168.0.2', 'comment' => 'OSMELL CAICEDO']);
		$results = $address->getall();
		// foreach($results as $result){
		// 	echo($result['address']);
		// }
	}
	
}
