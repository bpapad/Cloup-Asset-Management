<?php
    session_start();
    require_once ("../Classes/Database.php");
    require_once ("../Classes/Ergazomenos.php");
    require_once ("../Classes/Address_ergazomenou.php");
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta content="IE=edge" http-equiv="X-UA-Compatible">
	<meta content="width=device-width, initial-scale=1" name="viewport">
	
	<!-- CSS -->
        <link href="../css/body_background.css" rel="stylesheet">
        <link href="../css/logged_in_page.css" rel="stylesheet">
        <link href="../css/tabs.css" rel="stylesheet">
        <link href="../css/form.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
	
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
        
        <div>
            
        <h1>Search Results</h1>
        <?php
            $DB = new Database();
            $edited_emp = $DB->getErgazomeno(filter_input(INPUT_POST,'target_id'));
        ?>
    
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
                </tr>
                </thead>
                <tbody>
                <tr>                         <!-- Gemisma pinaka me ta dedomena tou xrhsth apo to session -->
                    <td><?php echo $edited_emp['kwd_ergazomenou']?></td>
                    <td><?php echo $edited_emp['Eponymo_ergazom']?></td>
                    <td><?php echo $edited_emp['Onoma_Ergazom']?></td>
                    <td><?php echo $edited_emp['Patronymo_Ergazom']?></td>
                    <td><?php echo $edited_emp['Fyllo_Ergaz']?></td>
                    <td><?php echo $edited_emp['AFM_Ergaz']?></td>
                    <td><?php echo $edited_emp['DOB_Ergazom']?></td>
                    <td><?php echo $edited_emp['Tel_Ergaz']?></td>
                    <td><?php echo $edited_emp['Salary_Ergazom']?></td>
                    <td><?php $DB->getMyDpt($edited_emp['kwd_ergazomenou'])?></td>
                    <td><?php echo $DB->getMyUtype($edited_emp['user_type_ergazom'])?></td>
                </tr>
                <tr><td></td></tr>
                <tbody>
            </table>
        </div>
        
        <hr>
        
        <h2>Dependants</h2>
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
                        $insured = $DB->getAllInsured($edited_emp['kwd_ergazomenou']);
                    ?>
                    <tr>
                        <td><?php echo "Insured : ".Database::$count ?></td>
                        <td></td>
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
                    <tr><td></td></tr>
                <tbody>
            </table>
        </div>
        
        <hr>
        
        <h2>ΔΙΕΥΘΥΝΣΕΙΣ</h2>
        <?php
            $place = new Address_ergazomenou();
            $place->setResident($edited_emp['kwd_ergazomenou']);
            $place->getAddress();
        ?>
            <div class="table-wrapper">
                <table class="fl-table">  
                    <thead>
                    <tr>
                        <th>Zip Code</th>
                        <th>Street</th>
                        <th>Number</th>
                        <th>City</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo $place->zip_code; ?></td>
                            <td><?php echo $place->odos; ?></td>
                            <td><?php echo $place->arithmos; ?></td>
                            <td><?php echo $place->polh; ?></td>
                        </tr>
                        <tr><td></td></tr>
                    <tbody>
                </table>
            </div>
        
        </div>
        <hr style="height:1px;border:none;color:#333;background-color:#333;">
        
        <h1>Employee</h1>
        <?php if(!filter_input(INPUT_POST,'Change_User')) { ?>
        <form action="" method="post">                                  <!-- ADD EMPLOYEE FORM STARTS HERE -->
            <h1 style="text-align: center;">Edit Employee :</h1>
            <div class="contentform">

                <div class="leftcontact">                               <!-- Left side elements of the form -->

                    <div class="form-group">
                        <p>New Firstname <span>*</span></p>
                        <span class="icon-case"></span>
                        <input type="text" id="firstname" name="firstname">
                        <div class="validation">
                        </div>
                    </div>

                    <div class="form-group">
                        <p>New Lastname <span>*</span></p>
                        <span class="icon-case"></span>
                        <input type="text" id="lastname" name="lastname">
                        <div class="validation">
                        </div>
                    </div> 

                    <div class="form-group">
                        <p>New Father's <span>*</span></p>    
                        <span class="icon-case"></span>
                        <input type="text" id="father" name="father">
                        <div class="validation">
                        </div>
                    </div>

                    <div class="form-group">
                        <p>New Date of Birth <span>*</span></p>
                        <span class="icon-case"><i class="fa fa-location-arrow"></i></span>
                        <input type="date" id="dob" name="dob">
                        <div class="validation">
                        </div>
                    </div>

                    <div class="form-group">
                        <p>New Phone <span>*</span></p>
                        <span class="icon-case"></span>
                        <input type="text" id="phone" name="phone">
                        <div class="validation">
                        </div>
                    </div>

                    <div class="form-group">
                        <p>New Gender <span>*</span></p>
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
                        <p>New Cloup ID <span>*</span></p>
                        <span class="icon-case"></span>
                        <input type="text" id="cloup_id" name="cloup_id">
                        <div class="validation">
                        </div>
                    </div>

                    <div class="form-group">
                        <p>New Salary <span>*</span></p>
                        <span class="icon-case"></span>
                        <input type="text" id="salary" name="salary">
                        <div class="validation">
                        </div>
                    </div>

                    <div class="form-group">
                        <p>New Social Sec Num <span>*</span></p>
                        <span class="icon-case"></span>
                        <input type="text" id="amka" name="amka" maxlength="10">
                        <div class="validation">
                        </div>
                    </div>

                    <div class="form-group">
                        <p>New Rights <span>*</span></p>
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
                        <p>New Department <span>*</span></p>
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
            <button type="submit" name="Change_User" id="Change_User" value="<?php echo $edited_emp['kwd_ergazomenou']?>" class="bouton-contact">Edit</button>
        </form>
        <?php } else { 
                    $sql = "UPDATE ergazomenos ";
                    $w = "SET";
                    $t = " WHERE kwd_ergazomenou = "."'".filter_input(INPUT_POST,'Change_User')."'"; 
                    
                    if(filter_input(INPUT_POST,'cloup_id') !== ""){
                        $w = $w." kwd_ergazomenou  = "."'".filter_input(INPUT_POST,'cloup_id')."',";
                    }
                    if(filter_input(INPUT_POST,'firstname') !== ""){
                        $w = $w." Onoma_Ergazom = "."'".filter_input(INPUT_POST,'firstname')."',";
                    }
                    if(filter_input(INPUT_POST,'lastname') !== ""){
                        $w = $w." Eponymo_ergazom = "."'".filter_input(INPUT_POST,'lastname')."',";
                    }
                    if(filter_input(INPUT_POST,'father') !== ""){
                        $w = $w." Patronymo_Ergazom = "."'".filter_input(INPUT_POST,'father')."',";
                    }
                    if(filter_input(INPUT_POST,'gender') == "M" || filter_input(INPUT_POST,'gender') !== "F"){
                        $w = $w." Fyllo_Ergaz = "."'".filter_input(INPUT_POST,'gender')."',";
                    }
                    if(filter_input(INPUT_POST,'amka') !== ""){
                        $w = $w." AFM_Ergaz = "."'".filter_input(INPUT_POST,'amka')."',";
                    }
                    if(filter_input(INPUT_POST,'dob') !== ""){
                        $w = $w." DOB_Ergazom = "."'".filter_input(INPUT_POST,'dob')."',";
                    }
                    if(filter_input(INPUT_POST,'phone') !== ""){
                        $w = $w." Tel_Ergaz = "."'".filter_input(INPUT_POST,'phone')."',";
                    }
                    if(filter_input(INPUT_POST,'salary') !== ""){
                        $w = $w." Salary_Ergazom = "."'".filter_input(INPUT_POST,'salary')."',";
                    }
                    if(filter_input(INPUT_POST,'department') !== "" && filter_input(INPUT_POST,'department') !== "NULL"){
                        $w = $w." Kod_tm_ergazom  = "."'".filter_input(INPUT_POST,'department')."',";
                    }
                    if(filter_input(INPUT_POST,'rights') !== "" && filter_input(INPUT_POST,'rights') !== "NULL"){
                        $w = $w." user_type_ergazom  = "."'".filter_input(INPUT_POST,'rights')."',";
                    }
                    
                    $DB = new Database();
                    $DB->updateErgazomeno($sql.substr($w,0,-1).$t);
                
                    ?><script>alert('Employee Updated!');</script>
                      <script> location.replace("../target_edit.php"); </script><?php
                    
                }
        ?>
                      
        <hr>
        
        <h1>Address</h1>
        <?php if(!filter_input(INPUT_POST,'Change_Address')) { ?>
        <form action="" method="post">                                  <!-- ADD EMPLOYEE FORM STARTS HERE -->
            <h1 style="text-align: center;">Edit Address :</h1>
            <div class="contentform">

                <div class="leftcontact">                               <!-- Left side elements of the form -->

                    <div class="form-group">
                        <p>New Street Name <span>*</span></p>
                        <span class="icon-case"></span>
                        <input type="text" id="street" name="street">
                        <div class="validation">
                        </div>
                    </div>

                    <div class="form-group">
                        <p>New Number <span>*</span></p>
                        <span class="icon-case"></span>
                        <input type="text" id="snum" name="snum">
                        <div class="validation">
                        </div>
                    </div>
                    
                </div>

                <div class="rightcontact">                              <!-- Right side elements of the form -->

                    <div class="form-group">
                        <p>New City <span>*</span></p>
                        <span class="icon-case"></span>
                        <input type="text" id="city" name="city">
                        <div class="validation">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <p>New Zip Code <span>*</span></p>
                        <span class="icon-case"></span>
                        <input type="text" id="nzip" name="nzip">
                        <div class="validation">
                        </div>
                    </div>
                    
                </div>
            </div>
            <button type="submit" name="Change_Address" id="Change_Address" value="<?php echo $edited_emp['kwd_ergazomenou']?>" class="bouton-contact">Edit</button>
        </form>
        <?php } else { 
                    $sql = "UPDATE address_ergazomenou ";
                    $w = "SET";
                    $t = " WHERE kwd_ergazomenou_adr = "."'".filter_input(INPUT_POST,'Change_Address')."'"; 
                    
                    if(filter_input(INPUT_POST,'street') !== ""){
                        $w = $w." odos = "."'".filter_input(INPUT_POST,'street')."',";
                    }
                    if(filter_input(INPUT_POST,'snum') !== ""){
                        $w = $w." arithmos = "."'".filter_input(INPUT_POST,'snum')."',";
                    }
                    if(filter_input(INPUT_POST,'city') !== ""){
                        $w = $w." polh = "."'".filter_input(INPUT_POST,'city')."',";
                    }
                    if(filter_input(INPUT_POST,'nzip') !== ""){
                        $w = $w." zip_code = "."'".filter_input(INPUT_POST,'nzip')."',";
                    }
                    
                    $DB = new Database();
                    $DB->updateAddress($sql.substr($w,0,-1).$t);
                
                    ?><script>alert('Employee Address Updated!');</script>
                      <script> location.replace("../target_edit.php"); </script><?php
                    
                }
        ?>
        
        <div class="button_cont center-text" align="center">
            <a class="example_a" href="../target_edit.php">Cancel</a>
        </div>
                      
    </div>
</body>
</html>
