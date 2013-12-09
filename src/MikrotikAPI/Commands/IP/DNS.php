<?php

namespace MikrotikAPI\Commands\IP;

use MikrotikAPI\Talker\Talker,
    MikrotikAPI\Util\SentenceUtil;

/**
 * Description of Mapi_Ip_Dns
 * @author      Lalu Erfandi Maula Yusnu nunenuh@gmail.com <http://vthink.web.id>
 * @copyright   Copyright (c) 2011, Virtual Think Team.
 * @license     http://opensource.org/licenses/gpl-license.php GNU Public License
 * @category	Libraries
 */
class DNS{
    /**
     *
     * @var type array
     */
    private $talker;
    
    function __construct(Talker $talker){
        $this->talker = $talker;
    }
    
   /**
    * This method is used to configure dns
    * @param type $servers string example : '192.168.1.1,192.168.2.1'
    * @return type array
    * 
    */
    public function set($servers){
        $sentence = new SentenceUtil();
        $sentence->addCommand("/ip/dns/set");
        $sentence->setAttribute("servers", $servers);
        $this->talker->send($sentence);
        return "Sucsess";
    }
    
    /**
     * This method is used to display
     * all dns
     * @return type array
     * 
     */
    public function getAll(){
        $sentence = new SentenceUtil();
        $sentence->fromCommand("/ip/dns/getall");
        $this->talker->send($sentence);
        $rs = $this->talker->getResult();
        $i = 0;
        if ($i < $rs->size()){
            return $rs->getResultArray();
        }else{
            return "No Ip DNS To Set, Please Your Add Ip DNS";
        }
    }
     
    /**
     * This method is used to add the static dns
     * @param type $param array
     * @return type array
     * 
     */
    public function addStatic($param){
       $sentence = new SentenceUtil();
       $sentence->addCommand("/ip/dns/static/add");
       foreach ($param as $name => $value){
               $sentence->setAttribute($name, $value);
       }       
       $this->talker->send($sentence);
       return "Sucsess";
    }
   /**
    * This method is used to display
    * all static dns
    * @return type array
    * 
    */
    public function getAllStatic(){
        $sentence = new SentenceUtil();
        $sentence->fromCommand("/ip/dns/static/getall");
        $this->talker->send($sentence);
        $rs = $this->talker->getResult();
        $i = 0;
        if ($i < $rs->size()){
            return $rs->getResultArray();
        }else{
            return "No Ip Static DNS To Set, Please Your Add Ip Static DNS";
        }
    }
    
    /**
     * This method is used to display one static dns 
     * in detail based on the id
     * @param type $id string
     * @return type array
     * 
     */
     public function detailStatic($id){
        $sentence = new SentenceUtil();
        $sentence->fromCommand("/ip/dns/static/print");
        $sentence->where(".id", "=", $id);
        $this->talker->send($sentence);
        $rs = $this->talker->getResult();
        $i = 0 ;
        if ($i < $rs->size()){
            return $rs->getResultArray();
        }  else {
            return "No Ip Static DNS With This Id = ".$id;
        }
    }
    
    /**
     * This method is used to change based on the id
     * @param type $param array
     * @param type $id string
     * @return type array
     * 
     */
    public function setStatic($param, $id){
        $sentence = new SentenceUtil();
        $sentence->addCommand("/ip/dns/static/set");
        foreach ($param as $name => $value){
                $sentence->setAttribute($name, $value);
         }
        $sentence->where(".id", "=", $id);
        $this->talker->send($sentence);
        return "Sucsess";
    }

     /**
     * This method is used to display
     * all dns cache
     * @return array || string
     * 
     */
    public function getAllCache(){
        $sentence = new SentenceUtil();
        $sentence->fromCommand("/ip/dns/cache/getall");
        $this->talker->send($sentence);
        $rs = $this->talker->getResult();
        $i = 0;
        if ($i < $rs->size()){
            return $rs->getResultArray();
        }else{
            return "No Ip DNS Cache To Set, Please Your Add Ip DNS Cache";
        }
    }
    
    /**
     * This method is used to display one dns cache 
     * in detail based on the id
     * @param type $id string
     * @return type array
     * 
     */
     public function detailCache($id){
        $sentence = new SentenceUtil();
        $sentence->fromCommand("/ip/dns/cache/print");
        $sentence->where(".id", "=", $id);
        $this->talker->send($sentence);
        $rs = $this->talker->getResult();
        $i = 0 ;
        if ($i < $rs->size()){
            return $rs->getResultArray();
        }  else {
            return "No Ip DNS Cache With This Id = ".$id;
        }
    }
    
    /**
     * This method is used to display
     * all dns cache all cache
     * @return type array
     * 
     */
    public function getAllCacheAll(){
        $sentence = new SentenceUtil();
        $sentence->fromCommand("/ip/dns/cache/all/getall");
        $this->talker->send($sentence);
        $rs = $this->talker->getResult();
        $i = 0;
        if ($i < $rs->size()){
            return $rs->getResultArray();
        }else{
            return "No Ip DNS Cache All To Set, Please Your Add Ip DNS Cache All";
        }
    }
    
     /**
     * This method is used to display one dns cache all 
     * in detail based on the id
     * @param type $id string
     * @return type array
     * 
     */
     public function detailCacheAll($id){
        $sentence = new SentenceUtil();
        $sentence->fromCommand("/ip/dns/cache/all/print");
        $sentence->where(".id", "=", $id);
        $this->talker->send($sentence);
        $rs = $this->talker->getResult();
        $i = 0 ;
        if ($i < $rs->size()){
            return $rs->getResultArray();
        }  else {
            return "No Ip DNS Cache All With This Id = ".$id;
        }
    }
}
