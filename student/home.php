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
</div>

    </div>
    
<!-- Scripts -->
     <script src="../bootstrapp/js/jquery.min.js"></script>
    <script src="../bootstrapp/js/bootstrap.min.js"></script>
     <script src="../bootstrapp/js/metisMenu.min.js"></script>
    <script src="../bootstrapp/js/sb-admin-2.js"></script>

</body>

</html>