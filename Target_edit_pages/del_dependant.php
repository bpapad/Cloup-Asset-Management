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
            $DB->delDep(filter_input(INPUT_POST,'target_d_id'));
        ?>
        <script>alert('Dependant Deleted!');</script>
        <script> location.replace("../target_edit.php");</script>
    
</div>
</body>
</html>