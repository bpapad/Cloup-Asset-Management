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
        <link href="css/form.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	
	<!-- Fonts  -->
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,400italic,600italic,600,700italic' rel='stylesheet' type='text/css'>	

</head>
<body>
    <h1>Cloup Industries</h1>
                                                                            <a class="example_a right-text" href="asset_management.php">LOGOUT</a>
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
			<label for="tab2">Department</label>

			<input type="radio" id="tab3" name="tabGroup1" class="tab">
			<label for="tab3">Project</label>

			<input type="radio" id="tab4" name="tabGroup1" class="tab">
			<label for="tab4">Vehicle</label>

			<input type="radio" id="tab5" name="tabGroup1" class="tab">
			<label for="tab5">Education</label>
			
			<input type="radio" id="tab6" name="tabGroup1" class="tab">
			<label for="tab6">Dependants</label>

<!-- ===============================================       EMPLOYEE SEARCH TAB     ========================================================== -->                        
                        <div class="tab__content">
                            
                         
                            
                        <h1>Employee Search</h1>
                        <hr style="height:1px;border:none;color:#333;background-color:#333;">
                        <?php if (!(filter_input(INPUT_POST, 'Search_User'))) {?>
                        <form action="" method="post">                                  <!-- ADD EMPLOYEE FORM STARTS HERE -->
                            <h1 style="text-align: center;">Target Search Employee :</h1>
                            <div class="contentform">

                                <div class="leftcontact">                               <!-- Left side elements of the form -->

                                    <div class="form-group">
                                        <p>Firstname <span>*</span></p>
                                        <span class="icon-case"></span>
                                        <input type="text" id="firstname" name="firstname">
                                        <div class="validation">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <p>Lastname <span>*</span></p>
                                        <span class="icon-case"></span>
                                        <input type="text" id="lastname" name="lastname">
                                        <div class="validation">
                                        </div>
                                    </div> 

                                    <div class="form-group">
                                        <p>Father's <span>*</span></p>    
                                        <span class="icon-case"></span>
                                        <input type="text" id="father" name="father">
                                        <div class="validation">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <p>Date of Birth <span>*</span></p>
                                        <span class="icon-case"><i class="fa fa-location-arrow"></i></span>
                                        <input type="date" id="dob" name="dob">
                                        <div class="validation">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <p>Phone <span>*</span></p>
                                        <span class="icon-case"></span>
                                        <input type="text" id="phone" name="phone">
                                        <div class="validation">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <p>Gender <span>*</span></p>
                                        <label for="male">Male</label>
                                        <input type="radio" id="male" name="gender" value="M">
                                        <label for="female">Female</label>
                                        <input type="radio" id="female" name="gender" value="F">
                                        <div class="validation">
                                        </div>
                                    </div>

                                </div>

                                <div class="rightcontact">                              <!-- Right side elements of the form -->
                                    
                                    <div class="form-group">
                                        <p>Cloup ID <span>*</span></p>
                                        <span class="icon-case"></span>
                                        <input type="text" id="cloup_id" name="cloup_id">
                                        <div class="validation">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <p>Salary <span>*</span></p>
                                        <span class="icon-case"></span>
                                        <input type="text" id="salary" name="salary">
                                        <div class="validation">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <p>Social Sec Num <span>*</span></p>
                                        <span class="icon-case"></span>
                                        <input type="text" id="amka" name="amka" maxlength="10">
                                        <div class="validation">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <p>Rights <span>*</span></p>
                                        <select id="rights" name="rights" class="form-control">
                                            <option value="NULL"> - </option>
                                            <?php                                       //1st method of parsing table elements into dropdown select tag options via using Function
                                                $DB = new Database();                   //$DB->loadAllRights(); handles the query as well as echoes all table data as options tags (each with its respectable value)
                                                $DB->loadAllRights();?>
                                        </select>
                                        <div class="validation">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <p>Department <span>*</span></p>
                                        <select id="department" name="department" class="form-control">
                                            <option value="NULL"> - </option>
                                            <?php                                       //2nd method of parsing table elements into dropdown select tag options via using $DB->loadAllDepartments();
                                                $departments = $DB->loadAllDepartments(); //After loading the requested data into a table, the option tags with their value arre getting printed inside the visible foreach loop
                                                foreach ($departments as $department){ ?>
                                            <option value="<?php echo $department['kwd_tmhmatos']?>"><?php echo $department['kwd_tmhmatos']." - ".$department['onoma_tmhmatos']?></option>
                                            <?php }?>
                                        </select>
                                        <div class="validation">
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <button type="submit" name="Search_User" id="Search_User" value="Search" class="bouton-contact">Search</button>
                        </form>    
                        <?php }
                            else{
                                $sql = "SELECT kwd_ergazomenou, Eponymo_ergazom,Onoma_Ergazom, Patronymo_Ergazom, Fyllo_Ergaz, AFM_Ergaz, DOB_Ergazom, Tel_Ergaz, Salary_Ergazom, Kod_tm_ergazom, user_type_ergazom FROM ergazomenos ";
                                $w = "WHERE 1";
                                
                                if(filter_input(INPUT_POST,'firstname') !== ""){
                                    $w = $w." AND Onoma_Ergazom LIKE  "."'%".filter_input(INPUT_POST,'firstname')."%'";
                                }
                                if(filter_input(INPUT_POST,'lastname') !== ""){
                                    $w = $w." AND Eponymo_ergazom LIKE  "."'%".filter_input(INPUT_POST,'lastname')."%'";
                                }
                                if(filter_input(INPUT_POST,'father') !== ""){
                                    $w = $w." AND Patronymo_Ergazom LIKE  "."'%".filter_input(INPUT_POST,'father')."%'";
                                }
                                if(filter_input(INPUT_POST,'dob') !== ""){
                                    $w = $w." AND DOB_Ergazom = "."'".filter_input(INPUT_POST,'dob')."'";
                                }
                                if(filter_input(INPUT_POST,'phone') !== ""){
                                    $w = $w." AND Tel_Ergaz LIKE  "."'%".filter_input(INPUT_POST,'phone')."%'";
                                }
                                if((filter_input(INPUT_POST,'gender') == 'M') || (filter_input(INPUT_POST,'gender') == 'F') ){
                                    $w = $w." AND Fyllo_Ergaz = "."'".filter_input(INPUT_POST,'gender')."'";
                                }
                                if(filter_input(INPUT_POST,'cloup_id') !== ""){
                                    $w = $w." AND kwd_ergazomenou = "."'".filter_input(INPUT_POST,'cloup_id')."'";
                                }
                                if(filter_input(INPUT_POST,'salary') !== ""){
                                    $w = $w." AND Salary_Ergazom LIKE  "."'%".filter_input(INPUT_POST,'salary')."%'";
                                }
                                if(filter_input(INPUT_POST,'amka') !== ""){
                                    $w = $w." AND AFM_Ergaz = "."'".filter_input(INPUT_POST,'amka')."'";
                                }
                                if((filter_input(INPUT_POST,'rights') !== "") && (filter_input(INPUT_POST,'rights') !== "NULL")){
                                    $w = $w." AND user_type_ergazom = "."'".filter_input(INPUT_POST,'rights')."'";
                                }
                                if((filter_input(INPUT_POST,'department') !== "") && (filter_input(INPUT_POST,'department') !== "NULL")){
                                    $w = $w." AND Kod_tm_ergazom = "."'".filter_input(INPUT_POST,'department')."'";
                                }
                                
                            }if(filter_input(INPUT_POST, 'Search_User')){?>
                                
                                <h2>ΣΤΟΙΧΕΙΑ ΠΡΟΣΩΠΟΥ/ΩΝ</h2>
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
                                            <th>Department</th>
                                            <th>User Type</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                
                                            $DB = new Database();
                                            $resulted_employee = $DB->targetSearchEmployee($sql.$w);   
                                            foreach($resulted_employee as $ergazomenos){
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
                                            <td><?php echo $DB->getMyDpt($ergazomenos['kwd_ergazomenou'])?></td>
                                            <td><?php echo $DB->getMyUtype($ergazomenos['user_type_ergazom'])?></td>
                                            <td>
                                                <form method="post" action="Target_edit_pages/edit_employee.php">
                                                    <input style="display:none; width: 0px; height: 0px;" type="text" id="target_id" name="target_id" value="<?php echo $ergazomenos['kwd_ergazomenou']?>"></input>
                                                    <button type="submit" style="background-color: blue; width: 120px;" name="Edit_User" id="Edit_User" value="Edit">Edit</button>
                                                </form>
                                                -
                                                <form method="post" action="Target_edit_pages/del_employee.php" target="_self">
                                                    <input style="display:none; width: 0px; height: 0px;" type="text" id="target_id" name="target_id" value="<?php echo $ergazomenos['kwd_ergazomenou']?>"></input>
                                                    <button type="submit" style="background-color: red; width: 120px;" name="Delete_User" id="Delete_User" value="Delete">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                        <?php }?>
                                        </tbody>
                                    </table>
                                </div>
                            
                            <?php } ?>        
                        </div>
<!-- ===============================================       DEPARTMENT SEARCH TAB     ========================================================== -->                        
                        <div class="tab__content">
                        
                        <h1>Department Search</h1>
                        <hr style="height:1px;border:none;color:#333;background-color:#333;">
                        <?php if (!(filter_input(INPUT_POST, 'Search_Department'))) {?>
                        <form action="" method="post">                                  <!-- ADD EMPLOYEE FORM STARTS HERE -->
                            <h1 style="text-align: center;">Target Search Department :</h1>
                            <div class="contentform">

                                <div class="leftcontact">                               <!-- Left side elements of the form -->

                                    <div class="form-group">
                                        <p>Department ID <span>*</span></p>
                                        <span class="icon-case"></span>
                                        <input type="text" id="dpt_id" name="dpt_id">
                                        <div class="validation">
                                        </div>
                                    </div>

                                </div>

                                <div class="rightcontact">                              <!-- Right side elements of the form -->
                                    
                                    <div class="form-group">
                                        <p>Department Name <span>*</span></p>
                                        <span class="icon-case"></span>
                                        <input type="text" id="dpt_name" name="dpt_name">
                                        <div class="validation">
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <button type="submit" name="Search_Department" id="Search_Department" value="Search" class="bouton-contact">Search</button>
                        </form>
                        <?php }
                            else{
                                $sql = "SELECT kwd_tmhmatos, onoma_tmhmatos, kwd_proistamenou FROM tmhma ";
                                $w = "WHERE 1";
                                
                                if(filter_input(INPUT_POST,'dpt_id') !== ""){
                                    $w = $w." AND kwd_tmhmatos = "."'".filter_input(INPUT_POST,'dpt_id')."'";
                                }
                                if(filter_input(INPUT_POST,'dpt_name') !== ""){
                                    $w = $w." AND onoma_tmhmatos LIKE  "."'%".filter_input(INPUT_POST,'dpt_name')."%'";
                                }
                                
                            }if(filter_input(INPUT_POST, 'Search_Department')){?>
                                
                                <h2>ΣΤΟΙΧΕΙΑ ΤΜΗΜΑΤΟΣ/ΩΝ</h2>
                                <div class="table-wrapper">
                                    <table class="fl-table">  
                                        <thead>
                                        <tr>
                                            <th>Department ID</th>
                                            <th>Department Name</th>
                                            <th>Supervisor</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                
                                            $DB = new Database();
                                            $resulted_department = $DB->targetSearchDepartment($sql.$w);   
                                            foreach($resulted_department as $department){
                                        ?>
                                        <tr>                         <!-- Gemisma pinaka me ta dedomena tou xrhsth apo to session -->
                                            <td><?php echo $department['kwd_tmhmatos']?></td>
                                            <td><?php echo $department['onoma_tmhmatos']?></td>
                                            <td><?php echo $DB->findSupervisor($department['kwd_proistamenou'])?></td>
                                            <td>
                                                <form method="post" action="Target_edit_pages/edit_department.php">
                                                    <input style="display:none; width: 0px; height: 0px;" type="text" id="target_dpt_id" name="target_dpt_id" value="<?php echo $department['kwd_tmhmatos']?>"></input>
                                                    <button type="submit" style="background-color: blue; width: 120px;" name="Edit_Department" id="Edit_Department" value="Edit">Edit</button>
                                                </form>
                                                <br>
                                                <form method="post" action="Target_edit_pages/del_department.php" target="_self">
                                                    <input style="display:none; width: 0px; height: 0px;" type="text" id="target_dpt_id" name="target_dpt_id" value="<?php echo $department['kwd_tmhmatos']?>"></input>
                                                    <button type="submit" style="background-color: red; width: 120px;" name="Delete_Department" id="Delete_Department" value="Delete">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                        <?php }?>
                                        </tbody>
                                    </table>
                                </div>
                               
                            <?php } ?>
                        </div>
<!-- ===============================================       PROJECT SEARCH TAB     ========================================================== -->                        
                        <div class="tab__content">
                        
                        <h1>Project Search</h1>
                        <hr style="height:1px;border:none;color:#333;background-color:#333;">
                        <?php if (!(filter_input(INPUT_POST, 'Search_Project'))) {?>
                        <form action="" method="post">                                  <!-- ADD EMPLOYEE FORM STARTS HERE -->
                            <h1 style="text-align: center;">Target Search Project :</h1>
                            <div class="contentform">

                                <div class="leftcontact">                               <!-- Left side elements of the form -->

                                    <div class="form-group">
                                        <p>Project ID <span>*</span></p>
                                        <span class="icon-case"></span>
                                        <input type="text" id="proj_id" name="proj_id">
                                        <div class="validation">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <p>Start Date <span>*</span></p>
                                        <span class="icon-case"></span>
                                        <input type="date" id="s_date" name="s_date">
                                        <div class="validation">
                                        </div>
                                    </div>

                                </div>

                                <div class="rightcontact">                              <!-- Right side elements of the form -->
                                    
                                    <div class="form-group">
                                        <p>Project Name <span>*</span></p>
                                        <span class="icon-case"></span>
                                        <input type="text" id="proj_name" name="proj_name">
                                        <div class="validation">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <p>Finish Date <span>*</span></p>
                                        <span class="icon-case"></span>
                                        <input type="date" id="f_date" name="f_date">
                                        <div class="validation">
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <button type="submit" name="Search_Project" id="Search_Project" value="Search" class="bouton-contact">Search</button>
                        </form>
                        <?php }
                            else{
                                $sql = "SELECT kwd_ergou, perigrafh_ergou, finish_date, start_date FROM ergo ";
                                $w = "WHERE 1";
                                
                                if(filter_input(INPUT_POST,'proj_id') !== ""){
                                    $w = $w." AND kwd_ergou = "."'".filter_input(INPUT_POST,'proj_id')."'";
                                }
                                if(filter_input(INPUT_POST,'proj_name') !== ""){
                                    $w = $w." AND perigrafh_ergou LIKE "."'%".filter_input(INPUT_POST,'proj_name')."%'";
                                }
                                if(filter_input(INPUT_POST,'s_date') !== ""){
                                    $w = $w." AND start_date = "."'".filter_input(INPUT_POST,'s_date')."'";
                                }
                                if(filter_input(INPUT_POST,'f_date') !== ""){
                                    $w = $w." AND finish_date = "."'".filter_input(INPUT_POST,'f_date')."'";
                                }
                                
                            }if(filter_input(INPUT_POST, 'Search_Project')){?>
                                
                                <h2>ΣΤΟΙΧΕΙΑ ΤΜΗΜΑΤΟΣ/ΩΝ</h2>
                                <div class="table-wrapper">
                                    <table class="fl-table">  
                                        <thead>
                                        <tr>
                                            <th>Project ID</th>
                                            <th>Project Name</th>
                                            <th>Start Date</th>
                                            <th>Finish Date</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                
                                            $DB = new Database();
                                            $resulted_project = $DB->targetSearchProject($sql.$w);   
                                            foreach($resulted_project as $project){
                                        ?>
                                        <tr>                         <!-- Gemisma pinaka me ta dedomena tou xrhsth apo to session -->
                                            <td><?php echo $project['kwd_ergou']?></td>
                                            <td><?php echo $project['perigrafh_ergou']?></td>
                                            <td><?php echo $project['start_date']?></td>
                                            <td><?php echo $project['finish_date']?></td>
                                            <td>
                                                <form method="post" action="Target_edit_pages/edit_project.php">
                                                    <input style="display:none; width: 0px; height: 0px;" type="text" id="target_proj_id" name="target_proj_id" value="<?php echo $project['kwd_ergou']?>"></input>
                                                    <button type="submit" style="background-color: blue; width: 120px;" name="Edit_Ergo" id="Edit_Ergo" value="Edit">Edit</button>
                                                </form>
                                                <br>
                                                <form method="post" action="Target_edit_pages/del_project.php" target="_self">
                                                    <input style="display:none; width: 0px; height: 0px;" type="text" id="target_proj_id" name="target_proj_id" value="<?php echo $project['kwd_ergou']?>"></input>
                                                    <button type="submit" style="background-color: red; width: 120px;" name="Delete_Ergo" id="Delete_Ergo" value="Delete">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                        <?php }?>
                                        </tbody>
                                    </table>
                                </div>
                               
                            <?php } ?>
                        </div>
<!-- ===============================================       VEHICLE SEARCH TAB     ========================================================== -->
                        <div class="tab__content">

                        <h1>Vehicle Search</h1>
                        <hr style="height:1px;border:none;color:#333;background-color:#333;">
                        <?php if (!(filter_input(INPUT_POST, 'Search_Vehicle'))) {?>
                        <form action="" method="post">                                  <!-- ADD EMPLOYEE FORM STARTS HERE -->
                            <h1 style="text-align: center;">Target Search Vehicle :</h1>
                            <div class="contentform">

                                <div class="leftcontact">                               <!-- Left side elements of the form -->

                                    <div class="form-group">
                                        <p>Licence Plate <span>*</span></p>
                                        <span class="icon-case"></span>
                                        <input type="text" id="lplate" name="lplate">
                                        <div class="validation">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <p>Color <span>*</span></p>
                                        <span class="icon-case"></span>
                                        <input type="text" id="color" name="color">
                                        <div class="validation">
                                        </div>
                                    </div>

                                </div>

                                <div class="rightcontact">                              <!-- Right side elements of the form -->
                                    
                                    <div class="form-group">
                                        <p>Model <span>*</span></p>
                                        <span class="icon-case"></span>
                                        <input type="text" id="model" name="model">
                                        <div class="validation">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <p>Brand <span>*</span></p>
                                        <span class="icon-case"></span>
                                        <input type="text" id="brand" name="brand">
                                        <div class="validation">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <p>Driver's Name <span>*</span></p>
                                        <select id="driver" name="driver" class="form-control">
                                            <option value="NULL"> - </option>
                                            <?php 
                                                $DB = new Database();
                                                $DB->loadAllEmployees();?>
                                        </select>    
                                        <div class="validation">
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <button type="submit" name="Search_Vehicle" id="Search_Vehicle" value="Search" class="bouton-contact">Search</button>
                        </form>
                        <?php }
                            else{
                                $sql = "SELECT ar_kykloforias, xroma_oxhm, montelo_oxhm, marka_oxhm, odhgos FROM oxhma ";
                                $w = "WHERE 1";
                                
                                if(filter_input(INPUT_POST,'lplate') !== ""){
                                    $w = $w." AND ar_kykloforias LIKE "."'%".filter_input(INPUT_POST,'lplate')."%'";
                                }
                                if(filter_input(INPUT_POST,'color') !== ""){
                                    $w = $w." AND xroma_oxhm LIKE "."'%".filter_input(INPUT_POST,'color')."%'";
                                }
                                if(filter_input(INPUT_POST,'model') !== ""){
                                    $w = $w." AND montelo_oxhm LIKE "."'%".filter_input(INPUT_POST,'model')."%'";
                                }
                                if(filter_input(INPUT_POST,'brand') !== ""){
                                    $w = $w." AND marka_oxhm LIKE "."'%".filter_input(INPUT_POST,'brand')."%'";
                                }
                                if(filter_input(INPUT_POST,'driver') !== "" && filter_input(INPUT_POST,'driver') !== "NULL"){
                                    $w = $w." AND odhgos = "."'".filter_input(INPUT_POST,'driver')."'";
                                }
                                
                            }if(filter_input(INPUT_POST, 'Search_Vehicle')){?>
                                
                                <h2>ΣΤΟΙΧΕΙΑ ΟΧΗΜΑΤΟΣ/ΩΝ</h2>
                                <div class="table-wrapper">
                                    <table class="fl-table">  
                                        <thead>
                                        <tr>
                                            <th>Licence Plate</th>
                                            <th>Brand</th>
                                            <th>Model</th>
                                            <th>Color</th>
                                            <th>Driver</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                
                                            $DB = new Database();
                                            $resulted_car = $DB->targetSearchCar($sql.$w);   
                                            foreach($resulted_car as $car){
                                        ?>
                                        <tr>                         <!-- Gemisma pinaka me ta dedomena tou xrhsth apo to session -->
                                            <td><?php echo $car['ar_kykloforias']?></td>
                                            <td><?php echo $car['xroma_oxhm']?></td>
                                            <td><?php echo $car['montelo_oxhm']?></td>
                                            <td><?php echo $car['marka_oxhm']?></td>
                                            <td><?php echo $DB->getDrivers($car['odhgos'])?></td>
                                            <td>
                                                <form method="post" action="Target_edit_pages/edit_car.php">
                                                    <input style="display:none; width: 0px; height: 0px;" type="text" id="target_car_id" name="target_car_id" value="<?php echo $car['ar_kykloforias']?>"></input>
                                                    <button type="submit" style="background-color: blue; width: 120px;" name="Edit_Car" id="Edit_Car" value="Edit">Edit</button>
                                                </form>
                                                <br>
                                                <form method="post" action="Target_edit_pages/del_car.php" target="_self">
                                                    <input style="display:none; width: 0px; height: 0px;" type="text" id="target_car_id" name="target_car_id" value="<?php echo $car['ar_kykloforias']?>"></input>
                                                    <button type="submit" style="background-color: red; width: 120px;" name="Delete_Car" id="Delete_Car" value="Delete">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                        <?php }?>
                                        </tbody>
                                    </table>
                                </div>
                               
                            <?php } ?>
                                
                        </div>
<!-- ===============================================       EDUCATION SEARCH TAB     ========================================================== -->
                        <div class="tab__content">
                            
                            
                            <h1>Education Search</h1>
                            <hr style="height:1px;border:none;color:#333;background-color:#333;">
                            <?php if (!(filter_input(INPUT_POST, 'Search_Education'))) {?>
                            <form action="" method="post">                                  <!-- ADD EMPLOYEE FORM STARTS HERE -->
                                <h1 style="text-align: center;">Target Search Diploma :</h1>
                                <div class="contentform">

                                    <div class="leftcontact">                               <!-- Left side elements of the form -->

                                        <div class="form-group">
                                            <p>Diploma ID <span>*</span></p>
                                            <span class="icon-case"></span>
                                            <input type="text" id="dipid" name="dipid">
                                            <div class="validation">
                                            </div>
                                        </div>
                                        
                                    </div>
                                    
                                    <div class="rightcontact">                              <!-- Right side elements of the form -->

                                        <div class="form-group">
                                            <p>Diploma Name <span>*</span></p>
                                            <span class="icon-case"></span>
                                            <input type="text" id="dipname" name="dipname">
                                            <div class="validation">
                                            </div>
                                        </div>

                                    </div>
                                    
                                </div>
                                <button type="submit" name="Search_Education" id="Search_Education" value="Search" class="bouton-contact">Search</button>
                            </form>
                            <?php }
                                else{
                                    $sql = "SELECT kwd_ptyxio , per_ptyxiou FROM ekpaideysh ";
                                    $w = "WHERE 1";

                                    if(filter_input(INPUT_POST,'dipid') !== ""){
                                        $w = $w." AND kwd_ptyxio = "."'".filter_input(INPUT_POST,'dipid')."'";
                                    }
                                    if(filter_input(INPUT_POST,'dipname') !== ""){
                                        $w = $w." AND per_ptyxiou LIKE "."'%".filter_input(INPUT_POST,'dipname')."%'";
                                    }

                                }if(filter_input(INPUT_POST, 'Search_Education')){?>

                                    <h2>ΣΤΟΙΧΕΙΑ ΟΧΗΜΑΤΟΣ/ΩΝ</h2>
                                    <div class="table-wrapper">
                                        <table class="fl-table">  
                                            <thead>
                                            <tr>
                                                <th>Diploma ID</th>
                                                <th>Diploma Name</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php

                                                $DB = new Database();
                                                $resulted_diploma = $DB->targetSearchDiploma($sql.$w);   
                                                foreach($resulted_diploma as $diploma){
                                            ?>
                                            <tr>                         <!-- Gemisma pinaka me ta dedomena tou xrhsth apo to session -->
                                                <td><?php echo $diploma['kwd_ptyxio']?></td>
                                                <td><?php echo $diploma['per_ptyxiou']?></td>
                                                <td>
                                                    <form method="post" action="Target_edit_pages/edit_diploma.php">
                                                        <input style="display:none; width: 0px; height: 0px;" type="text" id="target_dip_id" name="target_dip_id" value="<?php echo $diploma['kwd_ptyxio']?>"></input>
                                                        <button type="submit" style="background-color: blue; width: 120px;" name="Edit_Diploma" id="Edit_Diploma" value="Edit">Edit</button>
                                                    </form>
                                                    <br>
                                                    <form method="post" action="Target_edit_pages/del_diploma.php" target="_self">
                                                        <input style="display:none; width: 0px; height: 0px;" type="text" id="target_dip_id" name="target_dip_id" value="<?php echo $diploma['kwd_ptyxio']?>"></input>
                                                        <button type="submit" style="background-color: red; width: 120px;" name="Delete_Diploma" id="Delete_Diploma" value="Delete">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            <?php }?>
                                            </tbody>
                                        </table>
                                    </div>

                                <?php } ?>
                            

                        </div>
<!-- ===============================================       DEPENDANT SEARCH TAB     ========================================================== -->
                        <div class="tab__content">

                            <h1>Dependant Search</h1>
                            <hr style="height:1px;border:none;color:#333;background-color:#333;">
                            <?php if (!(filter_input(INPUT_POST, 'Search_Dependant'))) {?>
                            <form action="" method="post">                                  <!-- ADD EMPLOYEE FORM STARTS HERE -->
                                <h1 style="text-align: center;">Target Search Dependant :</h1>
                                <div class="contentform">

                                    <div class="leftcontact">                               <!-- Left side elements of the form -->

                                        <div class="form-group">
                                            <p>Dependant Soc Sec Num <span>*</span></p>
                                            <span class="icon-case"></span>
                                            <input type="text" id="d_id" name="d_id">
                                            <div class="validation">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <p>Dependant DoB <span>*</span></p>
                                            <span class="icon-case"></span>
                                            <input type="date" id="ddob" name="ddob">
                                            <div class="validation">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                        <p>Gender <span>*</span></p>
                                        <label for="male">Male</label>
                                        <input type="radio" id="male" name="gender" value="M">
                                        <label for="female">Female</label>
                                        <input type="radio" id="female" name="gender" value="F">
                                        <div class="validation">
                                        </div>
                                    </div>
                                        
                                    </div>

                                    <div class="rightcontact">                              <!-- Right side elements of the form -->

                                        <div class="form-group">
                                            <p>Dependant Firstname <span>*</span></p>
                                            <span class="icon-case"></span>
                                            <input type="text" id="dfname" name="dfname">
                                            <div class="validation">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <p>Dependant Lastname <span>*</span></p>
                                            <span class="icon-case"></span>
                                            <input type="text" id="dlname" name="dlname">
                                            <div class="validation">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                        <p>Insurer's Name <span>*</span></p>
                                        <select id="iname" name="iname" class="form-control">
                                            <option value="NULL"> - </option>
                                            <?php 
                                                $DB = new Database();
                                                $DB->loadAllEmployees();?>
                                        </select>    
                                        <div class="validation">
                                        </div>
                                    </div>

                                    </div>
                                </div>
                                <button type="submit" name="Search_Dependant" id="Search_Dependant" value="Search" class="bouton-contact">Search</button>
                            </form>
                            <?php }
                                else{
                                    $sql = "SELECT AMKA_eksart, Onoma_eksart, Eponymo_eksart, DOB_eksart, Fylo_eksart, kod_prostati FROM eksartomenos ";
                                    $w = "WHERE 1";

                                    if(filter_input(INPUT_POST,'d_id') !== ""){
                                        $w = $w." AND AMKA_eksart LIKE  "."'%".filter_input(INPUT_POST,'d_id')."%'";
                                    }
                                    if(filter_input(INPUT_POST,'dfname') !== ""){
                                        $w = $w." AND Onoma_eksart LIKE  "."'%".filter_input(INPUT_POST,'dfname')."%'";
                                    }
                                    if(filter_input(INPUT_POST,'dlname') !== ""){
                                        $w = $w." AND Eponymo_eksart LIKE  "."'%".filter_input(INPUT_POST,'dlname')."%'";
                                    }
                                    if(filter_input(INPUT_POST,'ddob') !== "" && filter_input(INPUT_POST,'ddob') !== "NULL"){
                                        $w = $w." AND DOB_eksart = "."'".filter_input(INPUT_POST,'ddob')."'";
                                    }
                                    if(filter_input(INPUT_POST,'gender') == "M" || filter_input(INPUT_POST,'gender') == "F"){
                                        $w = $w." AND Fylo_eksart = "."'".filter_input(INPUT_POST,'gender')."'";
                                    }
                                    if(filter_input(INPUT_POST,'iname') !== "" && filter_input(INPUT_POST,'iname') !== "NULL"){
                                        $w = $w." AND kod_prostati = "."'".filter_input(INPUT_POST,'iname')."'";
                                    }

                                }if(filter_input(INPUT_POST, 'Search_Dependant')){?>

                                    <h2>ΣΤΟΙΧΕΙΑ ΕΞΑΡΤΩΜΕΝΟΥ/ΩΝ</h2>
                                    <div class="table-wrapper">
                                        <table class="fl-table">  
                                            <thead>
                                            <tr>
                                                <th>Dependant Soc Sec Num</th>
                                                <th>Firstname</th>
                                                <th>Lastname</th>
                                                <th>DoB</th>
                                                <th>Gender</th>
                                                <th>Relation</th>
                                                <th>Insurer</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php

                                                $DB = new Database();
                                                $resulted_dependant = $DB->targetSearchDependant($sql.$w);   
                                                foreach($resulted_dependant as $dependant){
                                            ?>
                                            <tr>                         <!-- Gemisma pinaka me ta dedomena tou xrhsth apo to session -->
                                                <td><?php echo $dependant['AMKA_eksart']?></td>
                                                <td><?php echo $dependant['Onoma_eksart']?></td>
                                                <td><?php echo $dependant['Eponymo_eksart']?></td>
                                                <td><?php echo $dependant['DOB_eksart']?></td>
                                                <td><?php echo $dependant['Fylo_eksart']?></td>
                                                <td><?php echo $DB->child_spouce($dependant['AMKA_eksart'])?></td>
                                                <td><?php echo $DB->target_dep_insurer($dependant['kod_prostati'])?></td>
                                                <td>
                                                    <form method="post" action="Target_edit_pages/edit_dependant.php">
                                                        <input style="display:none; width: 0px; height: 0px;" type="text" id="target_d_id" name="target_d_id" value="<?php echo $dependant['AMKA_eksart']?>"></input>
                                                        <button type="submit" style="background-color: blue; width: 120px;" name="Edit_Dependant" id="Edit_Dependant" value="Edit">Edit</button>
                                                    </form>
                                                    <br>
                                                    <form method="post" action="Target_edit_pages/del_dependant.php" target="_self">
                                                        <input style="display:none; width: 0px; height: 0px;" type="text" id="target_d_id" name="target_d_id" value="<?php echo $dependant['AMKA_eksart']?>"></input>
                                                        <button type="submit" style="background-color: red; width: 120px;" name="Delete_Dependant" id="Delete_Dependant" value="Delete">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            <?php }?>
                                            </tbody>
                                        </table>
                                    </div>

                                <?php } ?>
                        </div>
        
        </div>
        
        <div class="button_cont center-text" align="center">
            <a class="example_a" href="asset_management.php">Back to Assets</a>
        </div>
        <hr>
        <div class="text-left-right">
        <a class="example_a left-text" href="logged_in_page.php">Back to Profile</a>
        <a class="example_a right-text" href="logout.php">LOGOUT</a>
        </div>
        
    </div>
</body>
</html>

