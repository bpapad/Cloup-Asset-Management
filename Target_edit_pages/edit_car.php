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
            $edited_car = $DB->get_editedCar(filter_input(INPUT_POST,'target_car_id'));
        ?>
        
        <div class="table-wrapper">
            <table class="fl-table">  
                <thead>
                <tr>
                    <th>Licence Plate</th>
                    <th>Color</th>
                    <th>Model</th>
                    <th>Brand</th>
                    <th>Driver</th>
                </tr>
                </thead>
                <tbody>
                <tr>                         <!-- Gemisma pinaka me ta dedomena tou xrhsth apo to session -->
                    <td><?php echo $edited_car['ar_kykloforias']?></td>
                    <td><?php echo $edited_car['xroma_oxhm']?></td>
                    <td><?php echo $edited_car['montelo_oxhm']?></td>
                    <td><?php echo $edited_car['marka_oxhm']?></td>
                    <td><?php echo $DB->getDrivers($edited_car['odhgos'])?></td>
                </tr>
                <tr><td></td></tr>
                <tbody>
            </table>
        </div>
        
        <hr style="height:1px;border:none;color:#333;background-color:#333;">
        
        <h1>Car</h1>
        <?php if(!filter_input(INPUT_POST,'Change_Car')) { ?>
        <form action="" method="post">                                  <!-- ADD EMPLOYEE FORM STARTS HERE -->
            <h1 style="text-align: center;">Edit Car :</h1>
            <div class="contentform">

                <div class="leftcontact">                               <!-- Left side elements of the form -->

                    <div class="form-group">
                        <p>New Licence Plate <span>*</span></p>
                        <span class="icon-case"></span>
                        <input type="text" id="clplate" name="clplate">
                        <div class="validation">
                        </div>
                    </div>

                    <div class="form-group">
                        <p>New Color <span>*</span></p>
                        <span class="icon-case"></span>
                        <input type="text" id="ccolor" name="ccolor">
                        <div class="validation">
                        </div>
                    </div>

                </div>

                <div class="rightcontact">                              <!-- Right side elements of the form -->

                    <div class="form-group">
                        <p>New Model <span>*</span></p>
                        <span class="icon-case"></span>
                        <input type="text" id="cmodel" name="cmodel">
                        <div class="validation">
                        </div>
                    </div>

                    <div class="form-group">
                        <p>New Brand <span>*</span></p>
                        <span class="icon-case"></span>
                        <input type="text" id="cbrand" name="cbrand">
                        <div class="validation">
                        </div>
                    </div>

                    <div class="form-group">
                        <p>New Driver <span>*</span></p>
                        <select id="cdriver" name="cdriver" class="form-control">
                            <option value="NULL"> - </option>
                            <?php
                                $DB = new Database();
                                $DB->loadAllEmployees();
                            ?>
                        </select>
                        <div class="validation">
                        </div>
                    </div>

                </div>
            </div>
            <button type="submit" name="Change_Car" id="Change_Car" value="<?php echo $edited_car['ar_kykloforias']?>" class="bouton-contact">Edit</button>
        </form>
        <?php } else { 
                    $sql = "UPDATE oxhma ";
                    $w = "SET";
                    $t = " WHERE ar_kykloforias = "."'".filter_input(INPUT_POST,'Change_Car')."'"; 
                    
                    if(filter_input(INPUT_POST,'clplate') !== ""){
                        $w = $w." ar_kykloforias = "."'".filter_input(INPUT_POST,'clplate')."',";
                    }
                    if(filter_input(INPUT_POST,'ccolor') !== ""){
                        $w = $w." xroma_oxhm = "."'".filter_input(INPUT_POST,'ccolor')."',";
                    }
                    if(filter_input(INPUT_POST,'cmodel') !== ""){
                        $w = $w." montelo_oxhm = "."'".filter_input(INPUT_POST,'cmodel')."',";
                    }
                    if(filter_input(INPUT_POST,'cbrand') !== ""){
                        $w = $w." marka_oxhm = "."'".filter_input(INPUT_POST,'cbrand')."',";
                    }
                    if(filter_input(INPUT_POST,'cdriver') !== "" && filter_input(INPUT_POST,'cdriver') !== "NULL"){
                        $w = $w." odhgos = "."'".filter_input(INPUT_POST,'cdriver')."',";
                    }
                    
                    $DB = new Database();
                    $DB->updateCar($sql.substr($w,0,-1).$t);
                
                    ?><script>alert('Car Updated!');</script>
                      <script> location.replace("../target_edit.php"); </script><?php
                    
                }
        ?>
        
        <div class="button_cont center-text" align="center">
            <a class="example_a" href="../target_edit.php">Cancel</a>
        </div>
                      
    </div>
</body>
</html>
