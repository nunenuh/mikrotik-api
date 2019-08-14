<?php

namespace MikrotikAPI\Commands\Queue;

use MikrotikAPI\Talker\Talker,
    MikrotikAPI\Util\SentenceUtil;

/**
 * Description Simple
 *
 * @author      Osmell Leandro Caicedo Gelvez correo.oele@gmail.com <http://oele.co>
 * @copyright   Copyright (c) 2017, @oele_co.
 * @license     http://opensource.org/licenses/gpl-license.php GNU Public License
 * @category    Libraries
 */

class QueueSimple {

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
            return "None";
        }
    }

    /**
     * This method is used to set simple queue rules
     * @param type $param array ('target','name','max-limit')
     * @param type $param array ('target','name','queue'=> pcq_down.'/'.pcq_up )
     * @return type array
     * This method is used to add address list
     */
    
    public function add($param) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/queue/simple/add");
        foreach ($param as $name => $value) {
            $sentence->setAttribute($name, $value);
        }
        $this->talker->send($sentence);
        return "Success";
    }

    /**
     * This method is used to set or edit queue simple by id
     * @param type $param array
     * @param type $id string
     * @return type array
     * 
     */
    public function set($param, $id) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/queue/simple/set");
        foreach ($param as $name => $value) {
            $sentence->setAttribute($name, $value);
        }
        $sentence->where(".id", "=", $id);
        $this->talker->send($sentence);
        return "Success";
    }


     /**
     * This method is used to delete queue
     * @param type $id string
     * @return type array
     */
    public function delete($id) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/queue/simple/remove");
        $sentence->where(".id", "=", $id);
        $this->talker->send($sentence);
        return "Success";
    }

        /**
     * This method is used to display one simple queue
     * in detail based on the id
     * @param type $id string
     * @return type array
     * 
     */
    public function detail($id) {
        $sentence = new SentenceUtil();
        $sentence->fromCommand("/queue/simple/print");
        $sentence->where(".id", "=", $id);
        $this->talker->send($sentence);
        $rs = $this->talker->getResult();
        $i = 0;
        if ($i < $rs->size()) {
            return $rs->getResultArray();
        } else {
            return "No PPP Profile With This id = " . $id;
        }
    }

}
