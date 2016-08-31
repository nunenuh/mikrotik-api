<?php

namespace MikrotikAPI\Commands\Queue;

use MikrotikAPI\Talker\Talker;
use MikrotikAPI\Commands\PPP\Active;

/**
 * Description of Mapi_Queue
 *
 * @author      Osmell Caicedo correo.oele@gmail.com
 * @license     http://opensource.org/licenses/gpl-license.php GNU Public License
 * @category	Libraries
 */

class Queue {

    private $talker;

    function __construct(Talker $talker) {
        $this->talker = $talker;
    }

    /**
     * This method for call class Simple
     * @access public
     * @return object of Simple class
     */
    public function Simple() {
        return new Simple($this->talker);
    }

}
