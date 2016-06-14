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

include('header.php');

?>

        <div class="container">
          <table class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>Materia</th>
                <th>Descripción</th>
                <th>Estado</th>
                <th>Acción</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $pdo = Database::connect();

              $sql = 'SELECT subject_id,status FROM student_subject where student_id='.$_SESSION['student_session'];
              foreach ($pdo->query($sql) as $ss_row) {
                  $sql2 = 'SELECT * FROM subjects where subject_id='.$ss_row['subject_id'];
                  foreach ($pdo->query($sql2) as $row) {
                    if ($ss_row['status'] == 'Y') {
                        $ss_status = 'Habilitado';
                    } else {
                        $ss_status = 'Deshabilitado';
                    }
                    echo '<tr>';
                    echo '<td>'. $row['subject_name'] . '</td>';
                    echo '<td>'. $row['subject_description'] . '</td>';
                    echo '<td>'. $ss_status . '</td>';
                    echo '<td width=150>';
                    echo '<a class="btn" href="list_exams.php?subject_id='.$row['subject_id'].'">Mostrar Examenes</a>';
                    echo '</tr>';
                  }
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