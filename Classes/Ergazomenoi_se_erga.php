<?php
class Ergazomenoi_se_erga {
    var $kwd_ergou ;
    var $kwd_ergazom_ergo ;
    
   function __construct(){
       $this->kwd_ergou  = -1;
       $this->kwd_ergazom_ergo  = -1;
   }
   
   function setDB(){
       $DB = new Database();
       $DB->setEmp_Dpt($this);
   }
   
}//Class Ergazomenoi_se_erga ends here