<?php

require_once '../database.php';

class TEACHER
{	

	private $conn;
	
	public function __construct()
	{
		$database = new Database();
		$db = $database->connect();
		$this->conn = $db;
    }
	
	public function runQuery($sql)
	{
		$stmt = $this->conn->prepare($sql);
		return $stmt;
	}
	
	public function lasdID()
	{
		$stmt = $this->conn->lastInsertId();
		return $stmt;
	}
	
	public function register($name,$lastname,$email,$pass)
	{
		try
		{							
			$password = md5($pass);
			$stmt = $this->conn->prepare("INSERT INTO teachers(teacher_name,teacher_last_name,teacher_email,teacher_pass)
								VALUES(:teacher_name, :teacher_last_name, :teacher_email, :teacher_pass)");
			$stmt->bindparam(":teacher_name",$name);
			$stmt->bindparam(":teacher_last_name",$lastname);
			$stmt->bindparam(":teacher_email",$email);
			$stmt->bindparam(":teacher_pass",$password);
			$stmt->execute();
			return $stmt;
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}
	
	public function login($email,$pass)
	{
		try
		{
			$stmt = $this->conn->prepare("SELECT * FROM teachers WHERE teacher_email=:email_id");
			$stmt->execute(array(":email_id"=>$email));
			$teacherRow=$stmt->fetch(PDO::FETCH_ASSOC);

			if($stmt->rowCount() == 1)
			{
				if($teacherRow['teacher_pass']==md5($pass))
				{
					$_SESSION['teacher_session'] = $teacherRow['teacher_id'];
					return true;
				}
				else
				{
					header("Location: index.php?error");
					exit;
				}
			}
			else
			{
				header("Location: index.php?error");
				exit;
			}		
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}
	
	
	public function is_logged_in()
	{
		if(isset($_SESSION['teacher_session']))
		{
			return true;
		}
	}
	
	public function redirect($url)
	{
		header("Location: $url");
	}
	
	public function logout()
	{
		session_destroy();
		$_SESSION['teacher_session'] = false;
	}
}