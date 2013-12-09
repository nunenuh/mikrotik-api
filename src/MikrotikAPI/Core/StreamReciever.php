<?php

namespace MikrotikAPI\Core;

/**
 * Description of StreamReciever
 *
 * @author Lalu Erfandi Maula Yusnu nunenuh@gmail.com <http://vthink.web.id>
 * @copyright Copyright (c) 2011, Virtual Think Team.
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @category Libraries
 */
class StreamReciever {

    private $closed = false;
    private $socket;

    function __construct($socket) {
        $this->socket = $socket;
    }

    public function isClosed() {
        return $this->closed;
    }

    private function protocolWordDecoder() {
        return $this->streamReciever($this->protocolLengthDecoder());
    }

    private function streamReciever($length) {
        $recieved = "";
        while (strlen($recieved) < $length) {
            $len = $length - strlen($recieved);
            $str = socket_read($this->socket, $len);
            if ($str == '') {
                $this->closed = TRUE;
                echo socket_last_error($this->socket);
                break;
            }
            $recieved = $recieved . $str;
        }
        return $recieved;
    }

    private function protocolLengthDecoder() {
        $byte = ord($this->streamReciever(1));
        if (($byte & 0x80) == 0x00) {
            $byte = $byte;
        } else if (($byte & 0xC0) == 0x80) {
            $byte &= ~0xC0;
            $byte <<= 8;
            $byte += ord($this->streamReciever(1));
        } else if (($byte & 0xE0) == 0xC0) {
            $byte &= ~0xE0;
            $byte <<= 8;
            $byte += ord($this->streamReciever(1));
            $byte <<= 8;
            $byte += ord($this->streamReciever(1));
        } else if (($byte & 0xF0) == 0xE0) {
            $byte &= ~0xF0;
            $byte <<= 8;
            $byte += ord($this->streamReciever(1));
            $byte <<= 8;
            $byte += ord($this->streamReciever(1));
            $byte <<= 8;
            $byte += ord($this->streamReciever(1));
        } else if (($byte & 0xF8) == 0x0F0) {
            $byte = ord($this->streamReciever(1));
            $byte <<= 8;
            $byte += ord($this->streamReciever(1));
            $byte <<= 8;
            $byte += ord($this->streamReciever(1));
            $byte <<= 8;
            $byte += ord($this->streamReciever(1));
        }
        return $byte;
    }

    public function reciever() {
        $out = "";
        $i = 0;
        while (true) {
            $word = $this->protocolWordDecoder();
            if (strlen($word) != 0 && strlen($word) > 0) {
                $out = $out . "\n" . $word;
            } else {
                break;
            }
            $i++;
        }
        return $out;
    }

    private function getSocketStatus() {
        return socket_get_status($this->socket);
    }

}
