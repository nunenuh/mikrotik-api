<?php

namespace MikrotikAPI\Commands\IP;

use MikrotikAPI\Talker\Talker,
    MikrotikAPI\Util\SentenceUtil;

/**
 * Description of Mapi_Ip_Accounting
 * 
 * @author      Lalu Erfandi Maula Yusnu nunenuh@gmail.com <http://vthink.web.id>
 * @copyright   Copyright (c) 2011, Virtual Think Team.
 * @license     http://opensource.org/licenses/gpl-license.php GNU Public License
 * @category	Libraries
 */
class Accounting {

    /**
     *
     * @var type array
     */
    private $talker;

    function __construct(Talker $talker) {
        $this->talker = $talker;
    }

    /**
     * This method is used to set or edit ip accountng
     * @param type $account_local_traffic string
     * @param type $enabled string
     * @param type $threshold string
     * @return type array
     */
    public function setAccounting($account_local_traffic, $enabled, $threshold) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/ip/accounting/set");
        $sentence->setAttribute("account-local-traffic", $account_local_traffic);
        $sentence->setAttribute("enabled", $enabled);
        $sentence->setAttribute("threshold", $threshold);
        $this->talker->send($sentence);
        return "Sucsess";
    }

    /**
     * This method is used to display all accounting
     * @return type array
     * 
     */
    public function getAll_accounting() {
        $sentence = new SentenceUtil();
        $sentence->fromCommand('/ip/accounting/getall');
        $this->talker->send($sentence);
        $rs = $this->talker->getResult();
        $i = 0;
        if ($i < $rs->size()) {
            return $rs->getResultArray();
        } else {
            return "No Ip Accounting To Set, Please Your Add Ip Accounting";
        }
    }

    /**
     * This method is used to display all snapshot
     * @return type array
     * 
     */
    public function get_all_snapshot() {
        $sentence = new SentenceUtil();
        $sentence->fromCommand('/ip/accounting/snapshot/getall');
        $this->talker->send($sentence);
        $rs = $this->talker->getResult();
        $i = 0;
        if ($i < $rs->size()) {
            return $rs->getResultArray();
        } else {
            return "No Ip Accounting Snapshot To Set, Please Your Add Ip Accounting Snapshot";
        }
    }

    /**
     * This method is used to display all uncounted
     * @return type array
     * 
     */
    public function get_all_uncounted() {
        $sentence = new SentenceUtil();
        $sentence->fromCommand('/ip/accounting/uncounted/getall');
        $this->talker->send($sentence);
        $rs = $this->talker->getResult();
        $i = 0;
        if ($i < $rs->size()) {
            return $rs->getResultArray();
        } else {
            return "No Ip Accounting Uncounted To Set, Please Your Add Ip Accounting Uncounted";
        }
    }

    /**
     * This method is used to display all web-acces
     * @return type array
     * 
     */
    public function get_all_web_access() {
        $sentence = new SentenceUtil();
        $sentence->fromCommand('/ip/accounting/web-access/getall');
        $this->talker->send($sentence);
        $rs = $this->talker->getResult();
        $i = 0;
        if ($i < $rs->size()) {
            return $rs->getResultArray();
        } else {
            return "No Ip Accounting web-access To Set, Please Your Add Ip Accounting web-access";
        }
    }

    /**
     * This method is used to ip accounting set web-acces
     * @param type $accessible_via_web string default : yes or no
     * @return type array
     * 
     */
    public function set_web_access($accessible_via_web) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/ip/accounting/web-access/set");
        $sentence->setAttribute("accessible-via-web", $accessible_via_web);
        $sentence->setAttribute("address", "0.0.0.0/0");
        $this->talker->send($sentence);
        return "Sucsess";
    }

}
