<?php

namespace MikrotikAPI\Commands\IP;

use MikrotikAPI\Talker\Talker,
    MikrotikAPI\Util\SentenceUtil;

/**
 * Description of Address
 *
 * @author      Lalu Erfandi Maula Yusnu nunenuh@gmail.com <http://vthink.web.id>
 * @copyright   Copyright (c) 2011, Virtual Think Team.
 * @license     http://opensource.org/licenses/gpl-license.php GNU Public License
 * @category	Libraries
 */
class Address {

    /**
     *
     * @var type array
     */
    private $talker;

    function __construct(Talker $talker) {
        $this->talker = $talker;
    }

    /**
     * This method is used to add the ip address
     * @param type $address string
     * @param type $interface string
     * @param type $comment string
     * @return type array
     */
    public function add($param) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/ip/address/add");
        foreach ($param as $name => $value) {
            $sentence->setAttribute($name, $value);
        }
        $this->talker->send($sentence);
        return "Success";
    }

    /**
     * This method is used to display all ip address
     * @return type array
     * 
     */
    public function getAll() {
        $sentence = new SentenceUtil();
        $sentence->fromCommand("/ip/address/getall");
        $this->talker->send($sentence);
        $rs = $this->talker->getResult();
        $i = 0;
        if ($i < $rs->size()) {
            return $rs->getResultArray();
        } else {
            return "No Ip Address To Set, Please Your Add Ip Address";
        }
    }

    /**
     * This method is used to activate the ip address by id
     * @param type $id is not an array
     * @return type array
     * 
     * 
     */
    public function enable($id) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/ip/address/enable");
        $sentence->where(".id", "=", $id);
        $enable = $this->talker->send($sentence);
        return "Success";
    }

    /**
     * This method is used to disable ip address by id
     * @param type $id string 
     * @return type array
     * 
     * 
     */
    public function disable($id) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/ip/address/disable");
        $sentence->where(".id", "=", $id);
        $this->talker->send($sentence);
        return "Success";
    }

    /**
     * This method is used to remove the ip address by id
     * @param type $id is not an array
     * @return type array
     * 
     */
    public function delete($id) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/ip/address/remove");
        $sentence->where(".id", "=", $id);
        $enable = $this->talker->send($sentence);
        return "Success";
    }

    /**
     * This method is used to set or edit by id
     * @param type $param array
     * @return type array
     * 
     */
    public function set($param, $id) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/ip/address/set");
        foreach ($param as $name => $value) {
            $sentence->setAttribute($name, $value);
        }
        $sentence->where(".id", "=", $id);
        $this->talker->send($sentence);
        return "Success";
    }

    /**
     * This method is used to display one ip address 
     * in detail based on the id
     * @param type $id not string
     * @return type array
     * 
     */
    public function detail_address($id) {
        $sentence = new SentenceUtil();
        $sentence->fromCommand("/ip/address/print");
        $sentence->where(".id", "=", $id);
        $this->talker->send($sentence);
        $rs = $this->talker->getResult();
        $i = 0;
        if ($i < $rs->size()) {
            return $rs->getResultArray();
        } else {
            return "No Ip Address With This .id = " . $id;
        }
    }

    /**
     * This method is used to display one list address 
     * in detail based on one param
     * @param type string
     * @return type array
     * 
     */
    
    public function detail_address_where($param,$value) {
        $sentence = new SentenceUtil();
        $sentence->fromCommand("/ip/address/print");
        $sentence->where($param, "=", $value);
        $this->talker->send($sentence);
        $rs = $this->talker->getResult();
        $i = 0;
        if ($i < $rs->size()) {
            return $rs->getResultArray();
        } else {
            return "No Ip Address With This ". $param . " = " . $value;
        }
    }

}
