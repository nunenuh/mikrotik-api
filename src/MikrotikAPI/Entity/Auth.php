<?php

namespace MikrotikAPI\Entity;

/**
 * Description of Auth
 *
 * @author nunenuh
 */
class Auth {

    /**
     *
     * @var string
     */
    private $host;

    /**
     *
     * @var int 
     */
    private $port = 8728;

    /**
     *
     * @var string
     */
    private $username;

    /**
     *
     * @var string 
     */
    private $password;

    /**
     *
     * @var boolean 
     */
    private $debug = FALSE;

    /**
     *
     * @var int
     */
    private $attempts = 5;

    /**
     *
     * @var int
     */
    private $delay = 2;

    /**
     *
     * @var int
     */
    private $timeout = 2;

    function __construct() {
        
    }

    public function set($host, $port, $username, $password, $debug, $attempts, $delay, $timeout) {
        $this->host = $host;
        $this->port = $port;
        $this->username = $username;
        $this->password = $password;
        $this->debug = $debug;
        $this->attempts = $attempts;
        $this->delay = $delay;
        $this->timeout = $timeout;
    }

    public function getHost() {
        return $this->host;
    }

    public function getPort() {
        return $this->port;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getDebug() {
        return $this->debug;
    }

    public function getAttempts() {
        return $this->attempts;
    }

    public function getDelay() {
        return $this->delay;
    }

    public function getTimeout() {
        return $this->timeout;
    }

    public function setHost($host) {
        $this->host = $host;
    }

    public function setPort($port) {
        $this->port = $port;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setDebug($debug) {
        $this->debug = $debug;
    }

    public function setAttempts($attempts) {
        $this->attempts = $attempts;
    }

    public function setDelay($delay) {
        $this->delay = $delay;
    }

    public function setTimeout($timeout) {
        $this->timeout = $timeout;
    }

}
