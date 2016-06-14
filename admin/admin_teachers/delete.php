<?php 
	require '../../database.php';
	include('header.php');
	$id = 0;
	
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}
	
	if ( !empty($_POST)) {
		// keep track post values
		$id = $_POST['id'];
		
		// delete data
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "DELETE FROM teachers  WHERE teacher_id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		Database::disconnect();
		header("Location: index.php");
		
	} 
?>

    <div class="container">
    			<br><br><br><br><br>
    			<div class="span10 offset1">
    				<div class="row">
		    			<h3>Eliminar cuenta</h3>
		    		</div>
		    		
	    			<form class="form-horizontal" action="delete.php" method="post">
	    			  <input type="hidden" name="id" value="<?php echo $id;?>"/>
	    			  <br><br>
					  <p class="alert alert-error">Seguro de eliminar la cuenta ?</p>
					  <div class="form-actions">
					   <br><br>
						  <button type="submit" class="btn btn-danger">Si</button>
						  <a class="btn" href="index.php">No</a>
						</div>
					</form>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>