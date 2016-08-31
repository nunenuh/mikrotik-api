<?php

namespace MikrotikAPI\Commands\Queue;

use MikrotikAPI\Util\SentenceUtil,
    MikrotikAPI\Talker\Talker;

/**
 * Description Simple
 *
 * @author      Osmell Caicedo correo.oele@gmail.com
 * @license     http://opensource.org/licenses/gpl-license.php GNU Public License
 * @category    Libraries
 */

class Simple {

    /**
     *
     * @var type array
     */
    private $talker;

    function __construct(Talker $talker) {
        $this->talker = $talker;
    }

    /**
     * This method is used to display all Simple Queue rules
     * @return type array
     */
    public function getAll() {
        $sentence = new SentenceUtil();
        $sentence->fromCommand("/queue/simple/getall");
        $this->talker->send($sentence);
        $rs = $this->talker->getResult();
        $i = 0;
        if ($i < $rs->size()) {
            return $rs->getResultArray();
        } else {
            return "No Simple Queue To Set, Please Your Add Simple Queue";
        }
    }

    /**
     * This method is used to set simple queue rules
     * @param type $target string
     * @param type $name string
     * @param type $maxLimit string
     * @return type array
     */
    
    public function set($target, $name, $maxLimit) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/queue/simple/add");
        $sentence->setAttribute("target", $target);
        $sentence->setAttribute("name", $name);
        $sentence->setAttribute("max-limit", $maxLimit);
        $this->talker->send($sentence);
        return "Success";
    }

}
