<?php
session_start();
require_once 'class.student.php';
$user_home = new STUDENT();

if(!$user_home->is_logged_in())
{
	$user_home->redirect('index.php');
}

$stmt = $user_home->runQuery("SELECT * FROM students WHERE student_id=:id");
$stmt->execute(array(":id"=>$_SESSION['student_session']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html class="no-js">
    
    <head>
        <title><?php echo $row['student_email']; ?></title>
        <!-- Bootstrap -->
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="../bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
        <link href="../assets/styles.css" rel="stylesheet" media="screen">
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        
    </head>
    
    <body>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                    </a>
                    <a class="brand" href="#">Evaluacion en Linea</a>
                    <div class="nav-collapse collapse">
                        <ul class="nav pull-right">
                            <li class="dropdown">
                                <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-user"></i> 
								<?php echo $row['student_email']; ?> <i class="caret"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a tabindex="-1" href="logout.php">Logout</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <ul class="nav">
                            <li class="active">
                                <a href="http://localhost/tis_system/student/home.php">Inicio</a>
                            </li>
                            <li class="active">
                                <a href="http://localhost/tis_system/student/subjects_list.php">Mis Cursos</a>
                            </li>
                            <li class="dropdown">
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle">Lista de Cursos <b class="caret"></b>

                                </a>
                                <ul class="dropdown-menu" id="menu1">
                                    <li><a href="http://localhost/tis_system/student/my_subjects.php"">Mostrar</a></li>

                                </ul>
                            </li>
                            
                            
                        </ul>
                    </div>
                    <!--/.nav-collapse -->
                </div>
            </div>
        </div>
        
        <!--/.fluid-container-->

        <div class="container">
          <table class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $pdo = Database::connect();
              $sql = 'SELECT * FROM subjects ORDER BY subject_id DESC';
              foreach ($pdo->query($sql) as $row) {
                echo '<tr>';
                echo '<td>'. $row['subject_name'] . '</td>';
                echo '<td>'. $row['subject_description'] . '</td>';
                echo '<td width=250>';
                echo '<a class="btn" href="read.php?id='.$row['subject_id'].'">Detalles</a>';
                echo '&nbsp;';
                echo '<a class="btn btn-success" href="update.php?id='.$row['subject_id'].'">Editar</a>';
                echo '&nbsp;';
                echo '<a class="btn btn-danger" href="delete.php?id='.$row['subject_id'].'">Eliminar</a>';
                echo '</td>';
                echo '</tr>';
              }
              
              ?>
            </tbody>
          </table>
        </div>

        <script src="../bootstrap/js/jquery-1.9.1.min.js"></script>
        <script src="../bootstrap/js/bootstrap.min.js"></script>
        <script src="../assets/scripts.js"></script>
        
    </body>

</html>