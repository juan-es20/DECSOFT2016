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


if (isset($_POST['submit'])) {
	if (is_uploaded_file($_FILES['csv']['tmp_name'])) {
	    $file = $_FILES['csv']['tmp_name']; 
	    $handle = fopen($file,"r"); 
	    $pdo = Database::connect();
	    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		do {
			if ($data[0]) {
				$sql = "INSERT INTO students (student_name,student_last_name,student_email,student_pass) values(?, ?, ?, ?)";
				$q = $pdo->prepare($sql);

				$q->execute(array(addslashes($data[0]),addslashes($data[1]),addslashes($data[2]),'123'));
			}
		} while ($data = fgetcsv($handle,1000,","));
		    header('Location: index.php'); die; 
		}
	}
?>



    <div class="container">
    
    			<div class="span10 offset1">
    				<div class="row">
		    			<h3>Crear Estudiante</h3>
		    		</div>
    		
	    			<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
					  <div class="control-group">
					    <label class="control-label">Seleccione un archivo</label>
					    <div class="controls">
					      	<input id="csv" name="csv" type="file" placeholder="archivo.csv">
					    </div>
					  </div>
					  <div class="form-actions">
						  <button type="submit" name="submit" value="submit" class="btn btn-success">Importar</button>
						  <a class="btn" href="index.php">Volver</a>
						</div>
					</form>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>