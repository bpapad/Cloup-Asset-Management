<?php
    session_start();
    require_once ("../Classes/Database.php");
    require_once ("../Classes/Tmhma.php");
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
            $edited_dpt = new Tmhma();
            
            $edited_dpt->setID(filter_input(INPUT_POST, 'target_dpt_id'));
            $DB->getDepartment($edited_dpt);
        ?>
        
        <div class="table-wrapper">
            <table class="fl-table">  
                <thead>
                <tr>
                    <th>Department ID</th>
                    <th>Department Name</th>
                    <th>Supervisor</th>
                    <th>Supervisor's Car LP</th>
                </tr>
                </thead>
                <tbody>
                <tr>                         <!-- Gemisma pinaka me ta dedomena tou xrhsth apo to session -->
                    <td><?php echo $edited_dpt->kwd_tmhmatos?></td>
                    <td><?php echo $edited_dpt->onoma_tmhmatos?></td>
                    <td><?php echo $DB->findSupervisor($edited_dpt->kwd_proistamenou)?></td>
                    <td><?php echo $DB->findSupervisorCar($edited_dpt->kwd_proistamenou)?></td>
                </tr>
                <tr><td></td></tr>
                <tbody>
            </table>
        </div>
        
        <hr style="height:1px;border:none;color:#333;background-color:#333;">
        
        <?php if(!filter_input(INPUT_POST,'Change_Tmhma')) { ?>
        <form action="" method="post">                                  <!-- ADD EMPLOYEE FORM STARTS HERE -->
            <h1 style="text-align: center;">Edit Department :</h1>
            <div class="contentform">

                <div class="leftcontact">                               <!-- Left side elements of the form -->

                    <div class="form-group">
                        <p>New Department Name <span>*</span></p>
                        <span class="icon-case"></span>
                        <input type="text" id="dpt_name" name="dpt_name">
                        <div class="validation">
                        </div>
                    </div>

                    <div class="form-group">
                        <p>New Supervisor <span>*</span></p>
                        <select id="sup" name="sup" class="form-control">
                            <option value="NULL"> - </option>
                            <?php 
                                $DB = new Database();
                                $DB->loadAllEmployees();?>
                        </select>    
                        <div class="validation">
                        </div>
                    </div>
                    
                </div>

                <div class="rightcontact">                              <!-- Right side elements of the form -->

                    <div class="form-group">
                        <p>New Department ID <span>*</span></p>
                        <span class="icon-case"></span>
                        <input type="text" id="dpt_id" name="dpt_id">
                        <div class="validation">
                        </div>
                    </div>
                    
                </div>
            </div>
            <button type="submit" name="Change_Tmhma" id="Change_Tmhma" value="<?php echo $edited_dpt->kwd_tmhmatos?>" class="bouton-contact">Edit</button>
        </form>
        <?php } else { 
                    $sql = "UPDATE tmhma ";
                    $w = "SET";
                    $t = " WHERE kwd_tmhmatos = "."'".filter_input(INPUT_POST,'Change_Tmhma')."'"; 
                    
                    if(filter_input(INPUT_POST,'dpt_id') !== ""){
                        $w = $w." kwd_tmhmatos  = "."'".filter_input(INPUT_POST,'dpt_id')."',";
                    }
                    if(filter_input(INPUT_POST,'dpt_name') !== ""){
                        $w = $w." onoma_tmhmatos = "."'".filter_input(INPUT_POST,'dpt_name')."',";
                    }
                    if(filter_input(INPUT_POST,'sup') !== "" && filter_input(INPUT_POST,'sup') !== "NULL"){
                        $w = $w." kwd_proistamenou = "."'".filter_input(INPUT_POST,'sup')."',";
                    }
                    
                    $DB = new Database();
                    $DB->updateTmhma($sql.substr($w,0,-1).$t);
                
                    ?><script>alert('Department Updated!');</script>
                      <script> location.replace("../target_edit.php"); </script><?php
                    
                }
        ?>
        
        <div class="button_cont center-text" align="center">
            <a class="example_a" href="../target_edit.php">Cancel</a>
        </div>
                      
    </div>
</body>
</html>
