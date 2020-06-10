<?php
    session_start();
    require_once ("Classes/Ergazomenos.php");
    require_once ("Classes/Credentials.php");
    require_once ("Classes/Database.php");
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Cloup AE</title>
        <link rel="stylesheet" type="text/css" href="css/body_background.css?v=<?php echo time(); ?>">
        <link rel="stylesheet" type="text/css" href="css/login.css?v=<?php echo time(); ?>">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css?v=<?php echo time(); ?>">
</head>
<body> 
    
<?php if( !isset($_SESSION['username']) ) { 
    if ( !filter_input(INPUT_POST, 'username')){ //!isset($_POST['username']?>
        <div class="main_container">
		<h1 class="intro_text">Cloup AE</h1>

		<div class="login-form">
		    <form action="" method="post">
		        <h2 class="text-center">Log in</h2>       
		        <div class="form-group">
		            <input type="text" class="form-control"  name="username" placeholder="Username" required="required">
		        </div>
		        <div class="form-group">
		            <input type="password" class="form-control" name="password" placeholder="Password" required="required">
		        </div>
		        <div class="form-group">
		            <button type="submit" class="btn btn-primary btn-block">Log in</button>
		        </div>
		    </form>
		</div>
				            
	</div>
    </body>
    </html>
    <?php } else{ 
        $cred = new Credentials();
        $cred->username = filter_input(INPUT_POST, 'username'); //$_POST['username'];        filter_input(INPUT_POST, 'username');
        $cred->password = filter_input(INPUT_POST, 'password'); //$_POST['password'];
        $cred->verify();
        
        $user = new Ergazomenos();
        $user->setCrypto($cred->kwd_ergazom_cred);
        $user->login();
        
        if($user->kwd_ergazomenou !== -1){
            $_SESSION['username'] = $cred->username;
            $_SESSION['kwd_ergazomenou'] = $cred->kwd_ergazom_cred;
            $_SESSION['Eponymo_ergazom'] = $user->Eponymo_ergazom;
            $_SESSION['Onoma_Ergazom'] = $user->Onoma_Ergazom;
            $_SESSION['Patronymo_Ergazom'] = $user->Patronymo_Ergazom;
            $_SESSION['Fyllo_Ergaz'] = $user->Fyllo_Ergaz;
            $_SESSION['AFM_Ergaz'] = $user->AFM_Ergaz;
            $_SESSION['DOB_Ergazom'] = $user->DOB_Ergazom;
            $_SESSION['Tel_Ergaz'] = $user->Tel_Ergaz;
            $_SESSION['Salary_Ergazom'] = $user->Salary_Ergazom;
            $_SESSION['Kod_tm_ergazom'] = $user->Kod_tm_ergazom;
            $_SESSION['user_type_ergazom'] = $user->user_type_ergazom;
            
            header('Location: index.php');
        }
        else{
            header('Location: index.php');
        }
    }
}
else {
    header('Location: logged_in_page.php');
}

