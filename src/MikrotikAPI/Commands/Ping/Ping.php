<?php

namespace MikrotikAPI\Commands\Ping;

use MikrotikAPI\Util\SentenceUtil,
    MikrotikAPI\Talker\Talker;

/**
 * Description of Queue
 *
 * @author      Osmell Leandro Caicedo Gelvez correo.oele@gmail.com <http://oele.co>
 * @copyright   Copyright (c) 2017, @oele_co.
 * @license     http://opensource.org/licenses/gpl-license.php GNU Public License
 * @category    Libraries
 */
class Ping {

    /**
     * @access private
     * @var type array
     */
    private $talker;

    function __construct(Talker $talker) {
        $this->talker = $talker;
    }

    /**
     * This method is used to display all file in mikrotik RouterOs
     * @return type array
     */
    public function get($param) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/ping");
        foreach ($param as $name => $value) {
            $sentence->setAttribute($name, $value);
        }
        $this->talker->send($sentence);
        $rs = $this->talker->getResult();
        $i = 0;
        if ($i < $rs->size()) {
            return $rs->getResultArray();
        } else {
            return "None";
        }
    }

}
