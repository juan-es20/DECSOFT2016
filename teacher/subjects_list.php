<?php
session_start();
require_once 'class.teacher.php';
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
          <table class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>Materia</th>
                <th>Descripción</th>
                <th>Acción</th>
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
                echo '<td width=85>';
                //echo '<a class="btn" href="register_to_subject.php?subject_id='.$row['subject_id'].'">Administrar</a>';
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