<?php
session_start();
require_once '../class.teacher.php';
$teacher_home = new TEACHER();

if(!$teacher_home->is_logged_in())
{
	$teacher_home->redirect('index.php');
}

$stmt = $teacher_home->runQuery("SELECT * FROM teachers WHERE teacher_id=:id");
$stmt->execute(array(":id"=>$_SESSION['teacher_session']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

include('header.php');

	if ( !empty($_POST)) {
		// keep track validation errors
		$nameError = null;
		$last_nameError = null;
		$emailError = null;
		$mobileError = null;
		
		// keep track post values
		$name = $_POST['name'];
		$last_name = $_POST['last_name'];
		$email = $_POST['email'];
		
		// validate input
		$valid = true;
		if (empty($name)) {
			$nameError = 'Por favor ingrese un nombre';
			$valid = false;
		}
		$valid = true;
		if (empty($last_name)) {
			$last_nameError = 'Por favor ingrese un apellido';
			$valid = false;
		}
		
		if (empty($email)) {
			$emailError = 'Por favor ingrese un Email';
			$valid = false;
		} else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
			$emailError = 'Por favor ingrese un Email valido';
			$valid = false;
		}
		
		// insert data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO students (student_name,student_last_name,student_email,student_pass) values(?, ?, ?, ?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($name,$last_name,$email,'123'));
			Database::disconnect();
			header("Location: index.php");
		}
	}
?>


    <div class="container">
    
    			<div class="span10 offset1">
    				<div class="row">
		    			<h3>Crear Estudiante</h3>
		    		</div>
    		
	    			<form class="form-horizontal" action="create.php" method="post">
					  <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
					    <label class="control-label">Nombre</label>
					    <div class="controls">
					      	<input name="name" type="text"  placeholder="Nombre" value="<?php echo !empty($name)?$name:'';?>">
					      	<?php if (!empty($nameError)): ?>
					      		<span class="help-inline"><?php echo $nameError;?></span>
					      	<?php endif; ?>
					    </div>
					  </div>
					  <div class="control-group <?php echo !empty($last_nameError)?'error':'';?>">
					    <label class="control-label">Apellido</label>
					    <div class="controls">
					      	<input name="last_name" type="text"  placeholder="Apellido" value="<?php echo !empty($last_name)?$last_name:'';?>">
					      	<?php if (!empty($last_nameError)): ?>
					      		<span class="help-inline"><?php echo $last_nameError;?></span>
					      	<?php endif; ?>
					    </div>
					  </div>
					  <div class="control-group <?php echo !empty($emailError)?'error':'';?>">
					    <label class="control-label">Email</label>
					    <div class="controls">
					      	<input name="email" type="text" placeholder="Email" value="<?php echo !empty($email)?$email:'';?>">
					      	<?php if (!empty($emailError)): ?>
					      		<span class="help-inline"><?php echo $emailError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  <div class="form-actions">
						  <button type="submit" class="btn btn-success">Crear</button>
						  <a class="btn" href="index.php">Volver</a>
						</div>
					</form>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>