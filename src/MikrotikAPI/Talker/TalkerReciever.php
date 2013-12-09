<?php

namespace MikrotikAPI\Talker;

use MikrotikAPI\Core\Connector,
    MikrotikAPI\Util\ResultUtil,
    MikrotikAPI\Util\Util,
    MikrotikAPI\Entity\Attribute,
    MikrotikAPI\Util\DebugDumper;

/**
 * Description of TalkerReciever
 *
 * @author Lalu Erfandi Maula Yusnu nunenuh@gmail.com <http://vthink.web.id>
 * @copyright Copyright (c) 2011, Virtual Think Team.
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @category Libraries
 */
class TalkerReciever {

    private $con;
    private $result;
    private $trap = FALSE;
    private $done = FALSE;
    private $re = FALSE;
    private $debug = FALSE;

    public function __construct(Connector $con) {
        $this->con = $con;
        $this->result = new ResultUtil();
    }

    public function isTrap() {
        return $this->trap;
    }

    public function isDone() {
        return $this->done;
    }

    public function isData() {
        return $this->re;
    }

    public function isDebug() {
        return $this->debug;
    }

    public function setDebug($boolean) {
        $this->debug = $boolean;
    }

    private function parseRawToList($raw) {
        $raw = trim($raw);
        if (!empty($raw)) {
            $list = new \ArrayObject();
            $token = explode("\n", $raw);
            $a = 1;
            while ($a < count($token)) {
                next($token);
                $attr = new Attribute();
                if (!(current($token) == "!re") && !(current($token) == "!trap")) {
                    $split = explode("=", current($token));
                    $attr->setName($split[1]);
                    if (count($split) == 3) {
                        $attr->setValue($split[2]);
                    } else {
                        $attr->setValue(NULL);
                    }
                    $list->append($attr);
                }
                $a++;
            }
            if ($list->count() != 0)
                $this->result->add($list);
        }
    }

    public function getResult() {
        return $this->result;
    }

    public function doRecieving() {
        $this->run();
    }

    private function runDebugger($string) {
        if ($this->isDebug()) {
            DebugDumper::dump($string);
        }
    }

    private function run() {
        $s = "";
        while (true) {
            $s = $this->con->recieveStream();
            if (Util::contains($s, "!re")) {
                $this->parseRawToList($s);
                $this->runDebugger($s);
                $this->re = TRUE;
            }

            if (Util::contains($s, "!trap")) {
                $this->runDebugger($s);
                $this->trap = TRUE;
                break;
            }

            if (Util::contains($s, "!done")) {
                $this->runDebugger($s);
                $this->done = TRUE;
                break;
            }
        }
    }

}
