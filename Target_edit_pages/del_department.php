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
            $DB->delDepartment(filter_input(INPUT_POST,'target_dpt_id'));
        ?>
        <script>alert('Department Deleted!');</script>
        <script> location.replace("../target_edit.php");</script>
    
</div>
</body>
</html>