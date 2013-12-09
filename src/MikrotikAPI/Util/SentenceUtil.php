<?php

namespace MikrotikAPI\Util;

use MikrotikAPI\Entity\Attribute;

/**
 * Description of SentenceUtil
 *
 * @author      Lalu Erfandi Maula Yusnu nunenuh@gmail.com <http://vthink.web.id>
 * @copyright   Copyright (c) 2011, Virtual Think Team.
 * @license     http://opensource.org/licenses/gpl-license.php GNU Public License
 * @category	Libraries
 */
class SentenceUtil {

    private $list;

    public function __construct() {
        $this->list = new \ArrayObject();
    }

    public function select($attributeName) {
        $name = "";
        if (Util::contains($attributeName, " ")) {
            $token = explode(" ", $attributeName);
            $a = 0;
            while ($a < count($token)) {
                $name = $name . current($token);
                next($token);
                $a++;
            }
        } else {
            $name = $attributeName;
        }

        $this->list->append(new Attribute("select", "proplist", $name));
    }

    public function where($name, $operand, $value) {
        if ($operand == "-" || $operand == "=" || $operand == "<" || $operand == ">") {
            $build = trim($operand) . trim($name) . "=";
            $this->list->append(new Attribute("where", $build, trim($value)));
        } else {
            return FALSE;
        }
    }

    public function whereNot($name, $operand, $value) {
        if ($operand == "-" || $operand == "=" || $operand == "<" || $operand == ">") {
            $build = "?" . trim($operand) . trim($name) . "=";
            $this->list->append(new Attribute("whereNot", $build, trim($value)));
            $this->list->append(new Attribute("whereNot", "?#", "!"));
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function orWhere($name, $operand, $value) {
        if ($operand == "-" || $operand == "=" || $operand == "<" || $operand == ">") {
            $build = "?" . trim($operand) . trim($name) . "=";
            $this->list->append(new Attribute("whereNot", $build, trim($value)));
            $this->list->append(new Attribute("whereNot", "?#", "|"));
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function orWhereNot($name, $operand, $value) {
        if ($operand == "-" || $operand == "=" || $operand == "<" || $operand == ">") {
            $build = "?" . trim($operand) . trim($name) . "=";
            $this->list->append(new Attribute("whereNot", $build, trim($value)));
            $this->list->append(new Attribute("whereNot", "?#", "!"));
            $this->list->append(new Attribute("whereNot", "?#", "|"));
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function andWhere($name, $operand, $value) {
        if ($operand == "-" || $operand == "=" || $operand == "<" || $operand == ">") {
            $build = "?" . trim($operand) . trim($name) . "=";
            $this->list->append(new Attribute("whereNot", $build, trim($value)));
            $this->list->append(new Attribute("whereNot", "?#", "&"));
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function andWhereNot($name, $operand, $value) {
        if ($operand == "-" || $operand == "=" || $operand == "<" || $operand == ">") {
            $build = "?" . trim($operand) . trim($name) . "=";
            $this->list->append(new Attribute("whereNot", $build, trim($value)));
            $this->list->append(new Attribute("whereNot", "?#", "!"));
            $this->list->append(new Attribute("whereNot", "?#", "&"));
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function fromCommand($command) {
        $this->list->append(new Attribute("commandPrint", "command", $command));
    }

    public function addCommand($command) {
        $this->list->append(new Attribute("commandReguler", "command", $command));
    }

    public function setAttribute($name, $value) {
        $this->list->append(new Attribute("setAttribute", $name, $value));
    }

    public function getBuildCommand() {
        return $this->list;
    }

    public function add(Attribute $attr) {
        $this->list->append($attr);
    }

}
