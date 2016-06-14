<?php
session_start();
require_once 'class.student.php';
$student_home = new STUDENT();

if(!$student_home->is_logged_in())
{
	$student_home->redirect('index.php');
}

$stmt = $student_home->runQuery("SELECT * FROM students WHERE student_id=:id");
$stmt->execute(array(":id"=>$_SESSION['student_session']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

include('header1.php');
$id = $_SESSION['student_session'];

	
	if (!empty($_POST)) {
		// keep track validation errors
		$nameError = null;
		$last_nameError = null;
		$emailError = null;
		
		// keep track post values
		$name = $_POST['name'];
		$last_name = $_POST['last_name'];
		$email = $_POST['email'];

		
		// validate input
		$valid = true;
		if (empty($name)) {
			$nameError = 'Porfavor inserte nombre';
			$valid = false;
		}
		if (empty($last_name)) {
			$last_nameError = 'Porfavor inserte apellido';
			$valid = false;
		}

		// update data

		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE students set student_name = ?, student_last_name =? WHERE student_id = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($name,$last_name,$id));
			Database::disconnect();
			header("Location: index.php");
		}
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM students where student_id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		$name = $data['student_name'];
		$last_name = $data['student_last_name'];
		$email = $data['student_email'];
		Database::disconnect();
	}

?>


    <div class="container">	
    			<div class="span10 offset1">
    				<div class="row">
		    			<h3>Editar Usuario</h3>
		    		</div>
		    		<br><br>
	    			<form class="form-horizontal" action="update.php?id=<?php echo $id?>" method="post">
					  <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
					    <label class="control-label">Nombre</label>
					    <div class="controls">
					      	<input name="name" type="text"  placeholder="Nombre" value="<?php echo !empty($name)?$name:'';?>">
					      	<?php if (!empty($nameError)): ?>
					      		<span class="help-inline"><?php echo $nameError;?></span>
					      	<?php endif; ?>
					    </div>
					  </div>
					  <br><br>
					  <div class="control-group <?php echo !empty($last_nameError)?'error':'';?>">
					    <label class="control-label">Apellido</label>
					    <div class="controls">
					      	<input name="last_name" type="text"  placeholder="Apellido" value="<?php echo !empty($last_name)?$last_name:'';?>">
					      	<?php if (!empty($last_nameError)): ?>
					      		<span class="help-inline"><?php echo $last_nameError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  <br><br>
					  <div class="control-group <?php echo !empty($emailError)?'error':'';?>">
					    <label class="control-label">Email</label>
					    <div class="controls">
					      	<input name="email" type="text" placeholder="Email " value="<?php echo !empty($email)?$email:'';?>" disabled>
					      	<?php if (!empty($emailError)): ?>
					      		<span class="help-inline"><?php echo $emailError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  
					  <div class="form-actions">
					      <br><br>
						  <button type="submit" class="btn btn-success">Aceptar</button>
						  <a class="btn" href="index.php">Atras</a>
						</div>
					</form>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>