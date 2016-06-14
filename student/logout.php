<?php
session_start();
require_once 'class.student.php';
$student = new STUDENT();

if(!$student->is_logged_in())
{
	$student->redirect('index.php');
}

if($student->is_logged_in()!="")
{
	$student->logout();	
	$student->redirect('index.php');
}
?>