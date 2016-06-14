<?php 
include '../../database.php';
include('header.php');
?>
    <div class="container">
    		<div class="row">
    			<h3>Administrar Docentes</h3>
    		</div>
			<div class="row">
				<p>
					<a href="create.php" class="btn btn-success">Crear</a>
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
					   $sql = 'SELECT * FROM teachers ORDER BY teacher_id DESC';
	 				   foreach ($pdo->query($sql) as $row) {
						   		echo '<tr>';
							   	echo '<td>'. $row['teacher_name'] . '</td>';
							   	echo '<td>'. $row['teacher_last_name'] . '</td>';
							   	echo '<td>'. $row['teacher_email'] . '</td>';
							   	echo '<td width=150>';
							   	echo '<a class="btn btn-success" href="update.php?id='.$row['teacher_id'].'">Editar</a>';
							   	echo '&nbsp;';
							   	echo '<a class="btn btn-danger" href="delete.php?id='.$row['teacher_id'].'">Eliminar</a>';
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