<?php

namespace MikrotikAPI\Commands\Queue;

use MikrotikAPI\Talker\Talker;
use MikrotikAPI\Commands\Queue\Simple,
    MikrotikAPI\Commands\Queue\Type;

/**
 * Description of Queue
 *
 * @author      Osmell Leandro Caicedo Gelvez correo.oele@gmail.com <http://oele.co>
 * @copyright   Copyright (c) 2017, @oele_co.
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
    
    /**
     * This method for call class Type
     * @access public
     * @return object of Type class
     */
    public function Type() {
        return new Type($this->talker);
    }

}
