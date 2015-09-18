<?php

require '../vendor/autoload.php';

use MikrotikAPI\Talker\Talker;
use MikrotikAPI\Entity\Auth;
use MikrotikAPI\Commands\IP\Address;
use MikrotikAPI\MikrotikException;
use MikrotikAPI\Util\DebugDumper;


try {

    $auth = new Auth("172.18.1.254", "admin", "1261");
    $auth->setDebug(true)->setTimeout(10)->setDelay(5);

    $ipaddr = new Address(new Talker($auth));
    $listIP = $ipaddr->getAll();

    DebugDumper::dump($listIP);

} catch (MikrotikException $e) {
    echo $e->getMessage();
}
