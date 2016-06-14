<?php
session_start();

require_once '/class.student.php';
$student_login = new STUDENT();
if($student_login->is_logged_in()!="")
{
	$student_login->redirect('home.php');
}
if(isset($_POST['btn-login']))
{
	$email = trim($_POST['txtemail']);
	$pass = trim($_POST['txtpass']);
	
	if($student_login->login($email,$pass))
	{
		$student_login->redirect('home.php');
	}
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Login | Coding Cage</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" type="text/css" href="../bootstrapp/css/bootstrap.css">
    <link href="../assets/styles.css" rel="stylesheet" media="screen">
    <style>
      body{
        padding-top: 40px;
        padding-bottom: 40px;
      }
      .logueo{
         max-width: 300px;
         padding: 20px;
         margin: 0 auto;
      }
      #sha{
        max-width: 300px;
        -webkit -box-shadow: 0px 0px 20px 0px rgba(60,62,62,0,60);
        -moz -box-shadow: 0px 0px 20px 0px rgba(60,62,62,0,60);
        box-shadow: 0px 0px 20px 0px rgba(60,62,62,0,60);
        border-radius:6%;
      }
      #login{
        width: 150px;
        height: 150px;
        margin: 0px auto 10px;
        display: block;
        border-radius: 80%;
      }
  </style>
  </head>
<body>
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
      <div class="checkbox">
       
          <p>¿no tienes una cuenta? </p><p class="help-block"><a href="signup.php">cree una.</a></p></p>
          <p class="help-block"><a href="fpass.php">He olvidado mi contraseña</a></p>
    
      </div>

    </form>

    </div> <!-- /container -->
    <script src="../bootstrapp/js/jquery-1.11.1.min.js"></script>
  <script src="../bootstrapp/js/bootstrap.js"></script>


</body>
</html>