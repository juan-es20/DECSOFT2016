<?php
session_start();

require_once '/class.teacher.php';
$teacher_login = new TEACHER();
if($teacher_login->is_logged_in()!="")
{
	$teacher_login->redirect('home.php');
}
if(isset($_POST['btn-login']))
{
	$email = trim($_POST['txtemail']);
	$pass = trim($_POST['txtpass']);
	
	if($teacher_login->login($email,$pass))
	{
		$teacher_login->redirect('home.php');
	}
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>Evaluacion en Linea</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" type="text/css" href="../bootstrapp/css/bootstrap.css">
    <link href="../assets/styles.css" rel="stylesheet" media="screen">
    <link  rel="stylesheet" type="text/css" href="../bootstrapp/css/cssAux.css">

  </head>
  <body >
    <div class="container well" id="sha">
		<?php 
		if(isset($_GET['inactive']))
		{
			?>
            <div class='alert alert-error'>
				<button class='close' data-dismiss='alert'>&times;</button>
				<strong>Sorry!</strong> This Account is not Activated Go to your Inbox and Activate it. 
			</div>
            <?php
		}
		?>
        <form class="logueo" method="POST">
        <?php
        if(isset($_GET['error']))
		{
			?>
            <div class='alert alert-success'>
				<button class='close' data-dismiss='alert'>&times;</button>
				<strong>Wrong Details!</strong> 
			</div>
            <?php
		}
		?>
        <div class="row">
      <div class="col-xs-12">
        <img src="../bootstrapp/img/login.png" class="img-responsive" id="login">
      </div>
    </div>
      <div class="form-group">
        <input type="email" class="form-control" placeholder="correo electronico" name="txtemail" requerid autofocus>
                 
      </div>
      <div class="form-group">
        <input type="password" class="form-control" placeholder="contraseña" name="txtpass" required>

      </div>
      <button class="btn btn-primary" type="submit" name="btn-login">iniciar sesion</button>
      
      </form>

    </div> <!-- /container -->
    <script src="../bootstrapp/js/jquery-1.11.1.min.js"></script>
  <script src="../bootstrapp/js/bootstrap.js"></script>
  </body>
</html>