<?php
session_start();
require_once 'class.student.php';

$reg_student = new STUDENT();

if($reg_student->is_logged_in()!="")
{
	$reg_student->redirect('home.php');
}


if(isset($_POST['btn-signup']))
{
	$name = trim($_POST['txtname']);
	$lastname = trim($_POST['txtlastname']);
	$email = trim($_POST['txtemail']);
	$upass = trim($_POST['txtpass']);
	$code = md5(uniqid(rand()));
	
	//verificamos que no existe el usuario
	$stmt = $reg_student->runQuery("SELECT * FROM students WHERE student_email=:email_id");
	$stmt->execute(array(":email_id"=>$email));
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	
	if($stmt->rowCount() > 0)
	{
		if(strlen($upass) < 6){
			if($reg_student->comprobar_nombre_usuario($name) and $reg_student->comprobar_nombre_usuario($lastname){
		       $msg = "
		           <div class='alert alert-error'>
				  <button class='close' data-dismiss='alert'>&times;</button>
					<strong>Sorry !</strong>  ya existe un usuario con ese email y longitud de password tiene que ser mas de 6 caracteres , por favor ingrese otro email
			      </div>
			     ";
			}else{
				 $msg = "
		         <div class='alert alert-error'>
				  <button class='close' data-dismiss='alert'>&times;</button>
					<strong>Sorry !</strong>  ya existe un usuario con ese email y longitud de password tiene que ser mas de 6 caracteres verifique el nombre y apellido, por favor ingrese otro email los nombre y apellido tienen que ser caracteres o numeros validos
			    </div>
			   ";
			}
		 }else{

		 $msg = "
		      <div class='alert alert-error'>
				<button class='close' data-dismiss='alert'>&times;</button>
					<strong>Sorry !</strong>  ya existe un usuario con ese email , por favor ingrese otro email
			  </div>
			  ";	
		 }
	}
	else
	{
		if($reg_student->register($name,$lastname,$email,$upass,$code))
		{			
			$id = $reg_student->lasdID();		
			$key = base64_encode($id);
			$id = $key;
			
			$message = "					
						Hello $name,
						<br /><br />
						Bienvenido a TIS!<br/>
						para completar tu registro por favor haz click en el siguiente link<br/>
						<br /><br />
						<a href='http://localhost/xxxxxx/verify.php?id=$id&code=$code'>Click AQUI para activar tu cuenta</a>
						<br /><br />
						Thanks,";
						
			$subject = "Confirmar Registro";
						
			$reg_student->send_mail($email,$message,$subject);	
			$msg = "
					<div class='alert alert-success'>
						<button class='close' data-dismiss='alert'>&times;</button>
						<strong>Success!</strong>  Hemos enviado un email a $email.
                    Por favor has click en el link de confirmacion en el email para completar tu registro. 
			  		</div>
					";
		}
		else
		{
			echo "sorry , Query could no execute...";
		}		
	}
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>TIS</title>
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
				<?php if(isset($msg)) echo $msg;  ?>
      <form class="form-signin" method="post">
        <h2 class="form-signin-heading">Sign Up</h2><hr />
        <input type="text" class="input-block-level" placeholder="Nombre" name="txtname" required />
        <input type="text" class="input-block-level" placeholder="Apellido" name="txtlastname" required />
        <input type="email" class="input-block-level" placeholder="Email" name="txtemail" required />
        <input type="password" class="input-block-level" placeholder="Password" name="txtpass" required />
     	<hr />
        <button class="btn btn-large btn-primary" type="submit" name="btn-signup">Sign Up</button>
        <a href="index.php" style="float:right;" class="btn btn-large">Sign In</a>
      </form>

    </div> <!-- /container -->
    <script src="vendors/jquery-1.9.1.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>