<?php

require_once '../database.php';

class STUDENT
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
	
	public function register($name,$lastname,$email,$pass,$code)
	{
		try
		{							
			$password = md5($pass);
			$stmt = $this->conn->prepare("INSERT INTO students(student_name,student_last_name,student_email,student_pass,tokenCode)
								VALUES(:student_name, :student_last_name, :student_email, :student_pass, :active_code)");
			$stmt->bindparam(":student_name",$name);
			$stmt->bindparam(":student_last_name",$lastname);
			$stmt->bindparam(":student_email",$email);
			$stmt->bindparam(":student_pass",$password);
			$stmt->bindparam(":active_code",$code);
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
			$stmt = $this->conn->prepare("SELECT * FROM students WHERE student_email=:email_id");
			$stmt->execute(array(":email_id"=>$email));
			$studentRow=$stmt->fetch(PDO::FETCH_ASSOC);

			if($stmt->rowCount() == 1)
			{
				if($studentRow['student_status']=="Y")
				{
					if($studentRow['student_pass']==md5($pass))
					{
						$_SESSION['student_session'] = $studentRow['student_id'];
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
					header("Location: index.php?inactive");
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
		if(isset($_SESSION['student_session']))
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
		$_SESSION['student_session'] = false;
	}
	
	function send_mail($email,$message,$subject)
	{						
		require_once('../mailer/class.phpmailer.php');
		$mail = new PHPMailer();
		$mail->IsSMTP(); 
		$mail->SMTPDebug  = 0;                     
		$mail->SMTPAuth   = true;                  
		$mail->SMTPSecure = "ssl";                 
		$mail->Host       = "smtp.gmail.com";      
		$mail->Port       = 465;             
		$mail->AddAddress($email);
		$mail->Username="tasmailuser@gmail.com";  
		$mail->Password="Control123";            
		$mail->SetFrom('tasmailuser@gmail.com','TIS');
		$mail->AddReplyTo("tasmailuser@gmail.com","TIS");
		$mail->Subject    = $subject;
		$mail->MsgHTML($message);
		$mail->Send();
	}	

   public function comprobar_nombre_usuario($nombre_usuario){ 
     if (ereg("^[a-zA-Z0-9\-_]{3,20}$", $nombre_usuario)) { 
      //echo "El nombre de usuario $nombre_usuario es correcto<br>"; 
      return true; 
     } else { 
       //echo "El nombre de usuario $nombre_usuario no es válido<br>"; 
      return false; 
     } 
  }
}