<?php

namespace MikrotikAPI\Commands\Queue;

use MikrotikAPI\Talker\Talker,
    MikrotikAPI\Util\SentenceUtil;

/**
 * Description Type
 *
 * @author      Osmell Leandro Caicedo Gelvez correo.oele@gmail.com <http://oele.co>
 * @copyright   Copyright (c) 2017, @oele_co.
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

    /**
     * This method is used to set or edit queue type by id
     * @param type $param array
     * @param type $id string
     * @return type array
     * 
     */
    public function set($param, $id) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/queue/type/set");
        foreach ($param as $name => $value) {
            $sentence->setAttribute($name, $value);
        }
        $sentence->where(".id", "=", $id);
        $this->talker->send($sentence);
        return "Success";
    }

    /**
     * This method is used to remove queue type by id
     * @param type $id string
     * @return type array
     * 
     */
    public function delete($id) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/queue/type/remove");
        $sentence->where(".id", "=", $id);
        $enable = $this->talker->send($sentence);
        return "Success";
    }

}
