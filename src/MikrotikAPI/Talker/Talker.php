<?php

namespace MikrotikAPI\Talker;

use MikrotikAPI\Entity\Auth;
use MikrotikAPI\Core\Connector;

/**
 * Description of Talker
 *
 * @author Lalu Erfandi Maula Yusnu nunenuh@gmail.com <http://vthink.web.id>
 * @copyright Copyright (c) 2011, Virtual Think Team.
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

//        private $param;


    public function __construct(Auth $auth) {
//        parent::__construct($auth->getHost(), $auth->getPort(), $auth->getUsername(), $auth->getPassword());
//        parent::connect();
        $this->auth = $auth;
        $this->connector = new Connector($auth->getHost(), $auth->getPort(), $auth->getUsername(), $auth->getPassword());
        $this->connector->connect();
        $this->sender = new TalkerSender($this->connector);
        $this->reciever = new TalkerReciever($this->connector);
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
//        return parent::isConnected();
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

}
