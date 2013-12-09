<?php

namespace MikrotikAPI\Commands\IP;

use MikrotikAPI\Talker\Talker;
use MikrotikAPI\Commands\IP\Address,
    MikrotikAPI\Commands\IP\Hotspot\Hotspot,
    MikrotikAPI\Commands\IP\Pool,
    MikrotikAPI\Commands\IP\DNS,
    MikrotikAPI\Commands\IP\Firewall\Firewall,
    MikrotikAPI\Commands\IP\Accounting,
    MikrotikAPI\Commands\IP\ARP,
    MikrotikAPI\Commands\IP\DHCPClient,
    MikrotikAPI\Commands\IP\DHCPServer,
    MikrotikAPI\Commands\IP\DHCPRelay,
    MikrotikAPI\Commands\IP\Route,
    MikrotikAPI\Commands\IP\Service,
    MikrotikAPI\Commands\IP\WebProxy;

/**
 * Description of IP
 *
 * @author      Lalu Erfandi Maula Yusnu nunenuh@gmail.com <http://vthink.web.id>
 * @copyright   Copyright (c) 2011, Virtual Think Team.
 * @license     http://opensource.org/licenses/gpl-license.php GNU Public License
 * @category	 Libraries
 */
class IP {

    /**
     *
     * @var type array
     */
    private $talker;

    function __construct(Talker $talker) {
        $this->talker = $talker;
    }

    /**
     * This method is use for call instantiate object of class
     * \MikrotikAPI\Commands\IP\Address
     * @return \MikrotikAPI\Commands\IP\Address
     */
    public function address() {
        return new Address($this->talker);
    }

    /**
     * This method is use for call instantiate object of class
     * \MikrotikAPI\Commands\IP\Hotspot\Hotspot
     * @return \MikrotikAPI\Commands\IP\Hotspot\Hotspot
     */
    public function hotspot() {
        return new Hotspot($this->talker);
    }

    /**
     * This method is use for call instantiate object of class
     * \MikrotikAPI\Commands\IP\Pool
     * @return \MikrotikAPI\Commands\IP\Pool
     */
    public function pool() {
        return new Pool($this->talker);
    }

    /**
     * This method is use for call instantiate object of class
     * \MikrotikAPI\Commands\IP\DNS
     * @return \MikrotikAPI\Commands\IP\DNS
     */
    public function DNS() {
        return new DNS($this->talker);
    }

    /**
     * This method is use for call instantiate object of class
     * \MikrotikAPI\Commands\IP\Firewall\Firewall
     * @return \MikrotikAPI\Commands\IP\Firewall\Firewall
     */
    public function firewall() {
        return new Firewall($this->talker);
    }

    /**
     * This method is use for call instantiate object of class
     * \MikrotikAPI\Commands\IP\Accounting
     * @return \MikrotikAPI\Commands\IP\Accounting
     */
    public function accounting() {
        return new Accounting($this->talker);
    }

    /**
     * This method is use for call instantiate object of class
     * \MikrotikAPI\Commands\IP\ARP
     * @return \MikrotikAPI\Commands\IP\ARP
     */
    public function ARP() {
        return new ARP($this->talker);
    }

    /**
     * This method is use for call instantiate object of class
     * \MikrotikAPI\Commands\IP\DHCPClient
     * @return \MikrotikAPI\Commands\IP\DHCPClient
     */
    public function DHCPClient() {
        return new DHCPClient($this->talker);
    }

    /**
     * This method is use for call instantiate object of class
     * \MikrotikAPI\Commands\IP\DHCPRelay
     * @return \MikrotikAPI\Commands\IP\DHCPRelay
     */
    public function DHCPRelay() {
        return new DHCPRelay($this->talker);
    }

    /**
     * This method is use for call instantiate object of class
     * \MikrotikAPI\Commands\IP\DHCPServer
     * @return \MikrotikAPI\Commands\IP\DHCPServer
     */
    public function DHCPServer() {
        return new DHCPServer($this->talker);
    }

    /**
     * This method is use for call instantiate object of class
     * \MikrotikAPI\Commands\IP\Route
     * @return \MikrotikAPI\Commands\IP\Route
     */
    public function route() {
        return new Route($this->talker);
    }

    /**
     * This method is use for call instantiate object of class
     * \MikrotikAPI\Commands\IP\Service
     * @return \MikrotikAPI\Commands\IP\Service
     */
    public function service() {
        return new Service($this->talker);
    }

    /**
     * This method is use for call instantiate object of class
     * \MikrotikAPI\Commands\IP\WebProxy
     * @return \MikrotikAPI\Commands\IP\WebProxy
     */
    public function proxy() {
        return new WebProxy($this->talker);
    }

}
