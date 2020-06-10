<?php



//------------------------------- UNIVERSAL DATABASE CONNECTION INITIALIZER CLASS AND FUNCTIONS START HERE ----------------------------------
class Database
{
    private $host;
    private $database;
    private $user;
    private $pass;
    private $pdo;
    private $opt;
    
    static $count;       //Used in function getDptStaff($sth) counting the number of rows fetched by the query

    public function __construct()
    {
        $this->host = "127.0.0.1";
        $this->database = "cloup";
        $this->user = "root";
        $this->pass = "";
    }

    public function connect()
    {
        $this->opt = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_EMULATE_PREPARES => false];
        $conString = "mysql:host=" . $this->host . ";dbname=" . $this->database . ";charset=utf8";
        $this->pdo = new PDO($conString, $this->user, $this->pass, $this->opt);
    }

    public function execute($sql, $array)
    {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($array);
        return $stmt;
    }
//------------------------------- UNIVERSAL DATABASE CONNECTION INITIALIZER CLASS AND FUNCTIONS END HERE ------------------------------------



    
    
//------------------------------- PROJECT SPECIFIC FUNCTIONS DECLERATION AND CODING STARTS HERE ---------------------------------------------
    //fetchind employee ID if the username and password provided are correct and match an ID
    function verify(&$V){
        $sql = "SELECT credentials.kwd_ergazom_cred FROM `credentials` WHERE credentials.username = ? AND credentials.password = ? ;";
        $this->connect();
        $res = $this->execute($sql, [$V->username, $V->password]);
        $row = $res->fetch();
        $V->kwd_ergazom_cred = $row['kwd_ergazom_cred'];
    }
    
    //using the id provided by the above function verify(&$V), this part loads all ergazomenos tables in one Ergazomenos class object
    function login(&$U){
        $sql = "SELECT ergazomenos.kwd_ergazomenou, ergazomenos.Eponymo_ergazom, ergazomenos.Onoma_Ergazom, ergazomenos.Patronymo_Ergazom, ergazomenos.Fyllo_Ergaz, ergazomenos.AFM_Ergaz, ergazomenos.DOB_Ergazom, ergazomenos.Tel_Ergaz, ergazomenos.Salary_Ergazom, ergazomenos.Kod_tm_ergazom, ergazomenos.user_type_ergazom FROM ergazomenos JOIN credentials ON credentials.kwd_ergazom_cred = ergazomenos.kwd_ergazomenou WHERE credentials.kwd_ergazom_cred = ? ;";
        $this->connect();
        $res = $this->execute($sql, [$U->cred_id]);
        if ($res->rowCount() == 1) {
            $row = $res->fetch();
            $U->kwd_ergazomenou = $row['kwd_ergazomenou'];
            $U->Eponymo_ergazom = $row['Eponymo_ergazom'];
            $U->Onoma_Ergazom = $row['Onoma_Ergazom'];
            $U->Patronymo_Ergazom = $row['Patronymo_Ergazom'];
            $U->Fyllo_Ergaz = $row['Fyllo_Ergaz'];
            $U->AFM_Ergaz = $row['AFM_Ergaz'];
            $U->DOB_Ergazom = $row['DOB_Ergazom'];
            $U->Tel_Ergaz = $row['Tel_Ergaz'];
            $U->Salary_Ergazom = $row['Salary_Ergazom'];
            $U->Kod_tm_ergazom = $row['Kod_tm_ergazom'];
            $U->user_type_ergazom = $row['user_type_ergazom'];
        }
    }
    
    //fetching a departments name and supervisor using the given department_id
    function getDepartment(&$O){
        $sql = "SELECT tmhma.onoma_tmhmatos, tmhma.kwd_proistamenou FROM tmhma WHERE tmhma.kwd_tmhmatos = ? ;";
        $this->connect();
        $res = $this->execute($sql, [$O->kwd_tmhmatos]);
        if ($res->rowCount() == 1){
            $row = $res->fetch();
            $O->onoma_tmhmatos = $row['onoma_tmhmatos'];
            $O->kwd_proistamenou = $row['kwd_proistamenou'];   
        }
    }
    
    //printing the complete name of the Employee who supervises the given department (department_id requested by the query)
    function findSupervisor($sup_id){
        $sql = "SELECT ergazomenos.Eponymo_ergazom, ergazomenos.Onoma_Ergazom FROM ergazomenos JOIN tmhma ON ergazomenos.Kod_tm_ergazom = tmhma.kwd_tmhmatos WHERE ergazomenos.kwd_ergazomenou = ? ;";
        $this->connect();
        $res = $this->execute($sql, [$sup_id]);
        if ($res->rowCount() == 1){
            $row = $res->fetch();
            echo $row['Eponymo_ergazom']." ".$row['Onoma_Ergazom'];  
        }
    }
    
    
    //fetching data for the car/cars the selected employee has (employee_id requested by the query)
    function getCar(&$C){
        $sql = "SELECT ergazomenos.Onoma_Ergazom, oxhma.montelo_oxhm, oxhma.ar_kykloforias, oxhma.marka_oxhm, oxhma.xroma_oxhm FROM ergazomenos JOIN oxhma on oxhma.odhgos=ergazomenos.kwd_ergazomenou WHERE ergazomenos.kwd_ergazomenou= ? ;";
        $this->connect();
        $res = $this->execute($sql, [$C->odhgos]);
        if ($res->rowCount() == 1){
            $row = $res->fetch();
            $C->ar_kykloforias = $row['ar_kykloforias'];
            $C->xroma_oxhm = $row['xroma_oxhm'];
            $C->montelo_oxhm = $row['montelo_oxhm'];
            $C->marka_oxhm = $row['marka_oxhm'];
        }
        else{
            $C->ar_kykloforias = [];
            $C->xroma_oxhm = [];
            $C->montelo_oxhm = [];
            $C->marka_oxhm = [];
            $data = $res->fetchAll();
            foreach($data as $row) {
                array_push($C->ar_kykloforias, $row['ar_kykloforias']);
                array_push($C->xroma_oxhm, $row['xroma_oxhm']);
                array_push($C->montelo_oxhm, $row['montelo_oxhm']);
                array_push($C->marka_oxhm, $row['marka_oxhm']);
            }
        }
    }
    
    //fetching the project/project the selected employee is assigned to (employee_id requested by the query)
    function getErgo(&$E){
        $sql = "SELECT ergo.kwd_ergou, ergo.perigrafh_ergou, ergo.start_date, ergo.finish_date FROM ergo JOIN ergazomenoi_se_erga ON ergazomenoi_se_erga.kwd_ergou = ergo.kwd_ergou JOIN ergazomenos ON ergazomenoi_se_erga.kwd_ergazom_ergo = ergazomenos.kwd_ergazomenou WHERE ergazomenos.kwd_ergazomenou = ? ;";
        $this->connect();
        $res = $this->execute($sql, [$E->ergazom]);
        if($res->rowCount() == 1){
            $row = $res->fetch();
            $E->perigrafh_ergou = $row['perigrafh_ergou'];
            $E->start_date = $row['start_date'];
            $E->finish_date = $row['finish_date'];
            $E->kwd_ergou = $row['kwd_ergou'];
        }
        else{
            $E->perigrafh_ergou = [];
            $E->start_date = [];
            $E->finish_date = [];
            $E->kwd_ergou = [];
            $data = $res->fetchAll();
            foreach($data as $row) {
                array_push($E->perigrafh_ergou, $row['perigrafh_ergou']);
                array_push($E->start_date, $row['start_date']);
                array_push($E->finish_date, $row['finish_date']);
                array_push($E->kwd_ergou, $row['kwd_ergou']);
            }
        }
    }
    
    //using the dependants amka this function finds and prints whether they belong in the child or spouce tables
    function child_spouce($amka){
        $sqls = "SELECT syzygos.AMKA_syzygou FROM syzygos WHERE syzygos.AMKA_syzygou = ? ;";
        $this->connect();
        $res = $this->execute($sqls, [$amka]);
        $spouce = $res->fetch();
        if( $spouce ){
            echo "Spouce";
        }
        else{
            $sqls = "SELECT tekno.AMKA_teknou FROM tekno WHERE tekno.AMKA_teknou = ? ;";
            $this->connect();
            $res = $this->execute($sqls, [$amka]);
            $child = $res->fetch();
            if( $child ){
                echo "Child";
            }else{
                echo "Not Declared";
            }
        }
    }
    
    //using the employee_id fetches all the dependants the requested employee has
    function getEksartomeno(&$A){        
        $sql = "SELECT eksartomenos.DOB_eksart, eksartomenos.Onoma_eksart, eksartomenos.Eponymo_eksart, eksartomenos.Fylo_eksart, eksartomenos.AMKA_eksart FROM eksartomenos JOIN ergazomenos ON eksartomenos.kod_prostati = ergazomenos.kwd_ergazomenou WHERE ergazomenos.kwd_ergazomenou = ? ;";
        $this->connect();
        $res = $this->execute($sql, [$A->kod_prostati]);
        if($res->rowCount() == 1){
            $row = $res->fetch();
            $A->DOB_eksart = $row['DOB_eksart'];
            $A->AMKA_eksart = $row['AMKA_eksart'];
            $A->Onoma_eksart = $row['Onoma_eksart'];
            $A->Eponymo_eksart = $row['Eponymo_eksart'];
            $A->Fylo_eksart = $row['Fylo_eksart'];
        }
        else{
            $A->DOB_eksart = [];
            $A->AMKA_eksart = [];
            $A->Onoma_eksart = [];
            $A->Eponymo_eksart = [];
            $A->Fylo_eksart = [];
            $data = $res->fetchAll();
            foreach($data as $row) {
                array_push($A->DOB_eksart, $row['DOB_eksart']);
                array_push($A->AMKA_eksart, $row['AMKA_eksart']);
                array_push($A->Onoma_eksart, $row['Onoma_eksart']);
                array_push($A->Eponymo_eksart, $row['Eponymo_eksart']);
                array_push($A->Fylo_eksart, $row['Fylo_eksart']);
            }
        }
    }
    
    
    //old function, figured better way
    /*function getEkpaideyseis(&$B){
        $sql = "SELECT ekpaideysh.kwd_ptyxio, ekpaideysh.per_ptyxiou, ekpaideysh.vathmos, ekpaideysh.date_apokthshs FROM ekpaideysh JOIN epimorfosi ON ekpaideysh.kwd_ptyxio = epimorfosi.eidikeysh JOIN ergazomenos ON epimorfosi.ekpaideyomenos = ergazomenos.kwd_ergazomenou WHERE ergazomenos.kwd_ergazomenou = ? ;";
        $this->connect();
        $res = $this->execute($sql, [$B->ekpaidey]);
        if($res->rowCount() == 1){
            $row = $res->fetch();
            $B->kwd_ptyxio = $row['kwd_ptyxio'];
            $B->per_ptyxiou = $row['per_ptyxiou'];
            $B->vathmos = $row['vathmos'];
            $B->date_apokthshs = $row['date_apokthshs'];
        } 
        else{
            $B->kwd_ptyxio = [];
            $B->per_ptyxiou = [];
            $B->vathmos = [];
            $B->date_apokthshs = [];
            $data = $res->fetchAll();
            foreach($data as $row) {
                array_push($B->kwd_ptyxio, $row['kwd_ptyxio']);
                array_push($B->per_ptyxiou, $row['per_ptyxiou']);
                array_push($B->vathmos, $row['vathmos']);
                array_push($B->date_apokthshs, $row['date_apokthshs']);
            }
        }
    }*/
    
    //using the employee_id this function fills a table with the queries result (1 tables results getting parsed at the same time) and returns it
    function getKnowledge($empl_id){
        $sql = "SELECT epimorfosh.vathmos, epimorfosh.date_apokthshs, ekpaideysh.kwd_ptyxio, ekpaideysh.per_ptyxiou FROM epimorfosh JOIN ekpaideysh on ekpaideysh.kwd_ptyxio = epimorfosh.eidikeysh JOIN ergazomenos ON ergazomenos.kwd_ergazomenou = epimorfosh.ekpaideyomenos WHERE ergazomenos.kwd_ergazomenou = ? ;"; 
        $this->connect();
        $res = $this->execute($sql, [$empl_id]);
        $rows = $res->fetchAll();
        return $rows;
    }

    //gets 1 employees address and saves the data in an Address object (requires employee_id)
    function getAddress(&$P){
        $sql = "SELECT address_ergazomenou.odos, address_ergazomenou.arithmos, address_ergazomenou.polh, address_ergazomenou.zip_code FROM address_ergazomenou WHERE address_ergazomenou.kwd_ergazomenou_adr = ? ;";
        $this->connect();
        $res = $this->execute($sql, [$P->kwd_ergazomenou_adr]);
        if($res->rowCount() == 1){
            $row = $res->fetch();
            $P->arithmos = $row['arithmos'];
            $P->polh = $row['polh'];
            $P->odos = $row['odos'];
            $P->zip_code = $row['zip_code'];
        }
    }
    
    //fetches all rows from ergazomenos table and returns a table with the data returned
    function getAllErgazom(){
        $sql = "SELECT kwd_ergazomenou, Eponymo_ergazom, Onoma_Ergazom, Patronymo_Ergazom, Fyllo_Ergaz, AFM_Ergaz, DOB_Ergazom, Tel_Ergaz, Salary_Ergazom, Kod_tm_ergazom, user_type_ergazom FROM ergazomenos ;";
        $this->connect();
        $res = $this->execute($sql, []);
        $rows = $res->fetchAll();
        return $rows;  
    } 
    
    //fetches all rows from department table and returns a table with the data returned
    function getAllDepartments(){
        $sql = "SELECT kwd_tmhmatos, onoma_tmhmatos, kwd_proistamenou FROM tmhma ;";
        $this->connect();
        $res = $this->execute($sql, []);
        $rows = $res->fetchAll();
        return $rows;
    }
    
    //given the departments_id this function prints the supervising employees full name
    function getSupervisorName($supervisor_id){
        $sql = "SELECT ergazomenos.Eponymo_ergazom, ergazomenos.Onoma_Ergazom  FROM ergazomenos JOIN tmhma ON ergazomenos.kwd_ergazomenou = tmhma.kwd_proistamenou WHERE tmhma.kwd_proistamenou = ? ;";
        $this->connect();
        $res = $this->execute($sql, [$supervisor_id]);
        $row = $res->fetch();
        echo $row['Eponymo_ergazom']." ".$row['Onoma_Ergazom'];
    }
    
    //fills a table with all employees that belong in the required (dpt_id) deparment (counts the number of rows fetched as well)
    function getDptStaff($department_id){
        Database::$count = 0;
        $sql = "SELECT ergazomenos.Eponymo_ergazom, ergazomenos.Onoma_Ergazom  FROM ergazomenos WHERE ergazomenos.Kod_tm_ergazom = ? ;";
        $this->connect();
        $res = $this->execute($sql, [$department_id]);
        $rows = $res->fetchAll();
        foreach($rows as $row){
            Database::$count++;
        }
        return $rows;
    }
    
    //fetches all rows from ergo table and returns a table with the data returned
    function getAllErga(){
        $sql = "SELECT kwd_ergou, perigrafh_ergou, start_date, finish_date FROM ergo ;";
        $this->connect();
        $res = $this->execute($sql, []);
        $rows = $res->fetchAll();
        return $rows;
    }
    
    //prints the name of the department that is assigned on the given project (project_id required), or prints "Not Yet Assigned" if the project is not in development yet
    function getTmhmaOnErgo($project_id){
        $sql = "SELECT tmhma.onoma_tmhmatos FROM tmhma JOIN tmhmata_se_erga ON tmhma.kwd_tmhmatos = tmhmata_se_erga.kwd_tmhmatos_ergou JOIN ergo ON tmhmata_se_erga.kwd_ergou_tmhma = ergo.kwd_ergou WHERE ergo.kwd_ergou = ? ;";
        $this->connect();
        $res = $this->execute($sql, [$project_id]);
        $row = $res->fetch();
        echo $row['onoma_tmhmatos']??"Not Yet Assigned";
    }
    
    
    //fetches first and last names of all the employees currently deployed in the project provided (project_id)
    function getAssignedEmployees($proj_id){
        Database::$count = 0;
        $sql = "SELECT ergazomenos.Onoma_Ergazom, ergazomenos.Eponymo_ergazom FROM ergazomenos JOIN ergazomenoi_se_erga ON ergazomenos.kwd_ergazomenou = ergazomenoi_se_erga.kwd_ergazom_ergo JOIN ergo ON ergazomenoi_se_erga.kwd_ergou = ergo.kwd_ergou WHERE ergo.kwd_ergou = ? ;";
        $this->connect();
        $res = $this->execute($sql, [$proj_id]);
        $rows = $res->fetchAll();
        foreach($rows as $row){
            Database::$count++;
        }
        return $rows;
    }
    
    //fetches all rows from oxhma table and returns a table with the data returned
    function getAllVehicles(){
        $sql = "SELECT ar_kykloforias, xroma_oxhm, montelo_oxhm, marka_oxhm, odhgos FROM oxhma ;";
        $this->connect();
        $res = $this->execute($sql, []);
        $rows = $res->fetchAll();
        return $rows;
    }
    
    //prints the full name of the provided vehicles (veh_id) driver
    function getDrivers($driver_id){
        $sql = "SELECT ergazomenos.Onoma_Ergazom, ergazomenos.Eponymo_ergazom FROM ergazomenos JOIN oxhma ON oxhma.odhgos = ergazomenos.kwd_ergazomenou WHERE oxhma.odhgos = ? ;";
        $this->connect();
        $res = $this->execute($sql, [$driver_id]);
        $row = $res->fetch();
        echo ($row['Onoma_Ergazom']." ".$row['Eponymo_ergazom'])??"Not Yet Assigned";
    }
    
    //fetches all rows from ekpaideysh table and returns a table with the data returned
    function getAllDegrees(){
        $sql = "SELECT kwd_ptyxio, per_ptyxiou FROM ekpaideysh ;";
        $this->connect();
        $res = $this->execute($sql, []);
        $rows = $res->fetchAll();
        return $rows;
    }
    
    //fills a table with: first/last name, degree, date  of the employees who currently possess the given diploma (diploma_id)
    function getDiplomaHolder($diploma_id){
        Database::$count = 0;
        $sql = "SELECT ergazomenos.Eponymo_ergazom, ergazomenos.Onoma_Ergazom, epimorfosh.vathmos, epimorfosh.date_apokthshs FROM ergazomenos JOIN epimorfosh ON epimorfosh.ekpaideyomenos = ergazomenos.kwd_ergazomenou JOIN ekpaideysh ON epimorfosh.eidikeysh = ekpaideysh.kwd_ptyxio WHERE ekpaideysh.kwd_ptyxio = ? ;";
        $this->connect();
        $res = $this->execute($sql, [$diploma_id]);
        $rows = $res->fetchAll();
        foreach($rows as $row){
            Database::$count++;
        }
        return $rows;
    }
    
    //fetches all rows from address_ergazomenou table and returns a table with the data returned
    function getAllAddresses(){
        $sql = "SELECT odos, arithmos, polh, zip_code, kwd_ergazomenou_adr FROM address_ergazomenou ;";
        $this->connect();
        $res = $this->execute($sql, []);
        $rows = $res->fetchAll();
        return $rows;
    }
    
    //prints the full name of the employee with the current address (addr_id)
    function getResidentName($res_id){
        $sql = "SELECT ergazomenos.Onoma_Ergazom, ergazomenos.Eponymo_ergazom FROM ergazomenos JOIN address_ergazomenou ON address_ergazomenou.kwd_ergazomenou_adr = ergazomenos.kwd_ergazomenou WHERE address_ergazomenou.kwd_ergazomenou_adr = ? ;";
        $this->connect();
        $res = $this->execute($sql, [$res_id]);
        $row = $res->fetch();
        echo $row['Onoma_Ergazom']." ".$row['Eponymo_ergazom'];
    }
    
    //fills a table  with: first/last name, employee_id  of all the employees to be later used in function getAllInsured($ins_id)
    function getAllInsurers(){
        $sql = "SELECT kwd_ergazomenou , Eponymo_ergazom, Onoma_Ergazom FROM ergazomenos ;";
        $this->connect();
        $res = $this->execute($sql, []);
        $rows = $res->fetchAll();
        return $rows;
    }
    
    //fills a table with all the Insured under the given epmloyee_id
    function getAllInsured($ins_id){
        $sql = "SELECT eksartomenos.AMKA_eksart, eksartomenos.Onoma_eksart, eksartomenos.Eponymo_eksart, eksartomenos.DOB_eksart, eksartomenos.Fylo_eksart FROM eksartomenos JOIN ergazomenos ON eksartomenos.kod_prostati = ergazomenos.kwd_ergazomenou WHERE eksartomenos.kod_prostati = ? ;";
        $this->connect();
        $res = $this->execute($sql, [$ins_id]);
        $rows = $res->fetchAll();
        return $rows;
    }

    //-----------------------------  FUNCTIONS USED IN ADD_OR_CHANGE PHP FILE  -------------------------------------
    //fills a table with the names and ids of all the departments and returns it
    function loadAllDepartments(){
        $sql = "SELECT kwd_tmhmatos, onoma_tmhmatos FROM tmhma ;";
        $this->connect();
        $res = $this->execute($sql, []);
        $rows = $res->fetchAll();
        return $rows;
    }
    
    //fills a table with the names and ids of all the departments and prints its vallues as <option> tags
    function loadAllDepartmentsV2(){
        $sql = "SELECT kwd_tmhmatos, onoma_tmhmatos FROM tmhma ;";
        $this->connect();
        $res = $this->execute($sql, []);
        $rows = $res->fetchAll();
        foreach($rows as $row){
            echo "<option value='".$row['kwd_tmhmatos']."'>".$row['kwd_tmhmatos']. " - ".$row['onoma_tmhmatos']."</option>";
        }
    }
    
    //fills a table with all the rights (admin/user) and prints its values as <option> tags
    function loadAllRights(){
        $sql = "SELECT user_type_id, user_type_name FROM user_type ;";
        $this->connect();
        $res = $this->execute($sql, []);
        $rows = $res->fetchAll();
        foreach($rows as $row){
            echo "<option value='".$row['user_type_id']."'>".$row['user_type_id']. " - ".$row['user_type_name']."</option>";
        }
    }
    
    function loadAllProjectNames_ID(){
        $sql = "SELECT kwd_ergou , perigrafh_ergou FROM ergo ;";
        $this->connect();
        $res = $this->execute($sql, []);
        $rows = $res->fetchAll();
        foreach($rows as $row){
            echo "<option value='".$row['kwd_ergou']."'>".$row['kwd_ergou']. " - ".$row['perigrafh_ergou']."</option>";
        }
    }
    
    //adds a new row in the ergazomenos table
    public function setErgazomenos($ergazomenos){
        $this->connect();
        $sql = "INSERT INTO ergazomenos ( Eponymo_ergazom,"
                . " Onoma_Ergazom, Patronymo_Ergazom, Fyllo_Ergaz, AFM_Ergaz,"
                . " DOB_Ergazom, Tel_Ergaz, Salary_Ergazom, Kod_tm_ergazom, "
                . "user_type_ergazom) VALUES (?,?,?,?,?,?,?,?,?,?)";
        $this->execute($sql, [$ergazomenos->Eponymo_ergazom,
                              $ergazomenos->Onoma_Ergazom,
                              $ergazomenos->Patronymo_Ergazom,
                              $ergazomenos->Fyllo_Ergaz,
                              $ergazomenos->AFM_Ergaz,
                              $ergazomenos->DOB_Ergazom,
                              $ergazomenos->Tel_Ergaz,
                              $ergazomenos->Salary_Ergazom,
                              $ergazomenos->Kod_tm_ergazom,
                              $ergazomenos->user_type_ergazom]);
    }
    
    //adds a new row in the credentials table
    public function setCredentials($credentials){
        $this->connect();
        $sql = "INSERT INTO credentials (username, password, kwd_ergazom_cred) VALUES (?,?,?)";
        $this->execute($sql, [$credentials->username,
                              $credentials->password,
                              $credentials->kwd_ergazom_cred]);
    }
    
    //returns the employee_id with the given $afm to be used in the public function setCredentials($credentials)
    function getID($afm){
        $sql = "SELECT kwd_ergazomenou FROM ergazomenos WHERE AFM_Ergaz = ? ;";
        $this->connect();
        $res = $this->execute($sql, [$afm]);
        $row = $res->fetch();
        return $row['kwd_ergazomenou'];
    }
    
    
    //fills a table with all the emploees (first/last names, employee_id)
    function loadAllEmployees(){
        $sql = "SELECT kwd_ergazomenou, Onoma_Ergazom, Eponymo_ergazom  FROM ergazomenos ;";
        $this->connect();
        $res = $this->execute($sql, []);
        $rows = $res->fetchAll();
        foreach($rows as $row){
            echo "<option value='".$row['kwd_ergazomenou']."'>".$row['kwd_ergazomenou']." - ".$row['Onoma_Ergazom']. " ".$row['Eponymo_ergazom']."</option>";
        }   
    }
    
    //deletes all data in all tables that connect with the given employee_id (if all the key constraints are set correctly it is the only function needed to completely delete a user from the cloup DB)
    function delUser($userID){
        $sql = "DELETE FROM ergazomenos WHERE kwd_ergazomenou = ? ;";
        $this->connect();
        $res = $this->execute($sql, [$userID]);
    }
    
    //input a new row in the Tmhma DB table with values given by the required Tmhma class object ($department)
    function setNewDpt($department){
        $this->connect();
        $sql = "INSERT INTO tmhma (onoma_tmhmatos, kwd_proistamenou) VALUES (?,?)";
        $this->execute($sql, [$department->onoma_tmhmatos,
                              $department->kwd_proistamenou]);
    }
    
    function setNewErgo($ergo){
        $this->connect();
        $sql = "INSERT INTO ergo (perigrafh_ergou, start_date, finish_date) VALUES (?,?,?)";
        $this->execute($sql, [$ergo->perigrafh_ergou,
                              $ergo->start_date,
                              $ergo->finish_date]);
    }
    
    
    function setProj_Dpt($tmhma_on_ergo){
        $sql = "SELECT assignment_id  FROM tmhmata_se_erga WHERE kwd_tmhmatos_ergou = ? AND kwd_ergou_tmhma = ? ;";
        $this->connect();
        $res = $this->execute($sql, [$tmhma_on_ergo->kwd_tmhmatos_ergou,
                                     $tmhma_on_ergo->kwd_ergou_tmhma]);
        $row = $res->fetch();
        if(!empty($row)){
            echo 'Assignment Already Exists!';
        }else{
            $sql = "INSERT INTO tmhmata_se_erga (kwd_tmhmatos_ergou, kwd_ergou_tmhma) VALUES (?,?)";
            $this->connect();
            $this->execute($sql, [$tmhma_on_ergo->kwd_tmhmatos_ergou,
                                  $tmhma_on_ergo->kwd_ergou_tmhma]);
        }
    }
    
    function setEmp_Dpt($ergaz_on_ergo){
        $sql = "SELECT assigned_id FROM ergazomenoi_se_erga WHERE kwd_ergazom_ergo  = ? AND kwd_ergou  = ? ;";
        $this->connect();
        $res = $this->execute($sql, [$ergaz_on_ergo->kwd_ergazom_ergo,
                                     $ergaz_on_ergo->kwd_ergou]);
        $row = $res->fetch();
        if(!empty($row)){
            echo 'Assignment Already Exists!';
        }else{
            $sql = "INSERT INTO ergazomenoi_se_erga (kwd_ergazom_ergo, kwd_ergou) VALUES (?,?)";
            $this->connect();
            $this->execute($sql, [$ergaz_on_ergo->kwd_ergazom_ergo,
                                  $ergaz_on_ergo->kwd_ergou]);
        }
    }
    
    function setNewCar($vehicle){
        $this->connect();
        $sql = "INSERT INTO oxhma (ar_kykloforias , xroma_oxhm, montelo_oxhm, marka_oxhm, odhgos) VALUES (?,?,?,?,?)";
        $this->execute($sql, [$vehicle->ar_kykloforias,
                              $vehicle->xroma_oxhm,
                              $vehicle->montelo_oxhm,                  
                              $vehicle->marka_oxhm,
                              $vehicle->odhgos]);
    }
    
    function delCar($carID){
        $sql = "DELETE FROM oxhma WHERE ar_kykloforias = ? ;";
        $this->connect();
        $res = $this->execute($sql, [$carID]);
    }
    
    function loadAllCars(){
        $sql = "SELECT ar_kykloforias, marka_oxhm, montelo_oxhm  FROM oxhma ;";
        $this->connect();
        $res = $this->execute($sql, []);
        $rows = $res->fetchAll();
        foreach($rows as $row){
            echo "<option value='".$row['ar_kykloforias']."'>".$row['ar_kykloforias']." - ".$row['marka_oxhm']. " ".$row['montelo_oxhm']."</option>";
        }   
    }
    
    function setNewDiploma($diploma){
        $sql = "INSERT INTO ekpaideysh (per_ptyxiou) VALUES (?)";
        $this->connect();
        $this->execute($sql, [$diploma->per_ptyxiou]);
    }
    
    function loadAllDiplomas(){
        $sql = "SELECT kwd_ptyxio , per_ptyxiou FROM ekpaideysh ;";
        $this->connect();
        $res = $this->execute($sql, []);
        $rows = $res->fetchAll();
        foreach($rows as $row){
            echo "<option value='".$row['kwd_ptyxio']."'>".$row['kwd_ptyxio']." - ".$row['per_ptyxiou']."</option>";
        } 
    }
    
    function setDiplomaHolder($epimorfosh){
        $this->connect();
        $sql = "INSERT INTO epimorfosh (ekpaideyomenos, eidikeysh, date_apokthshs, vathmos) VALUES (?,?,?,?)";
        $this->execute($sql, [$epimorfosh->ekpaideyomenos,
                              $epimorfosh->eidikeysh,
                              $epimorfosh->date_apokthshs,                  
                              $epimorfosh->vathmos]);
    }
    
    function setNewAddress($address){
        $this->connect();
        $sql = "INSERT INTO address_ergazomenou (odos , arithmos, polh, zip_code, kwd_ergazomenou_adr ) VALUES (?,?,?,?,?)";
        $this->execute($sql, [$address->odos,
                              $address->arithmos,
                              $address->polh,                  
                              $address->zip_code,
                              $address->kwd_ergazomenou_adr ]);
    }
    
    function delAdr($resident){
        $sql = "DELETE FROM address_ergazomenou WHERE kwd_ergazomenou_adr = ? ;";
        $this->connect();
        $res = $this->execute($sql, [$resident]);
    }
    
    function loadAllAddresses(){
        $sql = "SELECT odos, arithmos, polh, kwd_ergazomenou_adr FROM address_ergazomenou ;";
        $this->connect();
        $res = $this->execute($sql, []);
        $rows = $res->fetchAll();
        foreach($rows as $row){
            $sql = "SELECT ergazomenos.Eponymo_ergazom, ergazomenos.Onoma_Ergazom FROM ergazomenos JOIN address_ergazomenou ON ergazomenos.kwd_ergazomenou = address_ergazomenou.kwd_ergazomenou_adr WHERE address_ergazomenou.kwd_ergazomenou_adr = ? ;";
            $this->connect();
            $res = $this->execute($sql, [$row['kwd_ergazomenou_adr']]);
            $driver = $res->fetch();
            echo "<option value='".$row['kwd_ergazomenou_adr']."'>".$row['odos']." ".$row['arithmos']. " ".$row['polh']."  -  ".$driver['Eponymo_ergazom']." ".$driver['Onoma_Ergazom']."</option>";
        }
    }
    
    function setNewDependant($dependant){
        $this->connect();
        $sql = "INSERT INTO eksartomenos (AMKA_eksart  , Onoma_eksart, Eponymo_eksart, DOB_eksart, Fylo_eksart, kod_prostati) VALUES (?,?,?,?,?,?) ;";
        $this->execute($sql, [$dependant->AMKA_eksart,
                              $dependant->Onoma_eksart,
                              $dependant->Eponymo_eksart,                  
                              $dependant->DOB_eksart,
                              $dependant->Fylo_eksart,
                              $dependant->kod_prostati]);
    }
    
    function addNewChild($amka_child){
        $sql = "INSERT INTO tekno (AMKA_teknou) VALUES (?)";
        $this->connect();
        $this->execute($sql, [$amka_child]);
    }
    
    function addNewSpouce($amka_spouce){
        $sql = "INSERT INTO syzygos (AMKA_syzygou) VALUES (?)";
        $this->connect();
        $this->execute($sql, [$amka_spouce]);
    }
    
    function delDep($amka_dep){
        $sql1 = "DELETE FROM eksartomenos WHERE AMKA_eksart  = ? ;";
        $this->connect();
        $res = $this->execute($sql1, [$amka_dep]);
    }
    
    function loadAllDependants(){
        $sql = "SELECT Onoma_eksart, Eponymo_eksart, AMKA_eksart, kod_prostati FROM eksartomenos ;";
        $this->connect();
        $res = $this->execute($sql, []);
        $rows = $res->fetchAll();
        foreach($rows as $row){
            $sql = "SELECT ergazomenos.Eponymo_ergazom, ergazomenos.Onoma_Ergazom FROM ergazomenos JOIN eksartomenos ON ergazomenos.kwd_ergazomenou = eksartomenos.kod_prostati  WHERE eksartomenos.kod_prostati = ? ;";
            $this->connect();
            $res = $this->execute($sql, [$row['kod_prostati']]);
            $insurer = $res->fetch();
            echo "<option value='".$row['AMKA_eksart']."'>".$row['AMKA_eksart']." - ".$row['Onoma_eksart']. " ".$row['Eponymo_eksart']."  -  ".$insurer['Onoma_Ergazom']." ".$insurer['Eponymo_ergazom']."</option>";
        }
    }

//------------------------------- PROJECT SPECIFIC FUNCTION DECLERATIONS AND CODING END HERE ------------------------------------------------    
}//end of class Database