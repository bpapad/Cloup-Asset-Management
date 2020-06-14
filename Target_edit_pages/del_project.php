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
            $DB->delProject(filter_input(INPUT_POST,'target_proj_id'));
        ?>
        <script>alert('Project Deleted!');</script>
        <script> location.replace("../target_edit.php");</script>
    
</div>
</body>
</html>