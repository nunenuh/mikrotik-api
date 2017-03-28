<?php
use MikrotikAPI\Talker\Talker;
use MikrotikAPI\Commands\IP\Address;
use PHPUnit\Framework\TestCase;

class ConnectionTest extends TestCase
{
	public function testConnection()
	{	
		//load enviroment variables
		$dotenv = new Dotenv\Dotenv(__DIR__);
		$dotenv->load();

		//create conection
		$talker = Talker::create( $_ENV['MKT_IP'], $_ENV['MKT_USER'], $_ENV['MKT_PASS']);		
	    $talker->initialize();
        $address = new address($talker);
        // PHP_EOL
        $listIP = $address->detail_address_where('interface','ether1');
        echo(PHP_EOL);
        print_r($listIP);
	}
}
