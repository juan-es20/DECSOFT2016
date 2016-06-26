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

include('header1.php');


?>

    <div class="container-gluid">
    		<div class="row">
    			<h3>Administrar Estudiantes</h3>
    		</div>
			<div class="row">
				<p>
					<a href="create.php" class="btn btn-success">Crear</a>&nbsp;
					<a href="import.php" class="btn btn-success">Importar</a>
				</p>
				<div class="table-responsive">
				<table class="table table-striped table-bordered">
		              <thead>
		                <tr class="success">
		                  <th>Nombre</th>
		                  <th>Apellidos</th>
		                  <th>Email</th>
		                  <th>Accion</th>
		                </tr>
		              </thead>
		         
		              <tbody>
		              <?php 
					   $pdo = Database::connect();
					   $sql = 'SELECT * FROM students ORDER BY student_id DESC';
	 				   foreach ($pdo->query($sql) as $row) {
						   		echo '<tr>';
							   	echo '<td>'. $row['student_name'] . '</td>';
							   	echo '<td>'. $row['student_last_name'] . '</td>';
							   	echo '<td>'. $row['student_email'] . '</td>';
							   	echo '<td width=150>';
							   	echo '<a class="btn btn-success btn-sm" href="update.php?id='.$row['student_id'].'">Editar</a>';
							   	echo '&nbsp;';
							   	echo '<a class="btn btn-danger btn-sm" href="delete.php?id='.$row['student_id'].'">Eliminar</a>';
							   	echo '</td>';
							   	echo '</tr>';
					   }
					   Database::disconnect();
					  ?>
				      </tbody>
	            </table>
	          </div>
    	   </div>
      </div> <!-- /container -->
  </div>

 </div>
    
<!-- Scripts -->
     <script src="../../bootstrapp/js/jquery.min.js"></script>
    <script src="../../bootstrapp/js/bootstrap.min.js"></script>
     <script src="../../bootstrapp/js/metisMenu.min.js"></script>
    <script src="../../bootstrapp/js/sb-admin-2.js"></script>

  </body>
</html>