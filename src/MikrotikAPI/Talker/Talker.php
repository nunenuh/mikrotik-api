<?php

namespace MikrotikAPI\Talker;

use MikrotikAPI\Entity\Auth;
use MikrotikAPI\Core\Connector;
use MikrotikAPI\MikrotikException;
use MikrotikAPI\Core\RouterosAPI;

/**
 * Description of Talker
 *
 * @author Lalu Erfandi Maula Yusnu nunenuh@gmail.com <http://vthink.web.id>
 * @author Chibueze Opata opatachibueze@gmail.com <http://robosyslive.com>
 * @copyright Copyright (c) 2016, SCI Team.
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @category Libraries
 * @property TalkerReciever
 * @property TalkerSender
 */
class Talker {

    private $sender;
    private $reciever;
    private $auth;
    private $connector;
    private $useROS;
    private $routerAPI;
    private $connected = FALSE;
    private $initialized = FALSE;

    public function __construct(Auth $auth, $useROS = true) {
        $this->auth = $auth;

        $this->useROS = $useROS;
        if($useROS){
            $this->routerAPI = new RouterosAPI;
        }
    }

    public function create($ip, $username, $password, $useROS = true){
        $connect = new Auth($ip, $username, $password);
        $talker = new static($connect, $useROS);
        return $talker;
    }

    public function initialize() {        
        $auth = $this->auth;
        $this->connector = new Connector($auth->getHost(), $auth->getPort(), $auth->getUsername(), $auth->getPassword());
        if($this->useROS){
            $this->routerAPI->connect($auth->getHost(), $auth->getUsername(), $auth->getPassword());
            $this->sender = new TalkerSender($this->connector, $this->routerAPI, TRUE);
            $this->reciever = new TalkerReciever($this->connector, $this->routerAPI, TRUE);
            $this->connected = $this->routerAPI->isConnected();
        }
        else{
            $this->connector->connect();
            $tries = 0;
            while(!$this->connector->isConnected() && $tries != $auth->getAttempts())        
            {
                $this->connector->connect();
                sleep(2);
            }
            //failed to connect
            if($tries == $auth->getAttempts())
            {
                throw new MikrotikException('Could not connect to Mikrotik');
            }
            $this->sender = new TalkerSender($this->connector);
            $this->reciever = new TalkerReciever($this->connector);
            $this->connected = $this->connector->isConnected();
        }
        $this->initialized = TRUE;
    }

    public function closeConnection()
    {
        if($this->useROS){
            $this->routerAPI->disconnect();
        }
        else{
            $this->connector->close();
        }
    }

    /**
     * 
     * @return type
     */
    public function isLogin() {
        //        return parent::isLogin();
    }

    /**
     * 
     * @return type
     */
    public function isConnected() {
        return $this->connected;
    }

    /**
     * 
     * @return type
     */
    public function isDebug() {
        return $this->auth->getDebug();
    }

    /**
     * 
     * @param type $boolean
     */
    public function setDebug($boolean) {
        $this->auth->setDebug($boolean);
        $this->sender->setDebug($boolean);
        $this->reciever->setDebug($boolean);
    }

    /**
     * 
     * @return type
     */
    public function isTrap() {
        return $this->reciever->isTrap();
    }

    /**
     * 
     * @return type
     */
    public function isDone() {
        return $this->reciever->isDone();
    }

    /**
     * 
     * @return type
     */
    public function isData() {
        return $this->reciever->isData();
    }

    /**
     * 
     * @param type $sentence
     */
    public function send($sentence) {
        if(!$this->initialized){
            $this->initialize();
        }
        $this->sender->send($sentence);
        $this->reciever->doRecieving();
    }

    /**
     * 
     * @return type
     */
    public function getResult() {
        return $this->reciever->getResult();
    }

    /**
     * Standard destructor
     *
     * @return void
     */
    public function __destruct()
    {
        if($this->connected){
            $this->closeConnection();
        }
    }

}
