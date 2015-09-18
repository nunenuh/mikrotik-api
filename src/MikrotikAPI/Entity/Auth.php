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

    function __construct($host, $username, $password) {

        $this->setHost($host);
        $this->setUsername($username);
        $this->setPassword($password);

        return $this;
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

        return $this;
    }

    public function setPort($port) {
        $this->port = $port;

        return $this;
    }

    public function setUsername($username) {
        $this->username = $username;

        return $this;
    }

    public function setPassword($password) {
        $this->password = $password;

        return $this;
    }

    public function setDebug($debug) {
        $this->debug = $debug;

        return $this;
    }

    public function setAttempts($attempts) {
        $this->attempts = $attempts;

        return $this;
    }

    public function setDelay($delay) {
        $this->delay = $delay;

        return $this;
    }

    public function setTimeout($timeout) {
        $this->timeout = $timeout;

        return $this;
    }

}
