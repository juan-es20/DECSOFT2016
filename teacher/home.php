<?php
session_start();
require_once 'class.teacher.php';
$teacher_home = new TEACHER();

if(!$teacher_home->is_logged_in())
{
	$teacher_home->redirect('/index.php');
}

$stmt = $teacher_home->runQuery("SELECT * FROM teachers WHERE teacher_id=:id");
$stmt->execute(array(":id"=>$_SESSION['teacher_session']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

include('header1.php');
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