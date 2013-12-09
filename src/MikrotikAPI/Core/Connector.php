<?php

namespace MikrotikAPI\Core;

use MikrotikAPI\Core\StreamReciever,
    MikrotikAPI\Core\StreamSender,
    MikrotikAPI\Util\Util;

/**
 * Description of Connector
 *
 * @author Lalu Erfandi Maula Yusnu nunenuh@gmail.com <http://vthink.web.id>
 * @copyright Copyright (c) 2011, Virtual Think Team.
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @category Libraries
 * @property StreamSender $sender
 * @property StreamReciever $reciever
 */
class Connector {

    private $socket;
    private $sender;
    private $reciever;
    private $host;
    private $port;
    private $username;
    private $password;
    private $connected = FALSE;
    private $login = FALSE;

    public function __construct($host, $port, $username, $password) {
        $this->host = $host;
        $this->port = $port;
        $this->username = $username;
        $this->password = $password;
        $this->initStream();
    }

    public function isConnected() {
        return $this->connected;
    }

    public function isLogin() {
        return $this->login;
    }

    private function initStream() {
        $this->socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        $this->sender = new StreamSender($this->socket);
        $this->reciever = new StreamReciever($this->socket);
    }

    public function sendStream($command) {
        return $this->sender->send($command);
    }

    public function recieveStream() {
        return $this->reciever->reciever();
    }

    private function challanger($username, $password, $challange) {
        $chal = md5(chr(0) . $this->password . pack('H*', $challange));
        $login = "/login\n=name=" . $this->username . "\n=response=00" . $chal;
        return $login;
    }

    public function connect() {
        if (socket_connect($this->socket, $this->host, $this->port)) {
            $this->sendStream("/login");
            $rec = $this->recieveStream();
            if (!Util::contains($rec, "!trap") && strlen($rec) > 0) {
                $word = explode("\n", $rec);
                if (count($word) > 1) {
                    $split = explode("=ret=", $word[2]);
                    $challange = $split[1];
                    $challanger = $this->challanger($this->username, $this->password, $challange);
                    $this->sendStream($challanger);
                    $res = $this->recieveStream();
                    if (Util::contains($res, "!done") && !Util::contains($res, "!trap")) {
                        $this->login = TRUE;
                    }
                }
            }
            $this->connected = TRUE;
        } else {
            $this->connected = FALSE;
        }
    }

}
