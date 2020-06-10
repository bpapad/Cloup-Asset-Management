<?php
    session_start();
    require_once ("Classes/Database.php");
    require_once ("Classes/Ergazomenos.php");
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta content="IE=edge" http-equiv="X-UA-Compatible">
	<meta content="width=device-width, initial-scale=1" name="viewport">
	
	<!-- CSS -->
        <link href="css/body_background.css" rel="stylesheet">
        <link href="css/logged_in_page.css" rel="stylesheet">
        <link href="css/tabs.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	
	<!-- Fonts  -->
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,400italic,600italic,600,700italic' rel='stylesheet' type='text/css'>	

</head>
<body>
    <h1>Cloup Industries</h1>
    <div class="main_container">
        <div>
            <h3 class="text-left-right">
                <span class="left-text">
                <?php 
                    echo $_SESSION['Onoma_Ergazom']." ".$_SESSION['Eponymo_ergazom'];
                ?>
                </span>
                <span class="right-text">
                <?php                                  
                    echo 'Admin';
                ?>
                </span>
            </h3>
            <hr class="split">
	</div>
        
        
        <div class="tab-wrap">
		
            <input type="radio" id="tab1" name="tabGroup1" class="tab" checked>
            <label for="tab1">Employees</label>

            <input type="radio" id="tab2" name="tabGroup1" class="tab">
            <label for="tab2">Departments</label>

            <input type="radio" id="tab3" name="tabGroup1" class="tab">
            <label for="tab3">Projects</label>

            <input type="radio" id="tab4" name="tabGroup1" class="tab">
            <label for="tab4">Vehicles</label>

            <input type="radio" id="tab5" name="tabGroup1" class="tab">
            <label for="tab5">Education</label>

            <input type="radio" id="tab6" name="tabGroup1" class="tab">
            <label for="tab6">Addresses</label>

            <input type="radio" id="tab7" name="tabGroup1" class="tab">
            <label for="tab7">Dependants</label>

            <div class="tab__content">  <!-- LISTA ERGAZOMENWN -->
                
                <?php 
                    $DB = new Database();
                    $ergazomenoi = $DB->getAllErgazom();
                ?>
                
                <h2>ΣΤΟΙΧΕΙΑ ΠΡΟΣΩΠΙΚΟΥ</h2>
                <div class="table-wrapper">
                    <table class="fl-table">  
                        <thead>
                        <tr>
                            <th>Cloup ID</th>
                            <th>Lastname</th>
                            <th>Firstname</th>
                            <th>Father's</th>
                            <th>Gender</th>
                            <th>DOB</th>
                            <th>Phone</th>
                            <th>Social Sec Num</th>
                            <th>Salary</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php    
                            foreach($ergazomenoi as $ergazomenos){
                        ?>
                        <tr>                         <!-- Gemisma pinaka me ta dedomena tou xrhsth apo to session -->
                            <td><?php echo $ergazomenos['kwd_ergazomenou']?></td>
                            <td><?php echo $ergazomenos['Eponymo_ergazom']?></td>
                            <td><?php echo $ergazomenos['Onoma_Ergazom']?></td>
                            <td><?php echo $ergazomenos['Patronymo_Ergazom']?></td>
                            <td><?php echo $ergazomenos['Fyllo_Ergaz']?></td>
                            <td><?php echo $ergazomenos['DOB_Ergazom']?></td>
                            <td><?php echo $ergazomenos['Tel_Ergaz']?></td>
                            <td><?php echo $ergazomenos['AFM_Ergaz']?></td>
                            <td><?php echo $ergazomenos['Salary_Ergazom']?></td>
                        </tr>
                        <?php }?>
                        <tbody>
                    </table>
                </div>
                
            </div>

            <div class="tab__content"> <!-- LISTA TMHMATWN -->
                
                <?php
                    $departments = $DB->getAllDepartments();
                ?>
                
                <h2>TMHMAΤΑ</h2>
                <div class="table-wrapper">
                    <table class="fl-table">  
                        <thead>
                        <tr>
                            <th>Dpt ID</th>
                            <th>Department</th>
                            <th>Supervisor</th>
                            <th>Staff</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php 
                            foreach($departments as $department){
                                $staff = $DB->getDptStaff($department['kwd_tmhmatos']);
                        ?>
                            <tr>                         <!-- Gemisma pinaka me ta dedomena tou xrhsth apo to session -->
                                <td><?php echo $department['kwd_tmhmatos']?></td>
                                <td><?php echo $department['onoma_tmhmatos']?></td>
                                <td><?php echo $DB->getSupervisorName($department['kwd_proistamenou'])?></td>
                                <td><?php echo "Employees : ".Database::$count;?></td>
                            </tr>
                            <?php 
                                foreach($staff as $member){?>
                                <tr>                         <!-- Gemisma pinaka me ta dedomena tou xrhsth apo to session -->
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><?php echo $member['Eponymo_ergazom']." ".$member['Onoma_Ergazom']?></td>
                            </tr>
                            <?php }?>
                            <tr>
                                <td><hr></td>
                                <td><hr></td>
                                <td><hr></td>
                                <td><hr></td>
                            </tr>
                        <?php } ?>
                        <tbody>
                    </table>
                </div>
                
            </div>

            <div class="tab__content">
                
                <?php
                    $projects = $DB->getAllErga();
                ?>
                
                <h2>ΕΡΓΑ</h2> <!-- LISTA PROJECT -->
                <div class="table-wrapper">
                    <table class="fl-table">  
                        <thead>
                        <tr>
                            <th>Project ID</th>
                            <th>Project Name</th>
                            <th>Start Date</th>
                            <th>Finish Date</th>
                            <th>Leading Dpt</th>
                            <th>Assigned Staff</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach ($projects as $project){
                                    $occupants = $DB->getAssignedEmployees($project["kwd_ergou"]);
                            ?>
                            <tr>
                                <td><?php echo $project["kwd_ergou"]?></td>
                                <td><?php echo $project["perigrafh_ergou"]?></td>
                                <td><?php echo $project["start_date"]?></td>
                                <td><?php echo $project["finish_date"]?></td>
                                <td><?php echo $DB->getTmhmaOnErgo($project["kwd_ergou"])?></td>
                                <td><?php echo (Database::$count !== 0)?("Employees : ".Database::$count):("None Assigned");?></td>
                            </tr>
                            <?php 
                                foreach($occupants as $occupant){?>
                                <tr>                         <!-- Gemisma pinaka me ta dedomena tou xrhsth apo to session -->
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><?php echo $occupant['Eponymo_ergazom']." ".$occupant['Onoma_Ergazom']?></td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <td><hr></td>
                                <td><hr></td>
                                <td><hr></td>
                                <td><hr></td>
                                <td><hr></td>
                                <td><hr></td>
                            </tr>
                        <?php } ?>
                        <tbody>
                    </table>
                </div>
                
            </div>

            <div class="tab__content"> <!-- LISTA OXHMATWN -->
                
                <?php
                    $vehicles = $DB->getAllVehicles();
                ?>
                
                <h2>ΟΧΗΜΑΤΑ</h2> 
                <div class="table-wrapper">
                    <table class="fl-table">  
                        <thead>
                        <tr>
                            <th>Licence Plate</th>
                            <th>Brand</th>
                            <th>Model</th>
                            <th>Color</th>
                            <th>Driver</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php 
                                foreach($vehicles as $vehicle) {
                            ?>
                            <tr>
                                <td><?php echo $vehicle['ar_kykloforias'] ?></td>
                                <td><?php echo $vehicle['marka_oxhm'] ?></td>
                                <td><?php echo $vehicle['montelo_oxhm'] ?></td>
                                <td><?php echo $vehicle['xroma_oxhm'] ?></td>
                                <td><?php echo $DB->getDrivers($vehicle['odhgos']) ?></td>
                            </tr>
                            <?php } ?>
                        <tbody>
                    </table>
                </div>
            </div>
           

            <div class="tab__content"> <!-- LISTA EKPAIDEYSHS -->
                
                <?php
                    $degrees = $DB->getAllDegrees();
                ?>
                
                <h2>ΕΚΠΑΙΔΕΥΣΗ</h2>
                <div class="table-wrapper">
                    <table class="fl-table">  
                        <thead>
                        <tr>
                            <th>Diploma ID</th>
                            <th>Diploma Name</th>
                            <th>Holder</th>
                            <th>Grade</th>
                            <th>Aqcuisition Date</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php 
                                foreach($degrees as $degree) {
                                    $bachelors = $DB->getDiplomaHolder($degree['kwd_ptyxio']);
                            ?>
                            <tr>
                                <td><?php echo $degree['kwd_ptyxio'] ?></td>
                                <td><?php echo $degree['per_ptyxiou'] ?></td>
                                <td><?php echo "Owners : ".Database::$count ?></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <?php 
                                foreach ($bachelors as $bachelor) {
                            ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td><?php echo $bachelor['Onoma_Ergazom']." ".$bachelor['Eponymo_ergazom'] ?></td>
                                <td><?php echo $bachelor['vathmos'] ?></td>
                                <td><?php echo $bachelor['date_apokthshs'] ?></td>
                            </tr>
                            <?php }?>
                            <tr>
                                <td><hr></td>
                                <td><hr></td>
                                <td><hr></td>
                                <td><hr></td>
                                <td><hr></td>
                            </tr>
                        <?php } ?>
                        <tbody>
                    </table>
                </div>
                
            </div>
            
            <div class="tab__content"> <!-- LISTA DIEYTHYNSHS -->
                
                <?php
                    $addresses = $DB->getAllAddresses();
                ?>
                
                <h2>ΔΙΕΥΘΥΝΣΕΙΣ</h2>
                <div class="table-wrapper">
                    <table class="fl-table">  
                        <thead>
                        <tr>
                            <th>Zip Code</th>
                            <th>Street</th>
                            <th>Number</th>
                            <th>City</th>
                            <th>Resident</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php 
                                foreach ($addresses as $address){
                            ?>
                            <tr>
                                <td><?php echo $address['zip_code']; ?></td>
                                <td><?php echo $address['odos']; ?></td>
                                <td><?php echo $address['arithmos']; ?></td>
                                <td><?php echo $address['polh']; ?></td>
                                <td><?php echo $DB->getResidentName($address['kwd_ergazomenou_adr']); ?></td>
                            </tr>
                            <?php } ?>
                        <tbody>
                    </table>
                </div>
            </div>

            <div class="tab__content"> <!-- LISTA EKSARTWMENWN -->
                <?php 
                    $insurers = $DB->getAllInsurers();
                ?>
                <h2>ΣΤΟΙΧΕΙΑ ΕΞΑΡΤΩΜΕΝΩΝ</h2> 
                <div class="table-wrapper">
                    <table class="fl-table">  
                        <thead>
                        <tr>
                            <th>Insurer</th>
                            <th>Lastname</th>
                            <th>Firstname</th>
                            <th>Gender</th>
                            <th>DOB</th>
                            <th>Social Sec Num</th>
                            <th>Relation</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php 
                                foreach ($insurers as $insurer){
                                    $insured = $DB->getAllInsured($insurer['kwd_ergazomenou']);
                            ?>
                            <tr>
                                <td><?php echo $insurer['Onoma_Ergazom']." ".$insurer['Eponymo_ergazom']; ?></td>
                                <td><?php echo "Insured : ".Database::$count ?></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <?php foreach ($insured as $dependant) {?>
                                <tr>
                                    <td></td>
                                    <td><?php echo $dependant['Eponymo_eksart'] ?></td>
                                    <td><?php echo $dependant['Onoma_eksart'] ?></td>
                                    <td><?php echo $dependant['Fylo_eksart'] ?></td>
                                    <td><?php echo $dependant['DOB_eksart'] ?></td>
                                    <td><?php echo $dependant['AMKA_eksart'] ?></td>
                                    <td><?php echo $DB->child_spouce($dependant['AMKA_eksart']) ?></td>
                                </tr>
                            <?php } ?>
                                <tr>
                                <td><hr></td>
                                <td><hr></td>
                                <td><hr></td>
                                <td><hr></td>
                                <td><hr></td>
                                <td><hr></td>
                                <td><hr></td>
                            </tr>
                        <?php } ?>
                        <tbody>
                    </table>
                </div>
            </div>
            
        </div>
                        
        <div class="button_cont center-text" align="center">
            <a class="example_a" href="add_or_change.php">Manage Assets</a>
        </div>
        
        <div class="button_cont text-left-right" align="center">
            <a class="example_a left-text" href="logged_in_page.php">Back to Profile</a>
            <a class="example_a right-text" href="logout.php">LOGOUT</a>
        </div>
        
    </div>
</body>
</html>
