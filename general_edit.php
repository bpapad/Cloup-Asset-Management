<?php
    session_start();
    require_once "Classes/Database.php";
    require_once "Classes/Ergazomenos.php";
    require_once "Classes/Credentials.php";
    require_once "Classes/Tmhma.php";
    require_once "Classes/Ergo.php";
    require_once "Classes/Tmhmata_se_erga.php";
    require_once "Classes/Ergazomenoi_se_erga.php";
    require_once "Classes/Oxhma.php";
    require_once "Classes/Ekpaideysh.php";
    require_once "Classes/Address_ergazomenou.php";
    require_once "Classes/Eksartomenos.php";
    require_once "Classes/Epimorfosi.php";?>

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
    <div class="main_container">
        <div>
            <h3 class="text-left-right">
                <span class="left-text">
                <?php 
                    echo $_SESSION['Onoma_Ergazom']." ".$_SESSION['Eponymo_ergazom'];?>
                </span>
                <span class="right-text">
                <?php                                  
                    echo 'Admin';?>
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
            
<!-- ====================================    ERGAZOMENOS   ======================================================== -->           
            <div class="tab__content">
                
                <h1>Manage Employees</h1>
                <?php if (!(filter_input(INPUT_POST, 'AddUser'))) {?>
                <form action="" method="post">                                  <!-- ADD EMPLOYEE FORM STARTS HERE -->
                    <h1 style="text-align: center;">Add Employee :</h1>
                    <div class="contentform">
                        
                        <div class="leftcontact">                               <!-- Left side elements of the form -->
                            
                            <div class="form-group">
                                <p>Firstname <span>*</span></p>
                                <span class="icon-case"></span>
                                <input type="text" id="firstname" name="firstname" required>
                                <div class="validation">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <p>Lastname <span>*</span></p>
                                <span class="icon-case"></span>
                                <input type="text" id="lastname" name="lastname" required>
                                <div class="validation">
                                </div>
                            </div> 

                            <div class="form-group">
                                <p>Father's <span>*</span></p>    
                                <span class="icon-case"></span>
                                <input type="text" id="father" name="father" required>
                                <div class="validation">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <p>Date of Birth <span>*</span></p>
                                <span class="icon-case"><i class="fa fa-location-arrow"></i></span>
                                <input type="date" id="dob" name="dob" required>
                                <div class="validation">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <p>Phone <span>*</span></p>
                                <span class="icon-case"></span>
                                <input type="text" id="phone" name="phone" required>
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
                                <p>Social Sec Num <span>*</span></p>
                                <span class="icon-case"></span>
                                <input type="text" id="amka" name="amka" maxlength="10" required>
                                <div class="validation">
                                </div>
                            </div>

                            <div class="form-group">
                                <p>Salary <span>*</span></p>
                                <span class="icon-case"></span>
                                <input type="text" id="salary" name="salary" required>
                                <div class="validation">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <p>Username <span>*</span></p>
                                <span class="icon-case"></span>
                                <input type="text" id="username" name="username" required>
                                <div class="validation">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <p>Password <span>*</span></p>
                                <span class="icon-case"></span>
                                <input type="password" id="password" name="password" required>
                                <div class="validation">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <p>Rights <span>*</span></p>
                                <select id="rights" name="rights" class="form-control">
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
                    <button type="submit" name="AddUser" id="AddUser" value="Add" class="bouton-contact">Send</button>
                    
                <?php }
                    else{
                        //Saving Post variables inside the session to be used later in filling the credentials DB table
                        $_SESSION['temp_username'] = filter_input(INPUT_POST, 'username');
                        $_SESSION['temp_password'] = filter_input(INPUT_POST, 'password');
                        $_SESSION['temp_afm'] = filter_input(INPUT_POST, 'amka');
                        
                        $newEmployee = new Ergazomenos();
                        //Passing Post variables in the respectable class variables and via $newEmployee->setDb(); a new Employee gets added in the DB->ergazomenoi
                        $newEmployee->AFM_Ergaz = $_SESSION['temp_afm'];
                        $newEmployee->DOB_Ergazom = filter_input(INPUT_POST, 'dob');
                        $newEmployee->Eponymo_ergazom = filter_input(INPUT_POST, 'lastname');
                        $newEmployee->Fyllo_Ergaz = filter_input(INPUT_POST, 'gender');
                        $newEmployee->Onoma_Ergazom = filter_input(INPUT_POST, 'firstname');
                        $newEmployee->Patronymo_Ergazom  = filter_input(INPUT_POST, 'father');
                        $newEmployee->Salary_Ergazom = filter_input(INPUT_POST, 'salary');
                        $newEmployee->Tel_Ergaz = filter_input(INPUT_POST, 'phone');
                        $newEmployee->user_type_ergazom = filter_input(INPUT_POST, 'rights');
                        $newEmployee->Kod_tm_ergazom = filter_input(INPUT_POST, 'department');
                        
                        $newEmployee->setDb();
                        
                        
                        
                    }
                    if(filter_input(INPUT_POST, 'AddUser')){
                        //Passing the session values into the credentials table AFTER the employee table gets filled first so that i bypass the issue with the keys linking the 2 tables
                        $DB = new Database();
                        $newCredentials = new Credentials();
                        
                        
                        $newCredentials->username = $_SESSION['temp_username'];
                        $newCredentials->password = $_SESSION['temp_password'];
                        $newCredentials->kwd_ergazom_cred = $DB->getID($_SESSION['temp_afm']); //fetching the employees afm table data already parsed from the session and fetching the needed key (id)
                        
                        $newCredentials->setDb();
                        
                        unset($_POST["AddUser"]);
                        unset($_SESSION['temp_username']);                      //temp_username, temp_password, temp_afm after using them to pass data in the second table needed,
                        unset($_SESSION['temp_password']);                      //they get deleted so that they can be used again in the same session. Page reloads right after this
                        unset($_SESSION['temp_afm']);?>
                        <script>alert('Employee Added!');</script>
                        <script> location.replace("general_edit.php"); </script>  <!-- doing it this way so that the form stays visible (right after pressing the button the data get hendled and the form disappears) -->
                    <?php }?>

                </form>                                                         <!-- ADD EMPLOYEE FORM ENDS HERE -->
                
                <hr style="height:1px;border:none;color:#333;background-color:#333;">
                
                <?php if (!(filter_input(INPUT_POST, 'DelUser'))) {?>
                
                <form action="" method="post">                                  <!-- DELETE EMPLOYEE FORM STARTS HERE -->
                    <h1 style="text-align: center;">Delete Employee :</h1>
                    <div class="contentform">
                        
                        <div class="leftcontact">
                            
                            <div class="form-group">
                                <p>Name <span>*</span></p>
                                <select id="name" name="name" class="form-control" required>
                                    <option value="NULL"> - </option>
                                    <?php 
                                        $DB = new Database();
                                        $DB->loadAllEmployees();?>
                                </select>    
                                <div class="validation">
                                </div>
                            </div>
                            
                        </div>
                        
                        <div class="rightcontact">
                            
                            <div class="form-group">
                                <p>Authorize <span>*</span></p>
                                <label class="float-left">Confirm : </label>
                                <input class="delbox" type="checkbox" id="erase" name="erase" value="E" required>
                                <div class="validation">
                                </div>
                            </div>
                            
                        </div>
                        
                    </div>
                    <button type="submit" name="DelUser" id="DelUser" value="Del" class="bouton-contact">Delete</button>
                <?php }
                    else{
                        $DB->delUser(filter_input(INPUT_POST, 'name'));   
                    }
                    if(filter_input(INPUT_POST, 'DelUser')){                    //deleting the "pressed" delete button and reloading tha page right after deleting the chosen employee
                        unset($_POST["DelUser"]);?>                             <!-- doing it this way so that the form stays visible (right after pressing the button the data get hendled and the form disappears) -->
                        <script>alert('Employee Deleted!');</script>
                        <script> location.replace("general_edit.php"); </script>
                    <?php }?>
                </form>                                                         <!-- DELETE EMPLOYEE FORM ENDS HERE -->
                
            </div>                                                              <!-- EMPLOYEE TAB ENDS HERE -->
            
<!-- ====================================    TMHMA   ======================================================== -->            
            <div class="tab__content">                                          <!-- DEPARTMENT TAB STARTS HERE -->
                
                <h1>Manage Departments</h1>
                <?php if (!(filter_input(INPUT_POST, 'AddDepartment'))) {?>
                
                <form action="" method="post">                                  <!-- ADD DEPARTMENT FORM STARTS HERE -->
                    <h1 style="text-align: center;">Add New Department :</h1>
                    <div class="contentform">
                        
                        <div class="leftcontact">
                            
                            <div class="form-group">
                                <p>Dpt Name <span>*</span></p>
                                <span class="icon-case"></span>
                                <input type="text" id="dptname" name="dptname" required>
                                <div class="validation">
                                </div>
                            </div>
                            
                        </div>
                        
                        <div class="rightcontact">
                            
                            <div class="form-group">
                                <p>Set Supervisor <span>*</span></p>
                                <select id="supervisor" name="supervisor" class="form-control" required>
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
                    <button type="submit" name="AddDepartment" id="AddDepartment" value="Add" class="bouton-contact">Send</button>
                
                    <?php 
                    } else {
                        $newdpt = new Tmhma();
                        
                        $newdpt->onoma_tmhmatos = filter_input(INPUT_POST,'dptname');
                        $newdpt->kwd_proistamenou = filter_input(INPUT_POST,'supervisor');
                        
                        $newdpt->setDB();
                    }
                    if(filter_input(INPUT_POST, 'AddDepartment')){
                        unset($_POST['AddDepartment']);?>
                        <script>alert('Department Added!');</script>
                        <script> location.replace("general_edit.php"); </script>
                    <?php }?>
                </form>                                                         <!-- ADD DEPARTMENT FORM ENDS HERE -->                                             
                
                        
                <hr style="height:1px;border:none;color:#333;background-color:#333;">
                
                
            </div>                                                              <!-- DEPARTMENT TAB ENDS HERE -->
            
<!-- ====================================    ERGO   ======================================================== -->            
            <div class="tab__content">                                          <!-- PROJECT TAB STARTS HERE -->
                
                <h1>Manage Projects</h1>
                <?php if (!(filter_input(INPUT_POST, 'AddProject'))) {?>
                
                <form action="" method="post">                                  <!-- ADD PROJECT FORM STARTS HERE -->
                    <h1 style="text-align: center;">Add New Project :</h1>
                    <div class="contentform">
                        
                        <div class="leftcontact">
                            
                            <div class="form-group">
                                <p>Project Name <span>*</span></p>
                                <span class="icon-case"></span>
                                <input type="text" id="prjname" name="prjname" required>
                                <div class="validation">
                                </div>
                            </div>
                            
                        </div>
                        
                        <div class="rightcontact">
                            
                            <div class="form-group">
                                <p>Start Date <span>*</span></p>
                                <span class="icon-case"></span>
                                <input type="date" id="startdate" name="startdate" required>
                                <div class="validation">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <p>Finish Date <span>*</span></p>
                                <span class="icon-case"></span>
                                <input type="date" id="finishdate" name="finishdate">
                                <div class="validation">
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <button type="submit" name="AddProject" id="AddProject" value="Add" class="bouton-contact">Send</button>
                <?php } else{
                    $newproject = new Ergo();
                    
                    $newproject->perigrafh_ergou = filter_input(INPUT_POST,'prjname');
                    $newproject->start_date = filter_input(INPUT_POST,'startdate');
                    $newproject->finish_date = filter_input(INPUT_POST,'finishdate');
                    
                    $newproject->setDB();
                    
                }
                if(filter_input(INPUT_POST, 'AddProject')){
                    unset($_POST['AddProject']);?>
                    <script>alert('Project Added!');</script>
                    <script> location.replace("general_edit.php"); </script>
                <?php }?>
                    
                </form>                                                         <!-- ADD PROJECT FORM ENDS HERE -->
                
            <hr style="height:1px;border:none;color:#333;background-color:#333;">
            
                <?php if (!(filter_input(INPUT_POST, 'AssignDpt'))) {?>
                <form action="" method="post">                                  <!-- ASSIGN PROJECT TO DEPARTMENT FORM STARTS HERE -->
                    
                    <h1 style="text-align: center;">Assign Project to Department :</h1>
                    <div class="contentform">

                        <div class="leftcontact">

                            <div class="form-group">
                                <p>Select Departmetnt <span>*</span></p>
                                <select id="department" name="department" class="form-control" required>
                                    <option value="NULL"> - </option>
                                    <?php 
                                        $DB = new Database();
                                        $DB->loadAllDepartmentsV2()?>
                                </select>    
                                <div class="validation">
                                </div>
                            </div>

                        </div>

                        <div class="rightcontact">

                            <div class="form-group">
                                <p>Assign Project <span>*</span></p>
                                <select id="project" name="project" class="form-control" required>
                                    <option value="NULL"> - </option>
                                    <?php
                                        $DB->loadAllProjectNames_ID();?>
                                </select>    
                                <div class="validation">
                                </div>
                            </div>

                        </div>
                    </div>
                    <button type="submit" name="AssignDpt" id="AssignDpt" value="Assign" class="bouton-contact">Assign</button>
                <?php } else{
                    $dpt_on_prj = new Tmhmata_se_erga();
                    
                    $dpt_on_prj->kwd_tmhmatos_ergou = filter_input(INPUT_POST,'department');
                    $dpt_on_prj->kwd_ergou_tmhma = filter_input(INPUT_POST,'project');
                    
                    $dpt_on_prj->setDB();
                    
                }if(filter_input(INPUT_POST, 'AssignDpt')){
                    unset($_POST['AssignDpt']);?>
                    <script>alert('Project Assigned!');</script>
                    <script> location.replace("general_edit.php"); </script>
                <?php }?>
                        
                </form>                                                         <!-- ASSIGN PROJECT TO DEPARTMENT FORM ENDS HERE -->                                             


                <hr style="height:1px;border:none;color:#333;background-color:#333;">
                
                <?php if (!(filter_input(INPUT_POST, 'AssignEmp'))) {?>
                <form action="" method="post">                                  <!-- ASSIGN PROJECT TO EMPLOYEE FORM STARTS HERE -->
                    
                    <h1 style="text-align: center;">Assign Employee to Project :</h1>
                    <div class="contentform">

                        <div class="leftcontact">

                            <div class="form-group">
                                <p>Select Employee <span>*</span></p>
                                <select id="employee" name="employee" class="form-control" required>
                                    <option value="NULL"> - </option>
                                    <?php 
                                        $DB = new Database();
                                        $DB->loadAllEmployees()?>
                                </select>    
                                <div class="validation">
                                </div>
                            </div>

                        </div>

                        <div class="rightcontact">

                            <div class="form-group">
                                <p>Assign Project <span>*</span></p>
                                <select id="project" name="project" class="form-control" required>
                                    <option value="NULL"> - </option>
                                    <?php
                                        $DB->loadAllProjectNames_ID();?>
                                </select>    
                                <div class="validation">
                                </div>
                            </div>

                        </div>
                    </div>
                    <button type="submit" name="AssignEmp" id="AssignEmp" value="Assign" class="bouton-contact">Assign</button>
                <?php } else{
                    $emp_on_prj = new Ergazomenoi_se_erga();
                    
                    $emp_on_prj->kwd_ergazom_ergo = filter_input(INPUT_POST,'employee');
                    $emp_on_prj->kwd_ergou = filter_input(INPUT_POST,'project');
                    
                    $emp_on_prj->setDB();
                    
                }if(filter_input(INPUT_POST, 'AssignEmp')){
                    unset($_POST['AssignEmp']);?>
                    <script>alert('Project Assigned!');</script>
                    <script> location.replace("general_edit.php"); </script>
                <?php }?>
                        
                </form>                                                         <!-- ASSIGN PROJECT TO EMPLOYEE FORM ENDS HERE -->
            
                
            </div>                                                              <!-- PROJECT TAB ENDS HERE -->           
            
<!-- ====================================    OXHMA   ======================================================== -->            
            <div class="tab__content">                                          <!-- VEHICLE TAB STARTS HERE -->
                
                <h1>Manage Vehicles</h1>
                <?php if (!(filter_input(INPUT_POST, 'AddCar'))) {?>
                
                <form action="" method="post">                                  <!-- ADD VEHICLE FORM STARTS HERE -->
                    
                    
                    <h1 style="text-align: center;">Add New Car :</h1>
                    <div class="contentform">
                        
                        <div class="leftcontact">
                            
                            <div class="form-group">
                                <p>License Plate <span>*</span></p>
                                <span class="icon-case"></span>
                                <input type="text" id="plate" name="plate" required>
                                <div class="validation">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <p>Color <span>*</span></p>
                                <span class="icon-case"></span>
                                <input type="text" id="color" name="color" required>
                                <div class="validation">
                                </div>
                            </div>
                            
                        </div>
                        
                        <div class="rightcontact">
                            
                            <div class="form-group">
                                <p>Model <span>*</span></p>
                                <span class="icon-case"></span>
                                <input type="text" id="model" name="model" required>
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
                                <p>Select Driver <span>*</span></p>
                                <select id="driver" name="driver" class="form-control" required>
                                    <option value="NULL"> - </option>
                                    <?php 
                                        $DB = new Database();
                                        $DB->loadAllEmployees()?>
                                </select>    
                                <div class="validation">
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <button type="submit" name="AddCar" id="AddCar" value="Add" class="bouton-contact">Send</button>
                <?php }
                    else{
                        $newvehicle = new Oxhma();
                        
                        $newvehicle->ar_kykloforias = filter_input(INPUT_POST,'plate');
                        $newvehicle->marka_oxhm = filter_input(INPUT_POST,'brand');
                        $newvehicle->montelo_oxhm = filter_input(INPUT_POST,'model');
                        $newvehicle->xroma_oxhm = filter_input(INPUT_POST,'color');
                        $newvehicle->odhgos = filter_input(INPUT_POST,'driver');
                        
                        $newvehicle->setDB();
                    }if(filter_input(INPUT_POST, 'AddCar')){
                    unset($_POST['AddCar']);?>
                    <script>alert('Vehicle Added!');</script>
                    <script> location.replace("general_edit.php"); </script>
                <?php }?>
                
                </form>                                                         <!-- ADD VEHICLE FORM ENDS HERE -->
                
                
                <hr style="height:1px;border:none;color:#333;background-color:#333;">
                
                
                <form action="" method="post">                                  <!-- DELETE VEHICLE FORM STARTS HERE -->
                    
                    <?php if (!(filter_input(INPUT_POST, 'DelCar'))) {?>
                    <h1 style="text-align: center;">Delete Car :</h1>
                    <div class="contentform">
                        
                        <div class="leftcontact">
                            
                            <div class="form-group">
                                <p>License Plate <span>*</span></p>
                                <select id="plate" name="plate" class="form-control" required>
                                    <option value="NULL"> - </option>
                                    <?php 
                                        $DB = new Database();
                                        $DB->loadAllCars()?>
                                </select>    
                                <div class="validation">
                                </div>
                            </div>
                            
                        </div>
                        
                        <div class="rightcontact">
                            
                            <div class="form-group">
                                <p>Authorize <span>*</span></p>
                                <label class="float-left">Confirm : </label>
                                <input class="delbox" type="checkbox" id="erase" name="erase" value="E" required>
                                <div class="validation">
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <button type="submit" name="DelCar" id="DelCar" value="Del" class="bouton-contact">Delete</button>
                <?php }
                    else{
                        $DB->delCar(filter_input(INPUT_POST,'plate'));
                        
                    }if(filter_input(INPUT_POST, 'DelCar')){
                    unset($_POST['DelCar']);?>
                    <script>alert('Vehicle Deleted!');</script>
                    <script> location.replace("general_edit.php"); </script>
                <?php }?>
                
                </form>                                                         <!-- DELETE VEHICLE FORM ENDS HERE -->
                
            </div>                                                              <!-- VEHICLE TAB ENDS HERE -->
            
<!-- ====================================    EKPAIDEYSH   ======================================================== -->            
            <div class="tab__content">                                          <!-- EDUCATION TAB STARTS HERE -->
                
                <h1>Manage Education</h1>
                <?php if (!(filter_input(INPUT_POST, 'AddDip'))) {?>
                <form action="" method="post">                                  <!-- ADD DIPLOMA FORM STARTS HERE -->
                    
                    
                    <h1 style="text-align: center;">Add Diploma :</h1>
                    <div class="contentform">
                        
                        <div>
                            
                            <div class="form-group">
                                <p>Diploma Name <span>*</span></p>
                                <span class="icon-case"></span>
                                <input type="text" id="dipname" name="dipname" required>
                                <div class="validation">
                                </div>
                            </div>
                            
                        </div>
                        
                    </div>
                    <button type="submit" name="AddDip" id="AddDip" value="Add" class="bouton-contact">Add</button>
                <?php }
                    else{
                        $newDiploma = new Ekpaideysh();
                        
                        $newDiploma->per_ptyxiou = filter_input(INPUT_POST,'dipname');
                        
                        $newDiploma->setDB();
                        
                    }if(filter_input(INPUT_POST, 'AddDip')){
                    unset($_POST['AddDip']);?>
                    <script>alert('Diploma Added!');</script>
                    <script> location.replace("general_edit.php"); </script>
                    
                <?php }?>
                
                </form>                                                         <!-- ADD DIPLOMA FORM ENDS HERE -->
            
                <hr style="height:1px;border:none;color:#333;background-color:#333;">
                
                <?php if (!(filter_input(INPUT_POST, 'AssignD'))) {?>
                <form action="" method="post">                                  <!-- ASSIGN DIPLOMA FORM STARTS HERE -->
                    
                    
                    <h1 style="text-align: center;">Assign Diploma to Employee :</h1>
                    <div class="contentform">
                        
                        <div class="leftcontact">
                            
                            <div class="form-group">
                                <p>Diploma <span>*</span></p>
                                <select id="dipasg" name="dipasg" class="form-control" required>
                                    <option value="NULL"> - </option>
                                    <?php 
                                        $DB = new Database();
                                        $DB->loadAllDiplomas()?>
                                </select>    
                                <div class="validation">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <p>Date of Acquisition <span>*</span></p>
                                <span class="icon-case"></span>
                                <input type="date" id="dateacq" name="dateacq" required>
                                <div class="validation">
                                </div>
                            </div>
                            
                        </div>
                        
                        <div class="rightcontact">
                            
                            <div class="form-group">
                                <p>Employee <span>*</span></p>
                                <select id="student" name="student" class="form-control" required>
                                    <option value="NULL"> - </option>
                                    <?php 
                                        $DB = new Database();
                                        $DB->loadAllEmployees()?>
                                </select>    
                                <div class="validation">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <p>Grade <span>*</span></p>
                                <span class="icon-case"></span>
                                <input type="text" id="grade" name="grade" required>
                                <div class="validation">
                                </div>
                            </div>
                            
                        </div>
                        
                    </div>
                    <button type="submit" name="AssignD" id="AssignD" value="Add" class="bouton-contact">Assign</button>
                <?php }
                    else{
                        $newEpimorfosh = new Epimorfosi();
                        
                        $newEpimorfosh->eidikeysh = filter_input(INPUT_POST,'dipasg');
                        $newEpimorfosh->ekpaideyomenos = filter_input(INPUT_POST,'student');
                        $newEpimorfosh->vathmos = filter_input(INPUT_POST,'grade');
                        $newEpimorfosh->date_apokthshs = filter_input(INPUT_POST,'dateacq');
                        
                        $newEpimorfosh->setDB();
                        
                    }if(filter_input(INPUT_POST, 'AssignD')){
                    unset($_POST['AssignD']);?>
                    <script>alert('Diploma Added!');</script>
                    <script> location.replace("general_edit.php"); </script>
                    
                <?php }?>
                
                </form>                                                         <!-- ASSIGN DIPLOMA FORM ENDS HERE -->
                
            </div>                                                              <!-- EDUCATION TAB ENDS HERE --> 
<!-- ====================================    DIEYTHYNSH   ======================================================== -->            
            <div class="tab__content">                                          <!-- ADDRESS TAB STARTS HERE -->
                
                <h1>Manage Addresses</h1>
                <?php if (!(filter_input(INPUT_POST, 'AddAdr'))) {?>
                <form action="" method="post">                                  <!-- ADD DIPLOMA FORM STARTS HERE -->
                    
                    <h1 style="text-align: center;">Add Address :</h1>
                    <div class="contentform">
                        
                        <div class="leftcontact">
                            
                            <div class="form-group">
                                <p>Street <span>*</span></p>
                                <span class="icon-case"></span>
                                <input type="text" id="street" name="street" required>
                                <div class="validation">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <p>Number <span>*</span></p>
                                <span class="icon-case"></span>
                                <input type="text" id="num" name="num" required>
                                <div class="validation">
                                </div>
                            </div>
                            
                        </div>
                        
                        <div class="rightcontact">
                            
                            <div class="form-group">
                                <p>City <span>*</span></p>
                                <span class="icon-case"></span>
                                <input type="text" id="city" name="city" required>
                                <div class="validation">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <p>Zip Code <span>*</span></p>
                                <span class="icon-case"></span>
                                <input type="text" id="zip" name="zip" required>
                                <div class="validation">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <p>Resident <span>*</span></p>
                                <select id="resident" name="resident" class="form-control" required>
                                    <option value="NULL"> - </option>
                                    <?php 
                                        $DB = new Database();
                                        $DB->loadAllEmployees()?>
                                </select>    
                                <div class="validation">
                                </div>
                            </div>
                            
                        </div>
                        
                    </div>
                    <button type="submit" name="AddAdr" id="AddAdr" value="Add" class="bouton-contact">Add</button>
                <?php }
                    else{
                        $newAddress = new Address_ergazomenou();
                        
                        $newAddress->odos = filter_input(INPUT_POST,'street');
                        $newAddress->arithmos = filter_input(INPUT_POST,'num');
                        $newAddress->polh = filter_input(INPUT_POST,'city');
                        $newAddress->zip_code = filter_input(INPUT_POST,'zip');
                        $newAddress->kwd_ergazomenou_adr = filter_input(INPUT_POST,'resident');
                        
                        $newAddress->setDB();
                        
                    }if(filter_input(INPUT_POST, 'AddAdr')){
                    unset($_POST['AddAdr']);?>
                    <script>alert('Address Added!');</script>
                    <script> location.replace("general_edit.php"); </script>
                <?php }?>
                
                </form>
                
                <hr style="height:1px;border:none;color:#333;background-color:#333;">
                
                
                <form action="" method="post">                                  <!-- DELETE ADDRESS FORM STARTS HERE -->
                    
                    <?php if (!(filter_input(INPUT_POST, 'DelAdr'))) {?>
                    <h1 style="text-align: center;">Delete Address :</h1>
                    <div class="contentform">
                        
                        <div class="leftcontact">
                            
                            <div class="form-group">
                                <p>Address and Resident <span>*</span></p>
                                <select id="resident" name="resident" class="form-control" required>
                                    <option value="NULL"> - </option>
                                    <?php 
                                        $DB = new Database();
                                        $DB->loadAllAddresses();?>
                                </select>    
                                <div class="validation">
                                </div>
                            </div>
                            
                        </div>
                        
                        <div class="rightcontact">
                            
                            <div class="form-group">
                                <p>Authorize <span>*</span></p>
                                <label class="float-left">Confirm : </label>
                                <input class="delbox" type="checkbox" id="erase" name="erase" value="E" required>
                                <div class="validation">
                                </div>
                            </div>
                            
                        </div>
                        
                    </div>
                    <button type="submit" name="DelAdr" id="DelAdr" value="Del" class="bouton-contact">Delete</button>
                <?php }
                    else{
                        $DB->delAdr(filter_input(INPUT_POST,'resident'));
                        
                    }if(filter_input(INPUT_POST, 'DelAdr')){
                    unset($_POST['DelAdr']);?>
                    <script>alert('Address Deleted!');</script>
                    <script> location.replace("general_edit.php"); </script>
                <?php }?>
                
                </form>                                                         <!-- DELETE ADDRESS FORM ENDS HERE -->
                
            </div>                                                              <!-- ADDRESS TAB ENDS HERE -->
<!-- ====================================    EKSARTOMENOI   ======================================================== -->
            <div class="tab__content">                                          <!-- DEPENDANTS TAB STARTS HERE -->
                
                <h1>Manage Dependants</h1>
                <?php if (!(filter_input(INPUT_POST, 'AddDep'))) {?>
                <form action="" method="post">                                  <!-- ADD DEPENDANT FORM STARTS HERE -->
                    
                    <h1 style="text-align: center;">Add Dependant :</h1>
                    <div class="contentform">
                        
                        <div class="leftcontact">
                            
                            <div class="form-group">
                                <p>Firstname <span>*</span></p>
                                <span class="icon-case"></span>
                                <input type="text" id="fname" name="fname" required>
                                <div class="validation">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <p>Lastname <span>*</span></p>
                                <span class="icon-case"></span>
                                <input type="text" id="lname" name="lname" required>
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
                        
                        <div class="rightcontact">
                            
                            <div class="form-group">
                                <p>Date of Birth <span>*</span></p>
                                <span class="icon-case"></span>
                                <input type="date" id="ddob" name="ddob" required>
                                <div class="validation">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <p>Social Sec Num <span>*</span></p>
                                <span class="icon-case"></span>
                                <input type="text" id="ssn" name="ssn" maxlength="10" required>
                                <div class="validation">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <p>Relation <span>*</span></p>
                                <select id="relation" name="relation" class="form-control" required>
                                    <option value="1"> - </option>
                                    <option value="2">Child</option>
                                    <option value="3">Spouce</option>                                    
                                </select>    
                                <div class="validation">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <p>Insurer <span>*</span></p>
                                <select id="insurer" name="insurer" class="form-control" required>
                                    <option value="NULL"> - </option>
                                    <?php 
                                        $DB = new Database();
                                        $DB->loadAllEmployees()?>
                                </select>    
                                <div class="validation">
                                </div>
                            </div>
                            
                        </div>
                        
                    </div>
                    <button type="submit" name="AddDep" id="AddDep" value="Add" class="bouton-contact">Add</button>
                <?php }
                    else{
                        $newDependant = new Eksartomenos();
                        
                        $newDependant->AMKA_eksart = filter_input(INPUT_POST,'ssn');
                        $newDependant->Onoma_eksart = filter_input(INPUT_POST,'fname');
                        $newDependant->Eponymo_eksart = filter_input(INPUT_POST,'lname');
                        $newDependant->DOB_eksart = filter_input(INPUT_POST,'ddob');
                        $newDependant->Fylo_eksart = filter_input(INPUT_POST,'gender');
                        $newDependant->kod_prostati  = filter_input(INPUT_POST,'insurer');
                        
                        $newDependant->setDB();
                        
                        if(filter_input(INPUT_POST,'relation') == 2){ 
                            $DB->addNewChild(filter_input(INPUT_POST,'ssn'));
                        }elseif(filter_input(INPUT_POST,'relation') == 3){
                            $DB->addNewSpouce(filter_input(INPUT_POST,'ssn'));
                        }
                                
                                
                    }if(filter_input(INPUT_POST, 'AddDep')){
                    unset($_POST['AddDep']);?>
                    <script>alert('Dependant Added!');</script>
                    <script> location.replace("general_edit.php"); </script>
                <?php }?>
                
                </form>                                                         <!-- ADD DEPENDANT FORM ENDS HERE -->
                
                <hr style="height:1px;border:none;color:#333;background-color:#333;">
                
                <form action="" method="post">                                  <!-- DELETE DEPENDANT FORM STARTS HERE -->
                    
                    <?php if (!(filter_input(INPUT_POST, 'DelDep'))) {?>
                    <h1 style="text-align: center;">Delete Dependant :</h1>
                    <div class="contentform">
                        
                        <div class="leftcontact">
                            
                            <div class="form-group">
                                <p>Dependant and Insurer <span>*</span></p>
                                <select id="dins" name="dins" class="form-control" required>
                                    <option value="NULL"> - </option>
                                    <?php 
                                        $DB = new Database();
                                        $DB->loadAllDependants();?>
                                </select>    
                                <div class="validation">
                                </div>
                            </div>
                            
                        </div>
                        
                        <div class="rightcontact">
                            
                            <div class="form-group">
                                <p>Authorize <span>*</span></p>
                                <label class="float-left">Confirm : </label>
                                <input class="delbox" type="checkbox" id="erase" name="erase" value="E" required>
                                <div class="validation">
                                </div>
                            </div>
                            
                        </div>
                        
                    </div>
                    <button type="submit" name="DelDep" id="DelDep" value="Del" class="bouton-contact">Delete</button>
                <?php }
                    else{
                        $DB->delDep(filter_input(INPUT_POST,'dins'));
                        
                    }if(filter_input(INPUT_POST, 'DelDep')){
                    unset($_POST['DelDep']);?>
                    <script>alert('Dependant Deleted!');</script>
                    <script> location.replace("general_edit.php"); </script>
                <?php }?>
                
                </form>                                                         <!-- DELETE DEPENDANT FORM ENDS HERE -->
                
                
            </div>                                                              <!-- DEPENDANTS TAB ENDS HERE -->
            
            
        </div> <!-- TAB WRAP ENDS HERE -->
    
        
        
        <div class="button_cont center-text" align="center">
            <a class="example_a" href="asset_management.php">Back to Assets</a>
        </div>
        <hr>
        <div class="button_cont text-left-right" align="center">
            <a class="example_a left-text" href="logged_in_page.php">Back to Profile</a>
            <a class="example_a right-text" href="logout.php">LOGOUT</a>
        </div>   

    </div>
</body>
</html>