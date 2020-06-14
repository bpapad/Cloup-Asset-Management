<?php
    session_start();
    require_once ("../Classes/Database.php");
    require_once ("../Classes/Ergazomenos.php");
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
        
        <?php
            $DB = new Database();
            $edited_dep = $DB->get_editedDep(filter_input(INPUT_POST,'target_d_id'));
        ?>
        
        <div class="table-wrapper">
            <table class="fl-table">  
                <thead>
                <tr>
                    <th>Dependant Soc Sec Num</th>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Gender</th>
                    <th>DoB</th>
                    <th>Relation</th>
                    <th>Insurer</th>
                </tr>
                </thead>
                <tbody>
                <tr>                         <!-- Gemisma pinaka me ta dedomena tou xrhsth apo to session -->
                    <td><?php echo $edited_dep['AMKA_eksart']?></td>
                    <td><?php echo $edited_dep['Onoma_eksart']?></td>
                    <td><?php echo $edited_dep['Eponymo_eksart']?></td>
                    <td><?php echo $edited_dep['Fylo_eksart']?></td>
                    <td><?php echo $edited_dep['DOB_eksart']?></td>
                    <td><?php echo $DB->child_spouce($edited_dep['AMKA_eksart'])?></td>
                    <td><?php echo $DB->target_dep_insurer($edited_dep['kod_prostati'])?></td>
                </tr>
                <tr><td></td></tr>
                <tbody>
            </table>
        </div>
        
        <hr style="height:1px;border:none;color:#333;background-color:#333;">
        
        <h1>Dependant</h1>
        <?php if(!filter_input(INPUT_POST,'Change_Dep')) { ?>
        <form action="" method="post">                                  <!-- ADD EMPLOYEE FORM STARTS HERE -->
            <h1 style="text-align: center;">Edit Dependant :</h1>
            <div class="contentform">

                <div class="leftcontact">                               <!-- Left side elements of the form -->

                    <div class="form-group">
                        <p>New Soc Sec Num <span>*</span></p>
                        <span class="icon-case"></span>
                        <input type="text" id="d_id" name="d_id">
                        <div class="validation">
                        </div>
                    </div>

                    <div class="form-group">
                        <p>New DoB <span>*</span></p>
                        <span class="icon-case"></span>
                        <input type="date" id="ddob" name="ddob">
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
                        <p>New Firstname <span>*</span></p>
                        <span class="icon-case"></span>
                        <input type="text" id="dfname" name="dfname">
                        <div class="validation">
                        </div>
                    </div>

                    <div class="form-group">
                        <p>New Lastname <span>*</span></p>
                        <span class="icon-case"></span>
                        <input type="text" id="dlname" name="dlname">
                        <div class="validation">
                        </div>
                    </div>

                    <div class="form-group">
                        <p>New Insurer <span>*</span></p>
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
            <button type="submit" name="Change_Dep" id="Change_Dep" value="<?php echo $edited_dep['AMKA_eksart']?>" class="bouton-contact">Edit</button>
        </form>
        <?php } else { 
                    $sql = "UPDATE eksartomenos ";
                    $w = "SET";
                    $t = " WHERE AMKA_eksart = "."'".filter_input(INPUT_POST,'Change_Dep')."'"; 
                    
                    if(filter_input(INPUT_POST,'d_id') !== ""){
                        $w = $w." AMKA_eksart  = "."'".filter_input(INPUT_POST,'d_id')."',";
                    }
                    if(filter_input(INPUT_POST,'dfname') !== ""){
                        $w = $w." Onoma_eksart = "."'".filter_input(INPUT_POST,'dfname')."',";
                    }
                    if(filter_input(INPUT_POST,'dlname') !== ""){
                        $w = $w." Eponymo_eksart = "."'".filter_input(INPUT_POST,'dlname')."',";
                    }
                    if(filter_input(INPUT_POST,'ddob') !== ""){
                        $w = $w." DOB_eksart = "."'".filter_input(INPUT_POST,'ddob')."',";
                    }
                    if(filter_input(INPUT_POST,'gender') == "M" || filter_input(INPUT_POST,'gender') == "F"){
                        $w = $w." Fylo_eksart = "."'".filter_input(INPUT_POST,'gender')."',";
                    }
                    if(filter_input(INPUT_POST,'iname') !== "" && filter_input(INPUT_POST,'iname') !== "NULL"){
                        $w = $w." kod_prostati = "."'".filter_input(INPUT_POST,'iname')."',";
                    }
                    
                    $DB = new Database();
                    $DB->updateDependant($sql.substr($w,0,-1).$t);
                
                    ?><script>alert('Dependant Updated!');</script>
                      <script> location.replace("../target_edit.php"); </script><?php
                    
                }
        ?>
        
        <hr>
        
        <?php if(!filter_input(INPUT_POST,'Change_Rel')) { ?>
        <form action="" method="post">                                  <!-- ADD EMPLOYEE FORM STARTS HERE -->
            <h1 style="text-align: center;">Edit Relation :</h1>
            <div class="contentform">

                <div class="form-group">
                    <p>New Relation <span>*</span></p>
                    <select id="iirelation" name="iirelation" class="form-control">
                        <option value="NULL"> - </option>
                        <option value="R"> Remove </option>
                        <option value="C"> Child </option>
                        <option value="S"> Spouce </option>
                    </select>    
                    <div class="validation">
                    </div>
                </div>

            </div>
            <button type="submit" name="Change_Rel" id="Change_Rel" value="<?php echo $edited_dep['AMKA_eksart']?>" class="bouton-contact">Edit</button>
        </form>
        <?php } else{
                if(filter_input(INPUT_POST,'iirelation') == 'R'){
                    $DB->delSpouce(filter_input(INPUT_POST,'Change_Rel'));
                    $DB->delChild(filter_input(INPUT_POST,'Change_Rel'));
                }
                if(filter_input(INPUT_POST,'iirelation') == 'C'){
                    $DB->delSpouce(filter_input(INPUT_POST,'Change_Rel'));
                    $DB->addNewChild(filter_input(INPUT_POST,'Change_Rel'));
                }
                if(filter_input(INPUT_POST,'iirelation') == 'S'){
                    $DB->delChild(filter_input(INPUT_POST,'Change_Rel'));
                    $DB->addNewSpouce(filter_input(INPUT_POST,'Change_Rel'));
                }
                
            ?>  <script>alert('Relation Updated!');</script>
                <script> location.replace("../target_edit.php"); </script><?php
                    
            } ?>
        
        <div class="button_cont center-text" align="center">
            <a class="example_a" href="../target_edit.php">Cancel</a>
        </div>
                      
    </div>
</body>
</html>
