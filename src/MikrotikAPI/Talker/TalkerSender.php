<?php

namespace MikrotikAPI\Talker;

use MikrotikAPI\Core\Connector,
MikrotikAPI\Util\SentenceUtil,
MikrotikAPI\Entity\Attribute,
MikrotikAPI\Util\Util,
MikrotikAPI\Util\DebugDumper;

/**
 * Class for talking/sending commands to the Mikrotik API/Router
 *
 * @author Lalu Erfandi Maula Yusnu nunenuh@gmail.com <http://vthink.web.id>
 * @author Chibueze Opata opatachibueze@gmail.com <http://robosyslive.com>
 * @copyright Copyright (c) 2011, Virtual Think Team.
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @category Libraries
 */
class TalkerSender {

    private $debug = FALSE;
    private $con;
    private $useROS;
    private $routerAPI;

    public function __construct(Connector $con, $routerAPI = null, $useROS = FALSE) {
        $this->con = $con;
        $this->routerAPI = $routerAPI;
        $this->useROS = $useROS;
    }

    public function send(SentenceUtil $sentence) {
        $cmd = $this->createSentence($sentence);
        if($this->useROS){
            $this->routerAPI->write($cmd);
        }
        else{
            $this->con->sendStream($cmd);
        }
    }

    public function isDebug() {
        return $this->debug;
    }

    public function setDebug($boolean) {
        $this->debug = $boolean;
    }

    public function runDebugger($str) {
        if ($this->isDebug()) {
            DebugDumper::dump($str);
        }
    }

    private function sentenceWrapper(SentenceUtil $sentence) {
        $it = $sentence->getBuildCommand()->getIterator();

        $attr = null;
        $main = new \ArrayObject();
        $append = new \ArrayObject();
        while ($it->valid()) {
            if (Util::contains($it->current()->getClause(), "commandPrint") ||
                Util::contains($it->current()->getClause(), "commandReguler")) {
                if($attr == null){
                    $main->append($it->current());
                }
            }
            else{
                //if contains neither then add to append commands
                $append->append($it->current());
            }
            $it->next();
        }

        foreach($append->getIterator() as $a)
        {
            $main->append($a);
        }
        /*

        $it->rewind();

        while ($it->valid()) {
            if (!Util::contains($it->current()->getClause(), "commandPrint") &&
                !Util::contains($it->current()->getClause(), "commandReguler")) {
            }
            $it->next();
        }
*/
        return $main;
    }

    private function createSentence(SentenceUtil $sentence) {
        $build = "";
        $sentence = $this->sentenceWrapper($sentence);
        $it = $sentence->getIterator();
        $cmd = "";

        while ($it->valid()) {
            $clause = $it->current()->getClause();
            $name = $it->current()->getName();
            $value = $it->current()->getValue();

            if (Util::contains($clause, "commandPrint")) {
                $build = $build . $value;
                $cmd = "print";
            } else if (Util::contains($clause, "commandReguler")) {
                $build = $build . $value;
                $cmd = "reguler";
            } else {
                if (Util::contains($name, "proplist") || Util::contains($name, "tag")) {
                    $build = $build . "=." . $name . "=" . $value;
                }

                if ($clause == "where" && $cmd == "print") {
                    $build = $build . "?" . $name . $value;
                }

                if ($clause == "where" && $cmd == "reguler") {
                    $build = $build . $name . $value;
                }

                if ($clause == "whereNot" || $clause == "orWhere" ||
                    $clause == "orWhereNot" || $clause == "andWhere" ||
                    $clause == "andWhereNot") {
                    $build = $build . $name . $value;
                }

                if ($clause == "setAttribute") {
                    $build = $build . "=" . $name . "=" . $value;
                }
            }
            if ($it->valid())
                $build = $build . "\n";
            $it->next();
        }
        $this->runDebugger($build);
        return $build;
    }

}
