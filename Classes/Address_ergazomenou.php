<?php
class Address_ergazomenou {
    var $odos;
    var $arithmos;
    var $polh;
    var $zip_code;
    var $kwd_ergazomenou_adr;
    
    function __construct(){
        $this->odos = "";
        $this->arithmos = "";
        $this->polh = "";
        $this->zip_code = -1;
        $this->kwd_ergazomenou_adr = -1;    
    }
    
    function setResident($resident){
        $this->kwd_ergazomenou_adr = $resident;
    }
    
    
    function getAddress(){
        $DB = new Database();
        $DB->getAddress($this);
    }
    
    function setDB(){
        $DB = new Database();
        $DB->setNewAddress($this);
    }
}//Class Address_ergazomenou ends here
