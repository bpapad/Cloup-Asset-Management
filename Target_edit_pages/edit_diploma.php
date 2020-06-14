<?php
    session_start();
    require_once ("../Classes/Database.php");
    require_once ("../Classes/Ekpaideysh.php");
    require_once ("../Classes/Epimorfosi.php");
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
            $edited_dip = $DB->getDiplomaData(filter_input(INPUT_POST,'target_dip_id'));
        ?>
        
        <h1>Search Results</h1>
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
                        $bachelors = $DB->getDiplomaHolder($edited_dip['kwd_ptyxio']);
                    ?>
                    <tr>
                        <td><?php echo $edited_dip['kwd_ptyxio'] ?></td>
                        <td><?php echo $edited_dip['per_ptyxiou'] ?></td>
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
                    <tr><td></td></tr>
                <tbody>
            </table>
        </div>
        
        <hr style="height:1px;border:none;color:#333;background-color:#333;">
        
        <h1>Diploma</h1>
        <?php if(!filter_input(INPUT_POST,'Change_Diploma')) { ?>
        <form action="" method="post">                                  <!-- ADD EMPLOYEE FORM STARTS HERE -->
            <h1 style="text-align: center;">Edit Diploma :</h1>
            <div class="contentform">

                <div class="leftcontact">                               <!-- Left side elements of the form -->

                    <div class="form-group">
                        <p>New Diploma ID <span>*</span></p>
                        <span class="icon-case"></span>
                        <input type="text" id="dip_id" name="dip_id">
                        <div class="validation">
                        </div>
                    </div>
     
                </div>

                <div class="rightcontact">                              <!-- Right side elements of the form -->

                    <div class="form-group">
                        <p>New Diploma Name <span>*</span></p>
                        <span class="icon-case"></span>
                        <input type="text" id="dip_name" name="dip_name">
                        <div class="validation">
                        </div>
                    </div>
                    
                </div>
            </div>
            <button type="submit" name="Change_Diploma" id="Change_Diploma" value="<?php echo $edited_dip['kwd_ptyxio']?>" class="bouton-contact">Edit</button>
        </form>
        <?php } else { 
                    $sql = "UPDATE ekpaideysh ";
                    $w = "SET";
                    $t = " WHERE kwd_ptyxio = "."'".filter_input(INPUT_POST,'Change_Diploma')."'"; 
                    
                    if(filter_input(INPUT_POST,'dip_id') !== ""){
                        $w = $w." kwd_ptyxio = "."'".filter_input(INPUT_POST,'dip_id')."',";
                    }
                    if(filter_input(INPUT_POST,'dip_name') !== ""){
                        $w = $w." per_ptyxiou = "."'".filter_input(INPUT_POST,'dip_name')."',";
                    }
                    
                    $DB = new Database();
                    $DB->updateDiploma($sql.substr($w,0,-1).$t);
                
                    ?><script>alert('Diploma Updated!');</script>
                      <script> location.replace("../target_edit.php"); </script><?php
                    
                }
        ?>
        
        <hr>
        
        <?php if(!filter_input(INPUT_POST,'Remove_Dip_Holder')) { ?>
        <form action="" method="post">                                  <!-- ADD EMPLOYEE FORM STARTS HERE -->
            <h1 style="text-align: center;">Remove from Holder :</h1>
            <div class="contentform">
                
                <div class="form-group">
                    <p>Diploma Holder <span>*</span></p>
                    <select id="holder" name="holder" class="form-control">
                        <option value="NULL"> - </option>
                        <?php 
                            $DB = new Database();
                            $DB->get_targetdip_holders($edited_dip['kwd_ptyxio']);?>
                    </select>    
                    <div class="validation">
                    </div>
                </div>
                
            </div>
            <button type="submit" name="Remove_Dip_Holder" id="Remove_Dip_Holder" value="<?php echo $edited_dip['kwd_ptyxio']?>" class="bouton-contact">Remove</button>
        </form>
        <?php } else {
                    if(filter_input(INPUT_POST,'holder') !== "" && filter_input(INPUT_POST,'holder') !== "NULL"){
                        $DB = new Database();
                        $DB->remove_DipHolder(filter_input(INPUT_POST,'holder'), filter_input(INPUT_POST,'Remove_Dip_Holder'));
                    }
                    
                    ?><script>alert('Diploma Removed from Holder!');</script>
                      <script> location.replace("../target_edit.php"); </script><?php
                }
        ?>
                      
                      
        <div class="button_cont center-text" align="center">
            <a class="example_a" href="../target_edit.php">Cancel</a>
        </div>
                      
    </div>
</body>
</html>
