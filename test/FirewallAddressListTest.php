<?php
use MikrotikAPI\Talker\Talker;
use MikrotikAPI\Commands\IP\Firewall\FirewallAddressList;
use PHPUnit\Framework\TestCase;

/**
*  Set QueuePCQ test
*/
class FirewallAddressListTest extends TestCase
{
	public function testFirewallAddressListGetAll()
	{	
		//load enviroment variables
		$dotenv = new Dotenv\Dotenv(__DIR__);
		$dotenv->load();

		//create conection
		$talker = Talker::create( $_ENV['MKT_IP'], $_ENV['MKT_USER'], $_ENV['MKT_PASS']);		
	    $talker->initialize();
		
		$address = new FirewallAddressList($talker);
		$results = $address->getall();
		echo(PHP_EOL);
		foreach($results as $result){
			echo($result['address'].PHP_EOL);
		}
	}
	
}
