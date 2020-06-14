<?php
    session_start();
    require_once ("../Classes/Database.php");
    require_once ("../Classes/Ergo.php");
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
        
        <h1>Search Results</h1>
        <?php
        
            $DB = new Database();
            $edited_dpt = $DB->get_Target_Ergo(filter_input(INPUT_POST, 'target_proj_id'));
            
        ?>
        <div class="table-wrapper">
            <table class="fl-table">  
                <thead>
                <tr>
                    <th>Project ID</th>
                    <th>Project Name</th>
                    <th>Start Date</th>
                    <th>Finish Date</th>
                    <th>Leading Department</th>
                </tr>
                </thead>
                <tbody>
                <tr>                         <!-- Gemisma pinaka me ta dedomena tou xrhsth apo to session -->
                    <td><?php echo $edited_dpt['kwd_ergou']?></td>
                    <td><?php echo $edited_dpt['perigrafh_ergou']?></td>
                    <td><?php echo $edited_dpt['start_date']?></td>
                    <td><?php echo $edited_dpt['finish_date']?></td>
                    <td><?php $DB->getTmhmaOnErgo($edited_dpt['kwd_ergou'])?></td>
                </tr>
                <tr><td></td></tr>
                <tbody>
            </table>
        </div>
        
        <hr>
        
        <?php
        
            $assignedEmps = $DB->getAssignedEmployees(filter_input(INPUT_POST, 'target_proj_id'));
            
        ?>
        <div class="table-wrapper">
            <table class="fl-table">  
                <thead>
                <tr>
                    <th>Assigned Emp Firstname</th>
                    <th>Assigned Emp Lastname</th>
                    <th>Emp Social Sec Num</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($assignedEmps as $assignedEmp){
                    ?>
                <tr>                         <!-- Gemisma pinaka me ta dedomena tou xrhsth apo to session -->
                    <td><?php echo $assignedEmp['Onoma_Ergazom']?></td>
                    <td><?php echo $assignedEmp['Eponymo_ergazom']?></td>
                    <td><?php echo $assignedEmp['AFM_Ergaz']?></td>
                </tr>
                    <?php } ?>
                <tr><td></td></tr>
                <tbody>
            </table>
        </div>
        
        
        
        <hr style="height:1px;border:none;color:#333;background-color:#333;">
        <h1>Project</h1>
        <?php if(!filter_input(INPUT_POST,'Change_Ergo')) {?>
        <form action="" method="post">                                  <!-- ADD EMPLOYEE FORM STARTS HERE -->
            <h1 style="text-align: center;">Edit Project :</h1>
            <div class="contentform">

                <div class="leftcontact">                               <!-- Left side elements of the form -->

                    <div class="form-group">
                        <p>New Project Name <span>*</span></p>
                        <span class="icon-case"></span>
                        <input type="text" id="proj_name" name="proj_name">
                        <div class="validation">
                        </div>
                    </div>

                    <div class="form-group">
                        <p>New Start Date <span>*</span></p>
                        <span class="icon-case"></span>
                        <input type="date" id="st_date" name="st_date">
                        <div class="validation">
                        </div>
                    </div>
                    
                </div>

                <div class="rightcontact">                              <!-- Right side elements of the form -->

                    <div class="form-group">
                        <p>New Project ID <span>*</span></p>
                        <span class="icon-case"></span>
                        <input type="text" id="proj_id" name="proj_id">
                        <div class="validation">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <p>New Finish Date <span>*</span></p>
                        <span class="icon-case"></span>
                        <input type="date" id="fn_date" name="fn_date">
                        <div class="validation">
                        </div>
                    </div>
                    
                </div>
            </div>
            <button type="submit" name="Change_Ergo" id="Change_Ergo" value="<?php echo $edited_dpt['kwd_ergou']?>" class="bouton-contact">Edit</button>
        </form>
        <?php } else { 
                    $sql = "UPDATE ergo ";
                    $w = "SET";
                    $t = " WHERE kwd_ergou = "."'".filter_input(INPUT_POST,'Change_Ergo')."'"; 
                    
                    if(filter_input(INPUT_POST,'proj_id') !== ""){
                        $w = $w." kwd_ergou  = "."'".filter_input(INPUT_POST,'proj_id')."',";
                    }
                    if(filter_input(INPUT_POST,'proj_name') !== ""){
                        $w = $w." perigrafh_ergou = "."'".filter_input(INPUT_POST,'proj_name')."',";
                    }
                    if(filter_input(INPUT_POST,'st_date') !== "" && filter_input(INPUT_POST,'sup') !== "NULL"){
                        $w = $w." start_date = "."'".filter_input(INPUT_POST,'st_date')."',";
                    }
                    if(filter_input(INPUT_POST,'fn_date') !== "" && filter_input(INPUT_POST,'sup') !== "NULL"){
                        $w = $w." finish_date = "."'".filter_input(INPUT_POST,'fn_date')."',";
                    }
                    
                    $DB = new Database();
                    $DB->updateErgo($sql.substr($w,0,-1).$t);
                
                    ?><script>alert('Ergo Updated!');</script>
                      <script> location.replace("../target_edit.php"); </script><?php
                    
                }
        ?>
                      
                      
        <hr style="height:1px;border:none;color:#333;background-color:#333;">
        
        <h1>Employees on Project</h1>
        <?php if(!filter_input(INPUT_POST,'Remove_AsgEmp')) {?>
        <form action="" method="post">                                  <!-- ADD EMPLOYEE FORM STARTS HERE -->
            <h1 style="text-align: center;">Remove Assigned Employees :</h1>
            <div class="contentform">

             <div class="form-group">
                <p>Assigned Employees Name <span>*</span></p>
                <select id="name" name="name" class="form-control" required>
                    <option value="NULL"> - </option>
                    <?php 
                        $DB = new Database();
                        $DB->printAssignedEmployees($edited_dpt['kwd_ergou'])?>
                </select>    
                <div class="validation">
                </div>
            </div>   
                    
            </div>
            <button type="submit" name="Remove_AsgEmp" id="Remove_AsgEmp" value="<?php echo $edited_dpt['kwd_ergou']?>" class="bouton-contact">Remove</button>
        </form>
        <?php } else {
                    if(filter_input(INPUT_POST,'name') !== "" && filter_input(INPUT_POST,'name') !== "NULL"){
                        $sql = "DELETE FROM ergazomenoi_se_erga WHERE kwd_ergou = '".filter_input(INPUT_POST,'Remove_AsgEmp')."'"." AND kwd_ergazom_ergo = '".filter_input(INPUT_POST,'name')."'";
                    }
                    
                    $DB = new Database();
                    $DB->delete_ergazomeno_from_ergo($sql);
                
                    ?><script>alert('Ergazomenos Removed from Ergo!');</script>
                      <script> location.replace("../target_edit.php"); </script><?php
                    
                }
        ?>
        <hr>
        
        <?php if(!filter_input(INPUT_POST,'Assign_Emp')) {?>
        <form action="" method="post">                                  <!-- ADD EMPLOYEE FORM STARTS HERE -->
            <h1 style="text-align: center;">Assign New Employees :</h1>
            <div class="contentform">

            <div class="form-group">
                <p>Non Assigned Employees Name <span>*</span></p>
                <select id="nname" name="nname" class="form-control" required>
                    <option value="NULL"> - </option>
                    <?php 
                        $DB = new Database();
                        $DB->loadAllEmployees();?>
                </select>    
                <div class="validation">
                </div>
            </div>   
                    
            </div>
            <button type="submit" name="Assign_Emp" id="Assign_Emp" value="<?php echo $edited_dpt['kwd_ergou']?>" class="bouton-contact">Assign</button>
        </form>
        <?php } else {
                    if(filter_input(INPUT_POST,'nname') !== "" && filter_input(INPUT_POST,'nname') !== "NULL"){
                        $sql ="INSERT INTO ergazomenoi_se_erga (kwd_ergazom_ergo, kwd_ergou) VALUES ('".filter_input(INPUT_POST,'nname')."', '".filter_input(INPUT_POST,'Assign_Emp')."')";
                    }
                    
                    $DB = new Database();
                    $DB->assign_ergazomeno_to_ergo($sql);
                
                    ?><script>alert('Ergazomenos Assigned to Ergo!');</script>
                      <script> location.replace("../target_edit.php"); </script><?php
                    
                }
        ?>
                      
        <hr style="height:1px;border:none;color:#333;background-color:#333;">
        
        <h1>Leading Department</h1>
        <?php if(!filter_input(INPUT_POST,'Change_LDpt')) {?>
        <form action="" method="post">                                  <!-- ADD EMPLOYEE FORM STARTS HERE -->
            <h1 style="text-align: center;">Change Leading Department :</h1>
            <div class="contentform">

             <div class="form-group">
                <p>Department <span>*</span></p>
                <select id="ndepartment" name="ndepartment" class="form-control">
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
            <button type="submit" name="Change_LDpt" id="Change_LDpt" value="<?php echo $edited_dpt['kwd_ergou']?>" class="bouton-contact">Change</button>
        </form>
        <?php } else {
                    if(filter_input(INPUT_POST,'ndepartment') !== "" && filter_input(INPUT_POST,'ndepartment') !== "NULL"){
                        $sql = "UPDATE tmhmata_se_erga SET kwd_tmhmatos_ergou = '".filter_input(INPUT_POST,'ndepartment')."' WHERE kwd_ergou_tmhma = '".filter_input(INPUT_POST,'Change_LDpt')."'";
                    }
                    
                    $DB = new Database();
                    $DB->change_proj_dpt_assign($sql);
                
                    ?><script>alert('Assigned Department Updated!');</script>
                      <script> location.replace("../target_edit.php"); </script><?php
                    
                }
        ?>
        <hr>
        
        
        
        <div class="button_cont center-text" align="center">
            <a class="example_a" href="../target_edit.php">Cancel</a>
        </div>
                      
    </div>
</body>
</html>
