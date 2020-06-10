<?php
class Ergo {
    var $kwd_ergou  ;
    var $perigrafh_ergou;
    var $finish_date;
    var $start_date;
    var $ergazom;
    
    function __construct(){
        $this->kwd_ergou  = -1;
        $this->perigrafh_ergou = "";
        $this->finish_date = 0000-00-00;
        $this->start_date = 0000-00-00;
        $this->ergazom = -1;
    }
    
    function setWorker($worker){
        $this->ergazom = $worker;
    }


    function getErgo(){
        $DB = new Database();
        $DB->getErgo($this);
    }
    
    function setDB(){
        $DB = new Database();
        $DB->setNewErgo($this);
    }
    
}//Class Ergo ends here       