<?php
use MikrotikAPI\Talker\Talker;
use MikrotikAPI\Commands\PPP\Profile;
use PHPUnit\Framework\TestCase;

/**
*  Set QueuePCQ test
*/
class PppProfileTest extends TestCase
{
	public function testPppProfileGetAll()
	{	
		//load enviroment variables
		$dotenv = new Dotenv\Dotenv(__DIR__);
		$dotenv->load();

		//create conection
		$talker = Talker::create( $_ENV['MKT_IP'], $_ENV['MKT_USER'], $_ENV['MKT_PASS']);		
	    $talker->initialize();
		
		$profile = new Profile($talker);
		$param = array(
				'name'           => '1M 31 Marzo',
				'kind'           => 'pcq',
				'pcq-rate'       => '1048576',
				'pcq-classifier' => 'src-address',
			);
		
		$results = $profile->getAll();

		echo(PHP_EOL);
		foreach($results as $result){
			echo($result['.id'].PHP_EOL);
		}
	}
	
}
