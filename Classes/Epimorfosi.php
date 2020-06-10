<?php
class Epimorfosi {
    var $ekpaideyomenos;
    var $eidikeysh;
    var $vathmos;
    var $date_apokthshs;
    
   function __construct(){
       $this->ekpaideyomenos = -1;
       $this->eidikeysh = -1;
       $this->vathmos = -1;
       $this->date_apokthshs = 0000-00-00;
   }
   
   function setDB(){
       $DB = new Database();
       $DB->setDiplomaHolder($this);
   }
}//Class Epimorfosi ends here
