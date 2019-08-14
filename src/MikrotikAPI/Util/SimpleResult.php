<?php

namespace MikrotikAPI\Util;

/**
 * A simple wrapper/alternate class to maintain compatibility with ResultUtil
 *
 * @author Chibueze Opata opatachibueze@gmail.com <http://robosyslive.com>
 * @copyright   Copyright (c) 2016, Robotic Systems.
 * @license     http://opensource.org/licenses/gpl-license.php GNU Public License
 * @category	Libraries
 */
class SimpleResult {

    private $result = [];

    public function __construct($result) {
        $this->result = $result;
    }

    public function getResultArray() {
        return $this->result;
    }

    public function size() {
        return count($this->result);
    }
}
