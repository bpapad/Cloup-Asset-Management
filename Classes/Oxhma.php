<?php
class Oxhma {
    var $ar_kykloforias   ;
    var $xroma_oxhm;
    var $montelo_oxhm;
    var $marka_oxhm;
    var $odhgos;
    
    function __construct(){
        $this->ar_kykloforias   = "";
        $this->xroma_oxhm = "";
        $this->montelo_oxhm = "";
        $this->marka_oxhm = "";
        $this->odhgos = -1;
    }
    
    function setOdhgos($driver){
        $this->odhgos = $driver;
    }
    
    function getCar(){
        $DB = new Database();
        $DB->getCar($this);
    }
    
    function setDB(){
        $DB = new Database();
        $DB->setNewCar($this);
    }
    
}//Class Oxhma ends here