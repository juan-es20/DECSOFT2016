<?php
session_start();
require_once 'class.student.php';
$student_home = new STUDENT();

if(!$student_home->is_logged_in())
{
	$student_home->redirect('index.php');
}

//muestra informacion de la materia basada en el id, si no tiene id redirecciona al index.php
$subject_id = null;
if (!empty($_GET['subject_id'])) {
	$subject_id = $_REQUEST['subject_id'];
}

if ( null==$subject_id ) {
	header("Location: index.php");
} else {
	$pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT * FROM subjects where subject_id = ?";
	$q = $pdo->prepare($sql);
	$q->execute(array($subject_id));
	$data = $q->fetch(PDO::FETCH_ASSOC);
	Database::disconnect();
}

//usado solo para mostrar la informacion del estudiante en el header
$stmt = $student_home->runQuery("SELECT * FROM students WHERE student_id=:id");
$stmt->execute(array(":id"=>$_SESSION['student_session']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

//usado para confirmar una inscripcion
$confirm = null;
if (!empty($_GET['confirm'])) {
	$confirm = $_REQUEST['confirm'];
}

if (($confirm=="1") && (null!=$subject_id)) {
	$pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "INSERT INTO student_subject (student_id,subject_id) values (?,?)";
	$q = $pdo->prepare($sql);
	$q->execute(array($_SESSION['student_session'],$subject_id));
	Database::disconnect();
	$student_home->redirect('my_subjects.php');
}

include('header.php');
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 col-sm-12">
           <h3 class="text-center">Confirmar Inscripción</h3>
        </div>
    </div>  
     <div class="row">
        <div class="col-xs-12 col-sm-6">
           <label class="control-label">Materia:</label>	
  
        </div>
        <div class="col-xs-12 col-sm-6">
            <label class="control-label">Descripción :</label>	

        </div>
         	
         	
      </div>
      <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6col-lg-6">
            <div class="controls">
			  <p class="">
			    <?php echo $data['subject_name'];?>
			  </p>
			</div>
        </div> 
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <div class="controls">
			    <p class="text-center">
				   <?php echo $data['subject_description'];?>
			    </p>
		    </div>
        </div> 
    </div> 
     <div class="row">
        <div class="col-sm-6">
             <div class="form-actions">
             <label class="checkbox">
			   <a class="btn btn-primary btn-sm pull-right" href="javascript:history.back()">Back</a>
			   </label>
			 </div>
        </div>
        <div class="col-sm-6">
             <div class="controls">
			    <label class="checkbox">
					<?php 
					  echo '<a class="btn btn-sm btn-primary" href="register_to_subject.php?subject_id='.$subject_id.'&confirm=1">Confirmar Inscripción</a>';
					?>
			     </label>
			</div>
        </div>
     </div>

  </div>  

        <script src="../bootstrap/js/jquery-1.9.1.min.js"></script>
        <script src="../bootstrap/js/bootstrap.min.js"></script>
        <script src="../assets/scripts.js"></script>
        
    </body>

</html>