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

if(isset($_POST['btn-login']))
{
    $clave = trim($_POST['clave']);
   // $pass = trim($_POST['txtpass']);
    
    $pdo=Database::connect();
    $sql = "SELECT * FROM subjects where subject_id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($subject_id));
    $data = $q->fetch(PDO::FETCH_ASSOC);

         if ($data['clave']==$clave) {
            $pdo = Database::connect();
             $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
             $sql = "INSERT INTO student_subject (student_id,subject_id) values (?,?)";
             $q = $pdo->prepare($sql);
             $q->execute(array($_SESSION['student_session'],$subject_id));
              Database::disconnect();
             $student_home->redirect('my_subjects.php');
             }
}

include('header.php');
?>

<div class="container well" id="sha">
  <form class="logueo" method="POST">
       
        <div class="row">
        <div class="col-sm-12">
           <h3 class="text-center">Confirmar Inscripción</h3>
        </div>
        </div>
      <div class="form-group">
        <p>
             Materia: <?php echo $data['subject_name'];?>
        </p>
                 
      </div>
      <div class="form-group">
        <p>
              Descripcion: <?php echo $data['subject_description'];?>
        </p>

      </div>
      <div>
         <p> clave de acceso: <input type="text" class="form-control" placeholder="clave de inscripcion" name="clave" id="clave" requerid autofocus>
         </p>
      </div>
    <div class="row">
        <a class="btn btn-primary btn-sm pull-right" href="javascript:history.back()">Back</a>
      
      <button class="btn btn-primary btn-sm" type="submit" name="btn-login">confirmar suscripcion</button>
    </div>
      
  </form>
</div>
        <link  rel="stylesheet" type="text/css" href="../bootstrapp/css/cssAux.css">
        <script src="../bootstrap/js/jquery-1.9.1.min.js"></script>
        <script src="../bootstrap/js/bootstrap.min.js"></script>
        <script src="../assets/scripts.js"></script>
        
    </body>

</html>