<?php

namespace MikrotikAPI\Commands\IP\Hotspot;

use MikrotikAPI\Talker\Talker;
use MikrotikAPI\Commands\IP\Hotspot\Server,
    MikrotikAPI\Commands\IP\Hotspot\ServerProfiles,
    MikrotikAPI\Commands\IP\Hotspot\Users,
    MikrotikAPI\Commands\IP\Hotspot\UserProfile,
    MikrotikAPI\Commands\IP\Hotspot\Hosts,
    MikrotikAPI\Commands\IP\Hotspot\Active,
    MikrotikAPI\Commands\IP\Hotspot\IPBindings,
    MikrotikAPI\Commands\IP\Hotspot\Cookie;

/**
 * Description of Hotspot
 * @author Lalu Erfandi Maula Yusnu nunenuh@gmail.com <http://vthink.web.id>
 * @copyright Copyright (c) 2011, Virtual Think Team.
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @category Libraries
 */
class Hotspot {

    /**
     *
     * @var Talker
     */
    private $talker;

    function __construct(Talker $talker) {
        $this->talker = $talker;
    }

    /**
     * 
     * @return \MikrotikAPI\Commands\IP\Hotspot\Server
     */
    public function server() {
        return new Server($this->talker);
    }

    /**
     * 
     * @return \MikrotikAPI\Commands\IP\Hotspot\ServerProfiles
     */
    public function serverProfiles() {
        return new ServerProfiles($this->talker);
    }

    /**
     * 
     * @return \MikrotikAPI\Commands\IP\Hotspot\Users
     */
    public function users() {
        return new Users($this->talker);
    }

    /**
     * 
     * @return \MikrotikAPI\Commands\IP\Hotspot\UserProfile
     */
    public function userProfiles() {
        return new UserProfile($this->talker);
    }

    /**
     * 
     * @return \MikrotikAPI\Commands\IP\Hotspot\Active
     */
    public function active() {
        return new Active($this->talker);
    }

    /**
     * 
     * @return \MikrotikAPI\Commands\IP\Hotspot\Hosts
     */
    public function hosts() {
        return new Hosts($this->talker);
    }

    /**
     * 
     * @return \MikrotikAPI\Commands\IP\Hotspot\IPBindings
     */
    public function IPBinding() {
        return new IPBindings($this->talker);
    }

    /**
     * 
     * @return \MikrotikAPI\Commands\IP\Hotspot\Cookie
     */
    public function cookie() {
        return new Cookie($this->talker);
    }

}
