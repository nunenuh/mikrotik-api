<?php

namespace MikrotikAPI\Commands\PPP;

use MikrotikAPI\Talker\Talker;
use MikrotikAPI\Commands\PPP\Active,
    MikrotikAPI\Commands\PPP\Secret,
    MikrotikAPI\Commands\PPP\AAA,
    MikrotikAPI\Commands\PPP\Profile;

/**
 * Description of Mapi_Ppp
 *
 * @author      Lalu Erfandi Maula Yusnu nunenuh@gmail.com <http://vthink.web.id>
 * @copyright   Copyright (c) 2011, Virtual Think Team.
 * @license     http://opensource.org/licenses/gpl-license.php GNU Public License
 * @category	Libraries
 */
class PPP {

    private $talker;

    function __construct(Talker $talker) {
        $this->talker = $talker;
    }

    /**
     * This method for call class Profile
     * @return Object of Profile class
     */
    public function profile() {
        return new Profile($this->talker);
    }

    /**
     * This method for call class Secret
     * @return Object of Secret
     */
    public function secret() {
        return new Secret($this->talker);
    }

    /**
     * This method for call class Aaa
     * @access public
     * @return object of Aaa class
     */
    public function AAA() {
        return new AAA($this->talker);
    }

    /**
     * This method for call class Active
     * @return Object of Active class
     */
    public function active() {
        return new Active($this->talker);
    }

}
