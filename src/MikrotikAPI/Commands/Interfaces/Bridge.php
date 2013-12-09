<?php

namespace MikrotikAPI\Commands\Interfaces;

use MikrotikAPI\Util\SentenceUtil,
    MikrotikAPI\Talker\Talker;

/**
 * Description of Mapi_interface_Bridge
 *
 * @author Lalu Erfandi Maula Yusnu nunenuh@gmail.com <http://vthink.web.id>
 * @copyright Copyright (c) 2011, Virtual Think Team.
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @category Libraries
 */
class Bridge {

    private $talker;

    function __construct(Talker $talker) {
        $this->talker = $talker;
    }

    /**
     * This method used for add new interface bridge
     * @param type $param array
     * @return type array
     */
    public function add_bridge($param) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/interface/bridge/add");
        foreach ($param as $name => $value) {
            $sentence->setAttribute($name, $value);
        }
        $this->talker->send($sentence);
        return "Sucsess";
    }

    /**
     * This method used for disable interface bridge
     * @param type $id string
     * @return type array
     */
    public function disable_bridge($id) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/interface/bridge/disable");
        $sentence->where(".id", "=", $id);
        $this->talker->send($sentence);
        return "Sucsess";
    }

    /**
     * This method used for enable interface bridge
     * @param type $id string
     * @return type array
     */
    public function enable_bridge($id) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/interface/bridge/enable");
        $sentence->where(".id", "=", $id);
        $this->talker->send($sentence);
        return "Sucsess";
    }

    /**
     * This method used for delete interface bridge
     * @param type $id string
     * @return type array
     */
    public function delete_bridge($id) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/interface/bridge/remove");
        $sentence->where(".id", "=", $id);
        $this->talker->send($sentence);
        return "Sucsess";
    }

    /**
     * This method used for get all interface bridge
     * @return type array
     */
    public function get_all_bridge() {
        $sentence = new SentenceUtil();
        $sentence->fromCommand("/interface/bridge/getall");
        $this->talker->send($sentence);
        $rs = $this->talker->getResult();
        $i = 0;
        if ($i < $rs->size()) {
            return $rs->getResultArray();
        } else {
            return "No Interface Bridge To Set, Please Your Add Interface Bridge";
        }
    }

    /**
     * This method used for set or edit interface bridge
     * @param type $param array
     * @param type $id string
     * @return type array
     */
    public function set_bridge($param, $id) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/interface/bridge/set");
        foreach ($param as $name => $value) {
            $sentence->setAttribute($name, $value);
        }
        $sentence->where(".id", "=", $id);
        $this->talker->send($sentence);
        return "Sucsess";
    }

    /**
     * This method used for detail interface bridge
     * @param type $id string
     * @return type array
     */
    public function detail_bridge($id) {
        $sentence = new SentenceUtil();
        $sentence->fromCommand("/interface/bridge/print");
        $sentence->where(".id", "=", $id);
        $this->talker->send($sentence);
        $rs = $this->talker->getResult();
        $i = 0;
        if ($i < $rs->size()) {
            return $rs->getResultArray();
        } else {
            return "No Interface Bridge With This id = " . $id;
        }
    }

    public function add_bridge_nat($param) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/interface/bridge/nat/add");
        foreach ($param as $name => $value) {
            $sentence->setAttribute($name, $value);
        }
        $this->talker->send($sentence);
        return "Sucsess";
    }

    /**
     * This method used for disable interface bridge
     * @param type $id string
     * @return type array
     */
    public function disable_bridge_nat($id) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/interface/bridge/nat/disable");
        $sentence->where(".id", "=", $id);
        $this->talker->send($sentence);
        return "Sucsess";
    }

    /**
     * This method used for enable interface bridge
     * @param type $id string
     * @return type array
     */
    public function enable_bridge_nat($id) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/interface/bridge/nat/enable");
        $sentence->where(".id", "=", $id);
        $this->talker->send($sentence);
        return "Sucsess";
    }

    /**
     * This method used for delete interface bridge
     * @param type $id string
     * @return type array
     */
    public function delete_bridge_nat($id) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/interface/bridge/nat/remove");
        $sentence->where(".id", "=", $id);
        $this->talker->send($sentence);
        return "Sucsess";
    }

    /**
     * This method used for get all interface bridge
     * @return type array
     */
    public function get_all_bridge_nat() {
        $sentence = new SentenceUtil();
        $sentence->fromCommand("/interface/bridge/nat/getall");
        $this->talker->send($sentence);
        $rs = $this->talker->getResult();
        $i = 0;
        if ($i < $rs->size()) {
            return $rs->getResultArray();
        } else {
            return "No Interface Bridge NAT To Set, Please Your Add Interface Bridge NAT";
        }
    }

    /**
     * This method used for set or edit interface bridge
     * @param type $param array
     * @param type $id string
     * @return type array
     */
    public function set_bridge_nat($param, $id) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/interface/bridge/nat/set");
        foreach ($param as $name => $value) {
            $sentence->setAttribute($name, $value);
        }
        $sentence->where(".id", "=", $id);
        $this->talker->send($sentence);
        return "Sucsess";
    }

    /**
     * This method used for detail interface bridge
     * @param type $id string
     * @return type array
     */
    public function detail_bridge_nat($id) {
        $sentence = new SentenceUtil();
        $sentence->fromCommand("/interface/bridge/nat/print");
        $sentence->where(".id", "=", $id);
        $this->talker->send($sentence);
        $rs = $this->talker->getResult();
        $i = 0;
        if ($i < $rs->size()) {
            return $rs->getResultArray();
        } else {
            return "No Interface Bridge NAT With This id = " . $id;
        }
    }

    /**
     * This method used for set interface Bridge Settings
     * @param type $use_ip_firewall string (default : yes or no)
     * @param type $use_ip_firewall_for_vlan string (default : yes or no)
     * @param type $use_ip_firewall_for_pppoe string (default : yes or no)
     * @return type array
     */
    public function set_bridge_settings($use_ip_firewall, $use_ip_firewall_for_vlan, $use_ip_firewall_for_pppoe) {
        $sentence = new SentenceUtil();
        $sentence->fromCommand("/interface/bridge/settings/set");
        $sentence->setAttribute("use-ip-firewall", $use_ip_firewall);
        $sentence->setAttribute("use-ip-firewall-for-vlan", $use_ip_firewall_for_vlan);
        $sentence->setAttribute("use-ip-firewall-for-pppoe", $use_ip_firewall_for_pppoe);
        $this->talker->send($sentence);
        return "Sucsess";
    }

    /**
     * This method used for get all interface Bridge Settings
     * @return type array
     */
    public function get_all_bridge_settings() {
        $sentence = new SentenceUtil();
        $sentence->fromCommand("/interface/bridge/settings/getall");
        $this->talker->send($sentence);
        $rs = $this->talker->getResult();
        $i = 0;
        if ($i < $rs->size()) {
            return $rs->getResultArray();
        } else {
            return "No Interface Bridge Settings To Set, Please Your Add Interface Bridge Settings";
        }
        return $this->query('');
    }

}
