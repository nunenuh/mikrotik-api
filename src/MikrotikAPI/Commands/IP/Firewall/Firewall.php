<?php

namespace MikrotikAPI\Commands\IP\Firewall;

use MikrotikAPI\Talker\Talker;
use MikrotikAPI\Commands\IP\Firewall\Filter,
    MikrotikAPI\Commands\IP\Firewall\NAT,
    MikrotikAPI\Commands\IP\Firewall\Mangle,
    MikrotikAPI\Commands\IP\Firewall\ServicePort,
    MikrotikAPI\Commands\IP\Firewall\Connection,
    MikrotikAPI\Commands\IP\Firewall\AddressList,
    MikrotikAPI\Commands\IP\Firewall\Layer7Protocol;

/**
 * Description of Firewall
 * @author Lalu Erfandi Maula Yusnu nunenuh@gmail.com <http://vthink.web.id>
 * @copyright Copyright (c) 2011, Virtual Think Team.
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @category Libraries
 */
class Firewall {

    /**
     *
     * @var type array
     */
    private $talker;

    function __construct(Talker $talker) {
        $this->talker = $talker;
    }

    /**
     * 
     * @return \MikrotikAPI\Commands\IP\Firewall\Filter
     */
    public function filter() {
        return new Filter($this->talker);
    }

    /**
     * 
     * @return \MikrotikAPI\Commands\IP\Firewall\NAT
     */
    public function NAT() {
        return new NAT($this->talker);
    }

    /**
     * 
     * @return \MikrotikAPI\Commands\IP\Firewall\Mangle
     */
    public function mangle() {
        return new Mangle($this->talker);
    }

    /**
     * 
     * @return \MikrotikAPI\Commands\IP\Firewall\ServicePort
     */
    public function servicePort() {
        return new ServicePort($this->talker);
    }

    /**
     * 
     * @return \MikrotikAPI\Commands\IP\Firewall\Connection
     */
    public function connection() {
        return new Connection($this->talker);
    }

    /**
     * 
     * @return \MikrotikAPI\Commands\IP\Firewall\AddressList
     */
    public function addressList() {
        return new AddressList($this->talker);
    }

    /**
     * 
     * @return \MikrotikAPI\Commands\IP\Firewall\Layer7Protocol
     */
    public function layer7Protocol() {
        return new Layer7Protocol($this->talker);
    }

}
