<?php

namespace MikrotikAPI\Core;

/**
 * Description of StreamSender
 *
 * @author Lalu Erfandi Maula Yusnu nunenuh@gmail.com <http://vthink.web.id>
 * @copyright Copyright (c) 2011, NuneNuh.
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @category Libraries
 */
class StreamSender {

    private $socket;

    function __construct($socket) {
        $this->socket = $socket;
    }

    private function protocolLengthEncoder($command) {
        $length = strlen($command);
        switch ($length) {
            case $length < 0x80 :
                $this->streamSender(chr($length));
                break;
            case $length < 0x4000:
                $length |= 0x8000;
                $this->streamSender(chr(($length >> 8 ) & 0xFF));
                $this->streamSender(chr($length & 0xFF));
                break;
            case $length < 0x200000:
                $length |= 0xC00000;
                $this->streamSender(chr(($length >> 16) & 0xFF));
                $this->streamSender(chr(($length >> 8 ) & 0xFF));
                $this->streamSender(chr($length & 0xFF));
                break;
            case $length < 0x10000000:
                $length |= 0xE0000000;
                $this->streamSender(chr(($length >> 24 ) & 0xFF));
                $this->streamSender(chr(($length >> 16 ) & 0xFF));
                $this->streamSender(chr(($length >> 8 ) & 0xFF));
                $this->streamSender(chr($length & 0xFF));
                break;
            case $length >= 0x10000000:
                $this->streamSender(chr(0xF0));
                $this->streamSender(chr(($length >> 24) & 0x0FF));
                $this->streamSender(chr(($length >> 16) & 0x0FF));
                $this->streamSender(chr(($length >> 8 ) & 0x0FF));
                $this->streamSender(chr($length & 0x0FF));
                break;
        }
    }

    private function streamSender($command) {
        $i = 0;
        $out = 0;
        while ($i < strlen($command)) {
            $out = socket_write($this->socket, $command);
            if ($out == 0) {
                echo "Connection closed";
                echo socket_last_error($this->socket);
                break;
            }
            $i += $out;
        }
    }

    private function protocolWordEncoder($command) {
        $this->protocolLengthEncoder($command);
        $this->streamSender($command);
    }

    public function send($command) {
        $com_array = explode("\n", $command);
        if (count($com_array) > 2) {
            $ret = NULL;
            foreach ($com_array as $data) {
                $com = $data;
                $ret = $this->protocolWordEncoder($com);
            }
            $ret = $this->protocolWordEncoder('');
            return $ret;
        } else {
            $com = $com_array[0];
            $ret = $this->protocolWordEncoder($com);
            $ret = $this->protocolWordEncoder('');
        }
    }

}
