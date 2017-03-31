<?php

namespace MikrotikAPI\Commands\Queue;

use MikrotikAPI\Talker\Talker,
    MikrotikAPI\Util\SentenceUtil;

/**
 * Description Simple
 *
 * @author      Osmell Caicedo correo.oele@gmail.com
 * @license     http://opensource.org/licenses/gpl-license.php GNU Public License
 * @category    Libraries
 */

class QueueType {

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
            return "No Queue type to set, Please your add Queue type";
        }
    }

    /**
     * This method is used to set simple queue rules
     * @param type $param   array ('name','kind','pcq-rate','pcq-classifier')
     * @return type array
     */
    
    public function add($param) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/queue/type/add");
        foreach ($param as $name => $value) {
            $sentence->setAttribute($name, $value);
        }
        $this->talker->send($sentence);
        return "Success";
    }

}
