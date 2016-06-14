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
<html>
  <head>
    <title>Evaluacion en Linea</title>
    <!-- Bootstrap -->
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="../bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
    <link href="../assets/styles.css" rel="stylesheet" media="screen">
     <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
  </head>
  <body id="login">
    <div class="container">
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
        <form class="form-signin" method="post">
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
        <h2 class="form-signin-heading">Iniciar Sesion.</h2><hr />
        <input type="email" class="input-block-level" placeholder="Email address" name="txtemail" required />
        <input type="password" class="input-block-level" placeholder="Password" name="txtpass" required />
     	<hr />
        <button class="btn btn-large btn-primary" type="submit" name="btn-login">Iniciar Sesion</button>
      <hr />
      </form>

    </div> <!-- /container -->
    <script src="../bootstrap/js/jquery-1.9.1.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>