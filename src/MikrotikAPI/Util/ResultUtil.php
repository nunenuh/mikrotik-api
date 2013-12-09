<?php

namespace MikrotikAPI\Util;

/**
 * Description of ResultUtil
 *
 * @author      Lalu Erfandi Maula Yusnu nunenuh@gmail.com <http://vthink.web.id>
 * @copyright   Copyright (c) 2011, Virtual Think Team.
 * @license     http://opensource.org/licenses/gpl-license.php GNU Public License
 * @category	Libraries
 */
class ResultUtil {

    private $list;
    private $listAttr;
    private $itList;

    public function __construct() {
        $this->list = new \ArrayObject();
        $this->listAttr = new \ArrayObject();
    }

    public function getResult($mixed = '') {
        $value = NULL;
        if (gettype($mixed) == "string") {
            $it = $this->listAttr->getIterator();
            while ($it->valid()) {
                if ($it->current()->getName() == $mixed) {
                    $value = $it->current()->getValue();
                }
                $it->next();
            }
        } else if (gettype($mixed) == "integer") {
            $it = $this->listAttr->getIterator();
            $value = $it->offsetGet($mixed)->getValue();
        } else {
            $value = NULL;
        }
        return $value;
    }

    public function getResultArray() {
        $ar = new \ArrayObject();

        while ($this->next()) {
            $it = $this->listAttr->getIterator();
            while ($it->valid()) {
                $tmpAr[$it->current()->getName()] = $it->current()->getValue();
                $it->next();
            }
            $ar->append($tmpAr);
        }

        return $ar->getArrayCopy();
    }

    private function fireOnChange() {
        $this->itList = $this->list->getIterator();
        $this->listAttr = $this->itList->current();
    }

    public function hasNext() {
        return $this->itList->valid();
    }

    public function next() {
        if ($this->hasNext()) {
            $this->listAttr = $this->itList->current();
            $this->itList->next();
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function size() {
        return $this->list->count();
    }

    public function add(\ArrayObject $object) {
        $this->list->append($object);
        $this->fireOnChange();
    }

}
