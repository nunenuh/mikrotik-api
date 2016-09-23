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

class Type {

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
    public function print() {
        $sentence = new SentenceUtil();
        $sentence->fromCommand("/queue/type/print");
        $this->talker->send($sentence);
        $rs = $this->talker->getResult();
        $i = 0;
        if ($i < $rs->size()) {
            return $rs->getResultArray();
        } else {
            return "No Queue type to Set, Please your Add Queue type";
        }
    }

    /**
     * This method is used to set simple queue rules
     * @param type $target string
     * @param type $name string
     * @param type $maxLimit string
     * @return type array
     */
    
    public function addPCQ($name, $kind, $pcq_rate,$pcq_classifier) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/queue/type/add");
        $sentence->setAttribute("name", $name);
        $sentence->setAttribute("kind", $kind);
        $sentence->setAttribute("pcq-rate", $pcq_rate);
        $sentence->setAttribute("pcq-classifier", $pcq_classifier);
        $this->talker->send($sentence);
        return "Success";
    }

}
