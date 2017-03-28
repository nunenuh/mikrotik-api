<?php
use MikrotikAPI\Talker\Talker;
use MikrotikAPI\Commands\Interfaces\Printing;
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
        $interfaces = new Printing($talker);
        // PHP_EOL
        $results = $interfaces->getAll();
        echo(PHP_EOL);
        foreach ($results as $result) {
        	# code...
        	echo($result['name'].PHP_EOL);
        }
	}
}
