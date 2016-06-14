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


?>

    <div class="container">
    		<div class="row">
    			<h3>Administrar Estudiantes</h3>
    		</div>
			<div class="row">
				<p>
					<a href="create.php" class="btn btn-success">Crear</a>&nbsp;
					<a href="import.php" class="btn btn-success">Importar</a>
				</p>
				
				<table class="table table-striped table-bordered">
		              <thead>
		                <tr>
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
							   	echo '<a class="btn btn-success" href="update.php?id='.$row['student_id'].'">Editar</a>';
							   	echo '&nbsp;';
							   	echo '<a class="btn btn-danger" href="delete.php?id='.$row['student_id'].'">Eliminar</a>';
							   	echo '</td>';
							   	echo '</tr>';
					   }
					   Database::disconnect();
					  ?>
				      </tbody>
	            </table>
    	</div>
    </div> <!-- /container -->
  </body>
</html>