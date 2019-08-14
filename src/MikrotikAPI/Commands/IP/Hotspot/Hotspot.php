<?php

namespace MikrotikAPI\Commands\IP\Hotspot;

use MikrotikAPI\Talker\Talker;
use MikrotikAPI\Commands\IP\Hotspot\HotspotServer,
    MikrotikAPI\Commands\IP\Hotspot\HotspotServerProfiles,
    MikrotikAPI\Commands\IP\Hotspot\HotspotUsers,
    MikrotikAPI\Commands\IP\Hotspot\HotspotUserProfile,
    MikrotikAPI\Commands\IP\Hotspot\HotspotHosts,
    MikrotikAPI\Commands\IP\Hotspot\HotspotActive,
    MikrotikAPI\Commands\IP\Hotspot\HotspotIPBindings,
    MikrotikAPI\Commands\IP\Hotspot\HotspotCookie;

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
        return new HotspotServer($this->talker);
    }

    /**
     * 
     * @return \MikrotikAPI\Commands\IP\Hotspot\ServerProfiles
     */
    public function serverProfiles() {
        return new HotspotServerProfiles($this->talker);
    }

    /**
     * 
     * @return \MikrotikAPI\Commands\IP\Hotspot\Users
     */
    public function users() {
        return new HotspotUsers($this->talker);
    }

    /**
     * 
     * @return \MikrotikAPI\Commands\IP\Hotspot\UserProfile
     */
    public function userProfiles() {
        return new HotspotUserProfile($this->talker);
    }

    /**
     * 
     * @return \MikrotikAPI\Commands\IP\Hotspot\Active
     */
    public function active() {
        return new HotspotActive($this->talker);
    }

    /**
     * 
     * @return \MikrotikAPI\Commands\IP\Hotspot\Hosts
     */
    public function hosts() {
        return new HotspotHosts($this->talker);
    }

    /**
     * 
     * @return \MikrotikAPI\Commands\IP\Hotspot\IPBindings
     */
    public function IPBinding() {
        return new HotspotIPBindings($this->talker);
    }

    /**
     * 
     * @return \MikrotikAPI\Commands\IP\Hotspot\Cookie
     */
    public function cookie() {
        return new HotspotCookie($this->talker);
    }

}
