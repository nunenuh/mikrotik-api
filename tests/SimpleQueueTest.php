<?php
use MikrotikAPI\Talker\Talker;
use MikrotikAPI\Commands\Queue\Simple;
use PHPUnit\Framework\TestCase;

/**
* 
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
		$simple = new Simple($talker);
		//$listQueues = $simple->getAll();
		$simple->set('10.10.16.240','prueba','2M/2M');
		
		//var_dump($listQueues);//prints an array of installed hotspot user profiles
		
	}
	
}
