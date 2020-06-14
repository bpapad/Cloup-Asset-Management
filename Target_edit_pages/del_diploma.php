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
            $DB->delDiploma(filter_input(INPUT_POST,'target_dip_id'));
        ?>
        <script>alert('Diploma Deleted!');</script>
        <script> location.replace("../target_edit.php");</script>
    
</div>
</body>
</html>