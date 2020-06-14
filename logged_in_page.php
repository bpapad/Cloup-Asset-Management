<?php 
    session_start(); 
    require_once ("Classes/Ergazomenos.php");
    require_once ("Classes/Database.php");
    require_once ("Classes/Oxhma.php");
    require_once ("Classes/Ergo.php");
    require_once ("Classes/Eksartomenos.php");
    require_once ("Classes/Ekpaideysh.php");
    require_once ("Classes/Address_ergazomenou.php");
    require_once ("Classes/Tmhma.php");
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta content="IE=edge" http-equiv="X-UA-Compatible">
	<meta content="width=device-width, initial-scale=1" name="viewport">
	
	<!-- CSS -->
        <link href="css/tabs.css" rel="stylesheet">
        <link href="css/body_background.css" rel="stylesheet">
        <link href="css/logged_in_page.css" rel="stylesheet">
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
                    if($_SESSION['user_type_ergazom'] == 1) {                                   
                        echo 'Admin';    
                    }else{
                        echo 'User';    
                    }
                ?>
                </span>
            </h3>
            <hr class="split">
	</div>
            
        <?php
            $searchBDay = new Database();
            if($searchBDay->isbirthday()) { ?>
            <h2>Today's Birthdays!</h2>
                <div class="table-wrapper">
                    <table class="fl-table">  
                        <thead>
                            <tr>
                                <th>Celebrator</th>
                                <th>Address</th>
                            </tr>
                        </thead>
                        <tbody>
                                <?php $searchBDay->birthday($_SESSION['DOB_Ergazom']); ?>
                        </tbody>
                    </table>
                </div>
            <?php } ?>                                
        
        
        
        
		<div class="tab-wrap">
		
			<input type="radio" id="tab1" name="tabGroup1" class="tab" checked>
			<label for="tab1">Personal Info</label>

			<input type="radio" id="tab2" name="tabGroup1" class="tab">
			<label for="tab2">Department</label>

			<input type="radio" id="tab3" name="tabGroup1" class="tab">
			<label for="tab3">Project</label>

			<input type="radio" id="tab4" name="tabGroup1" class="tab">
			<label for="tab4">Vehicle</label>

			<input type="radio" id="tab5" name="tabGroup1" class="tab">
			<label for="tab5">Education</label>

			<input type="radio" id="tab6" name="tabGroup1" class="tab">
			<label for="tab6">Address</label>
			
			<input type="radio" id="tab7" name="tabGroup1" class="tab">
			<label for="tab7">Dependants</label>

			<div class="tab__content">
                            
                            <h2>ΠΡΟΣΩΠΙΚΑ ΣΤΟΙΧΕΙΑ</h2>
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
                                        <th>Taxpayer ID</th>
                                        <th>Salary</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>                         <!-- Gemisma pinaka me ta dedomena tou xrhsth apo to session -->
                                        <td><?php echo $_SESSION['kwd_ergazomenou']?></td>
                                        <td><?php echo $_SESSION['Eponymo_ergazom']?></td>
                                        <td><?php echo $_SESSION['Onoma_Ergazom']?></td>
                                        <td><?php echo $_SESSION['Patronymo_Ergazom']?></td>
                                        <td><?php echo $_SESSION['Fyllo_Ergaz']?></td>
                                        <td><?php echo $_SESSION['DOB_Ergazom']?></td>
                                        <td><?php echo $_SESSION['Tel_Ergaz']?></td>
                                        <td><?php echo $_SESSION['AFM_Ergaz']?></td>
                                        <td><?php echo $_SESSION['Salary_Ergazom']?></td>
                                    </tr>
                                    <tbody>
                                </table>
                            </div>
                            
                        </div>

			<div class="tab__content">
                            
                            <?php 
                                $DB = new Database();
                                $dpt = new Tmhma();
                                $dpt->setID($_SESSION['Kod_tm_ergazom']);
                                $dpt->getDepartment();
                            ?>
                            
                            <h2>TMHMA</h2>
                            <div class="table-wrapper">
                                <table class="fl-table">  
                                    <thead>
                                    <tr>
                                        <th>Dpt ID</th>
                                        <th>Department</th>
                                        <th>Supervisor</th>
                                        <th>Supervisor ID</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>                         <!-- Gemisma pinaka me ta dedomena tou xrhsth apo to session -->
                                        <td><?php echo $_SESSION['Kod_tm_ergazom']?></td>
                                        <td><?php echo $dpt->onoma_tmhmatos?></td>
                                        <td><?php echo ($_SESSION['kwd_ergazomenou'] == $dpt->kwd_proistamenou)?"Self":$DB->findSupervisor($dpt->kwd_proistamenou)?></td>
                                        <td><?php echo $dpt->kwd_proistamenou?></td>
                                    </tr>
                                    <tbody>
                                </table>
                            </div>
                            
                        </div>

			<div class="tab__content">
                            
                            <?php
                                $ergo = new Ergo();
                                $ergo->setWorker($_SESSION['kwd_ergazomenou']);
                                $ergo->getErgo();
                            ?>
                            
                            <h2>ΕΡΓΑΣΙΑΚΑ ΣΤΟΙΧΕΙΑ</h2>
                            <div class="table-wrapper">
                                <table class="fl-table">  
                                    <thead>
                                    <tr>
                                        <th>Project ID</th>
                                        <th>Project Name</th>
                                        <th>Start Date</th>
                                        <th>Finish Date</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(is_array($ergo->kwd_ergou)){
                                            for($i=0; $i<sizeof($ergo->kwd_ergou); $i++){ ?>
                                            <tr>
                                                <td><?php echo $ergo->kwd_ergou[$i] ?></td>
                                                <td><?php echo $ergo->perigrafh_ergou[$i] ?></td>
                                                <td><?php echo $ergo->start_date[$i] ?></td>
                                                <td><?php echo $ergo->finish_date[$i] ?></td>
                                            </tr>
                                        <?php }} else{?>
                                            <tr>
                                                <td><?php echo $ergo->kwd_ergou ?></td>
                                                <td><?php echo $ergo->perigrafh_ergou ?></td>
                                                <td><?php echo $ergo->start_date ?></td>
                                                <td><?php echo $ergo->finish_date ?></td>
                                            </tr>
                                        <?php }?>
                                    <tbody>
                                </table>
                            </div>
                        </div>

			<div class="tab__content">
                            
                            <?php 
                                $car = new Oxhma();
                                $car->setOdhgos($_SESSION['kwd_ergazomenou']);
                                $car->getCar();
                            ?>
                            
                            <h2>ΣΤΟΙΧΕΙΑ ΟΧΗΜΑΤΟΣ</h2>
                            <div class="table-wrapper">
                                <table class="fl-table">  
                                    <thead>
                                    <tr>
                                        <th>Licence Plate</th>
                                        <th>Brand</th>
                                        <th>Model</th>
                                        <th>Color</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(is_array($car->ar_kykloforias)){
                                            for($i=0; $i<sizeof($car->ar_kykloforias); $i++){ ?>
                                            <tr>
                                                <td><?php echo $car->ar_kykloforias[$i] ?></td>
                                                <td><?php echo $car->marka_oxhm[$i] ?></td>
                                                <td><?php echo $car->montelo_oxhm[$i] ?></td>
                                                <td><?php echo $car->xroma_oxhm[$i] ?></td>
                                            </tr>
                                        <?php }} else{?>
                                            <tr>
                                                <td><?php echo $car->ar_kykloforias?></td>
                                                <td><?php echo $car->marka_oxhm?></td>
                                                <td><?php echo $car->montelo_oxhm?></td>
                                                <td><?php echo $car->xroma_oxhm?></td>
                                            </tr>
                                        <?php }?>
                                    <tbody>
                                </table>
                            </div>
                        </div>

			<div class="tab__content">
                            
                            <?php
                                $DB = new Database();
                                $studies = $DB->getKnowledge($_SESSION['kwd_ergazomenou']);
                            ?>
                            
                            <h2>ΣΠΟΥΔΕΣ</h2>
                            <div class="table-wrapper">
                                <table class="fl-table">  
                                    <thead>
                                    <tr>
                                        <th>Degree</th>
                                        <th>Grade</th>
                                        <th>Date of Acquisition</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($studies as $study){ ?>
                                            <tr>
                                                <td><?php echo $study['per_ptyxiou'] ?></td>
                                                <td><?php echo $study['vathmos'] ?></td>
                                                <td><?php echo $study['date_apokthshs'] ?></td>
                                            </tr>
                                        <?php }?>
                                    <tbody>
                                </table>
                            </div>
                        </div>

			<div class="tab__content">
                            
                            <?php
                                $place = new Address_ergazomenou();
                                $place->setResident($_SESSION['kwd_ergazomenou']);
                                $place->getAddress();
                            ?>
                            
                            <h2>ΣΤΟΙΧΕΙΑ ΚΑΤΟΙΚΙΑΣ</h2>
                            <div class="table-wrapper">
                                <table class="fl-table">  
                                    <thead>
                                    <tr>
                                        <th>City</th>
                                        <th>Street</th>
                                        <th>Number</th>
                                        <th>Postal Code</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>                         <!-- Gemisma pinaka me ta dedomena tou xrhsth apo to session -->
                                        <td><?php echo $place->polh; ?></td>
                                        <td><?php echo $place->odos; ?></td>
                                        <td><?php echo $place->arithmos; ?></td>
                                        <td><?php echo $place->zip_code; ?></td>
                                    </tr>
                                    <tbody>
                                </table>
                            </div>
                        </div>
			
			<div class="tab__content">
                            
                            <?php 
                                $eksart = new Eksartomenos();
                                $eksart->setProstati($_SESSION['kwd_ergazomenou']);
                                $eksart->getEksartomeno();
                                $status = new Database();
                            ?>
                            
                            <h2>ΕΞΑΡΤΩΜΕΝΟΙ</h2>
                            <div class="table-wrapper">
                                <table class="fl-table">  
                                    <thead>
                                    <tr>
                                        <th>Social Sec Num</th>
                                        <th>Firstname</th>
                                        <th>Lastname</th>
                                        <th>Gender</th>
                                        <th>DOB</th>
                                        <th>Type (Spouce/Child)</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(is_array($eksart->AMKA_eksart)){
                                            for($i=0; $i<sizeof($eksart->AMKA_eksart); $i++){ ?>
                                            <tr>
                                                <td><?php echo $eksart->AMKA_eksart[$i] ?></td>
                                                <td><?php echo $eksart->Onoma_eksart[$i] ?></td>
                                                <td><?php echo $eksart->Eponymo_eksart[$i] ?></td>
                                                <td><?php echo $eksart->Fylo_eksart[$i] ?></td>
                                                <td><?php echo $eksart->DOB_eksart[$i] ?></td>
                                                <td><?php $status->child_spouce($eksart->AMKA_eksart[$i]) ?></td>
                                            </tr>
                                        <?php }} else{?>
                                            <tr>
                                                <td><?php echo $eksart->AMKA_eksart ?></td>
                                                <td><?php echo $eksart->Onoma_eksart ?></td>
                                                <td><?php echo $eksart->Eponymo_eksart ?></td>
                                                <td><?php echo $eksart->Fylo_eksart ?></td>
                                                <td><?php echo $eksart->DOB_eksart ?></td>
                                                <td><?php $status->child_spouce($eksart->AMKA_eksart)?></td>
                                            </tr>
                                        <?php }?>
                                    <tbody>
                                </table>
                            </div>
                        </div>

		</div>
		
        
        <div class="button_cont text-left-right" align="center">
            <?php if($_SESSION['user_type_ergazom'] == 1){ ?>
            <a class="example_a left-text" href="asset_management.php">Asset Management Center</a>
            <?php }?>
            <a class="example_a right-text" href="logout.php">LOGOUT</a>
        </div>
    </div>
	
</body>
</html>

