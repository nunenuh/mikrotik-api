# mikrotik-api
Mikrotik API PHP Library

This composer package for the Mikrotik API enables you to easily control Mikrotik routers via the PHP API.
This package was originally developed by nunenuh but seems to be no longer active hence the reason for this.

## How to Install
    composer require xwiz/mikrotik-api

## How to Use
Specify the desired namespaces in your class

    use MikrotikAPI\Talker\Talker;
    use MikrotikAPI\Commands\IP\Hotspot\HotspotUserProfiles;

Initialize the talker class and dump hotspot user profiles (assuming you have hotspot setup)

    $talker = Talker::create('192.168.88.1', 'admin', '');
    $profiles = new HotspotUserProfiles($talker);
    var_dump($talker->getAll());//prints an array of installed hotspot user profiles
    
## Contributing
Please create an issue to discuss or pull request accordingly.
