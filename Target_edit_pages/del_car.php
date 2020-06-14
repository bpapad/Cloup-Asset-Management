<?php
    session_start();
    require_once ("../Classes/Database.php");
?>

<!DOCTYPE html>
<html>
<head>
</head>
<body>
    
        <?php
            $DB = new Database();
            $DB->delCar(filter_input(INPUT_POST,'target_car_id'));
        ?>
        <script>alert('Car Deleted!');</script>
        <script> location.replace("../target_edit.php");</script>
    
</div>
</body>
</html>