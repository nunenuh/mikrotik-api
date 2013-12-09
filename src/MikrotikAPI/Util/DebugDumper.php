<?php

namespace MikrotikAPI\Util;

/**
 * Description of Debug
 *
 * @author nunenuh
 */
class DebugDumper {

    public static function dump($var, $detail = false) {
        if (is_array($var)) {
            if ($detail == false) {
                echo "<pre>";
                print_r($var);
                echo "</pre>";
            } else {
                echo "<pre>";
                var_dump($var);
                echo "</pre>";
            }
        } else {
            if ($detail == false) {
                echo "<pre>";
                echo $var;
                echo "</pre>";
            } else {
                echo "<pre>";
                var_dump($var);
                echo "</pre>";
            }
        }
    }

}
