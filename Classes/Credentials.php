<?php


class Credentials {
    var $username;
    var $password;
    var $kwd_ergazom_cred;
    
    function __construct() {
        $this->username = "";
        $this->password = "";
        $this->kwd_ergazom_cred = -1;
    }
    
    function verify(){
        $DB = new Database();
        $DB->verify($this);
    }
    
    function setDb() {
        $DB = new Database();
        $DB->setCredentials($this);
    }
}
