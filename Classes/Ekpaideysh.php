<?php
class Ekpaideysh {
    var $kwd_ptyxio ;
    var $per_ptyxiou;
    
    
    function __construct(){
        $this->kwd_ptyxio = -1;
        $this->per_ptyxiou = "";
    }
    
    function setDB(){
        $DB = new Database();
        $DB->setNewDiploma($this);
    }
    
    
    
}//Class Ekpaideysh ends here