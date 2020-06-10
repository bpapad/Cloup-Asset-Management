<?php
class Tmhmata_se_erga {
    var $kwd_tmhmatos_ergou;
    var $kwd_ergou_tmhma;
    
    function __construct(){
        $this->kwd_tmhmatos_ergou    = -1;
        $this->kwd_ergou_tmhma  = -1; 
    }
    
    function setDB(){
        $DB = new Database();
        $DB->setProj_Dpt($this);
    }
    
}//Class Tmhmata_se_erga ends here