<?php
session_start();
require_once 'class.teacher.php';
$teacher = new TEACHER();

if(!$teacher->is_logged_in())
{
	$teacher->redirect('index.php');
}

if($teacher->is_logged_in()!="")
{
	$teacher->logout();	
	$teacher->redirect('index.php');
}
?>