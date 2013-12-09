<?php

//load parent class Connector
require 'mikrotik/core/core/Connector.php';
require 'mikrotik/core/core/StreamReciever.php';
require 'mikrotik/core/core/StreamSender.php';

//load parent class Entity
require 'mikrotik/core/entity/Attribute.php';

//load parent class Talker
require 'mikrotik/core/talker/Talker.php';
require 'mikrotik/core/talker/TalkerReciever.php';
require 'mikrotik/core/talker/TalkerSender.php';

//load parent class Util
require 'mikrotik/core/util/ResultUtil.php';
require 'mikrotik/core/util/SentenceUtil.php';
require 'mikrotik/core/util/Util.php';

//require 'mikrotik/core/mapi_core.php';
//require 'mikrotik/core/mapi_query.php';
//load child class interface
require 'mikrotik/interface/mapi_interface_ethernet.php';
require 'mikrotik/interface/mapi_interface_pppoe_client.php';
require 'mikrotik/interface/mapi_interface_pppoe_server.php';
require 'mikrotik/interface/mapi_interface_eoip.php';
require 'mikrotik/interface/mapi_interface_ipip.php';
require 'mikrotik/interface/mapi_interface_vlan.php';
require 'mikrotik/interface/mapi_interface_vrrp.php';
require 'mikrotik/interface/mapi_interface_bonding.php';
require 'mikrotik/interface/mapi_interface_bridge.php';
require 'mikrotik/interface/mapi_interface_l2tp_client.php';
require 'mikrotik/interface/mapi_interface_l2tp_server.php';
require 'mikrotik/interface/mapi_interface_ppp_client.php';
require 'mikrotik/interface/mapi_interface_ppp_server.php';
require 'mikrotik/interface/mapi_interface_pptp_client.php';
require 'mikrotik/interface/mapi_interface_pptp_server.php';
require 'mikrotik/interface/mapi_interfaces.php';

//load child class ip
require 'mikrotik/ip/mapi_ip.php';
require 'mikrotik/ip/mapi_ip_dhcp_client.php';
require 'mikrotik/ip/mapi_ip_dhcp_relay.php';
require 'mikrotik/ip/mapi_ip_dhcp_server.php';
require 'mikrotik/ip/mapi_ip_route.php';
require 'mikrotik/ip/mapi_ip_service.php';
require 'mikrotik/ip/mapi_ip_address.php';
require 'mikrotik/ip/mapi_ip_hotspot.php';
require 'mikrotik/ip/mapi_ip_dns.php';
require 'mikrotik/ip/mapi_ip_accounting.php';
require 'mikrotik/ip/mapi_ip_arp.php';
require 'mikrotik/ip/mapi_ip_pool.php';
require 'mikrotik/ip/mapi_ip_firewall.php';
require 'mikrotik/ip/mapi_ip_proxy.php';

//load child class ppp
require 'mikrotik/ppp/mapi_ppp.php';
require 'mikrotik/ppp/mapi_ppp_profile.php';
require 'mikrotik/ppp/mapi_ppp_secret.php';
require 'mikrotik/ppp/mapi_ppp_aaa.php';
require 'mikrotik/ppp/mapi_ppp_active.php';

//load child class system
require 'mikrotik/system/mapi_system.php';
require 'mikrotik/system/mapi_system_scheduler.php';

//load child class file
require 'mikrotik/file/mapi_file.php';

/**
 * Description of Mikrotik_Api
 * @author      Virtual Think Team vthinkteam@gmail.com <http://vthink.web.id>
 * @author      Lalu Erfandi Maula Yusnu nunenuh@gmail.com <http://vthink.web.id>
 * @copyright   Copyright (c) 2011, Virtual Think Team.
 * @license     http://opensource.org/licenses/gpl-license.php GNU Public License
 * @category	 Libraries
 */
class Mikrotik_Api {

    /**
     * @access private
     * @var type Object
     */
    private $CI;

    /**
     * Instantiation of Class Mikrotik_Api
     * @access private
     * @var type array
     */
    private $param;
    private $talker;

    function __construct($param = array()) {
        $this->CI = & get_instance();
        $param_config = $this->CI->config->item('mikrotik');
        if (isset($param_config) && is_array($param_config)) {
            $this->param = $param_config;
        } else {
            $this->param = $param;
        }
        $this->talker = new Talker($this->param['host'], $this->param['port'], $this->param['username'], $this->param['password']);
    }

    /**
     * This method for call class Mapi IP
     * @access public
     * @return Object of Mapi_Ip 
     */
    public function IP() {
        return new Mapi_Ip($this->talker);
    }

    /**
     * This method for call class Mapi Interface
     * @access public
     * @return Object of Mapi_Interface 
     */
    public function interfaces() {
        return new Mapi_Interfaces($this->talker);
    }

    /**
     * This method for call class Mapi Ppp
     * @access public
     * @return Object of Mapi_Ppp
     */
    public function ppp() {
        return new Mapi_Ppp($this->talker);
    }

    /**
     * This method for call class Mapi_System
     * @access public
     * @return Mapi_System 
     */
    public function system() {
        return new Mapi_System($this->talker);
    }

    /**
     * This method for call class Mapi_File
     * @access public
     * @return Mapi_File 
     */
    public function file() {
        return new Mapi_File($this->talker);
    }

    /**
     * This metod used call class Mapi_System_Scheduler 
     * @return Mapi_Ip
     */
    public function system_scheduler() {
        return new Mapi_System_Scheduler($this->talker);
    }

    /**
     * 
     * @return \Talker
     */
    public function buildCommand() {
        return new Talker($this->param['host'], $this->param['port'], $this->param['username'], $this->param['password']);
    }

}
