<?php
class Tmhma {
    var $kwd_tmhmatos   ;
    var $onoma_tmhmatos;
    var $kwd_proistamenou ;
    
    function __construct(){
        $this->kwd_tmhmatos   = -1;
        $this->onoma_tmhmatos = "";
        $this->kwd_proistamenou  = -1;  
    }
    
    function setID($kwd){
        $this->kwd_tmhmatos = $kwd;
    }
    
    function getDepartment(){
        $DB = new Database();
        $DB->getDepartment($this);
    } 
    
    function findSupervisor($sup_id){
        if($this->kwd_proistamenou == $sup_id){
            echo 'Self';
        }
        else{
            $DB = new Database();
            $DB->findSupervisor($this->kwd_proistamenou);
        }
    }
    
    function setDB(){
        $DB = new Database();
        $DB->setNewDpt($this);
    }
    
}//Class Tmhma ends here