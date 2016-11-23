<?php

require_once 'dbconfig.php';
require_once 'includes/PHPMailer/PHPMailerAutoload.php';

class USER
{

	private $conn;
	
	public function __construct()
	{
		$database = new Database();
		$db = $database->dbConnection();
		$this->conn = $db;
	}
	
	public function runQuery($sql)
	{
		$stmt = $this->conn->prepare($sql); //also quotes, and prepares for SQL injection, saves me the trouble of using mysqli_real_escape_string everywhere
		return $stmt;
	}
	
	public function lasdID()
	{
		$stmt = $this->conn->lastInsertId();
		return $stmt;
	}
	
	public function register($uname,$email,$upass,$code,$fullname,$rollno,$instname)
	{
		try
		{							
			$password = md5($upass);
			$stmt = $this->conn->prepare("INSERT INTO tbl_users(instID,userName,fullName,userEmail,userPass,instName,tokenCode) 
														 VALUES(:inst_id, :user_name, :full_name, :user_mail, :user_pass,:inst_name, :active_code)");
			$stmt->bindparam(":inst_id",$rollno);
			$stmt->bindparam(":user_name",$uname);
			$stmt->bindparam(":full_name",$fullname);
			$stmt->bindparam(":user_mail",$email);
			$stmt->bindparam(":user_pass",$password);
			$stmt->bindparam(":inst_name",$instname);
			$stmt->bindparam(":active_code",$code);			
			$stmt->execute();	
			return $stmt;
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}
	
	public function login($email,$upass)
	{
		try
		{
			$stmt = $this->conn->prepare("SELECT * FROM tbl_users WHERE userEmail=:email_id OR userName=:email_id");
			$stmt->execute(array(":email_id"=>$email));
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
			
			if($stmt->rowCount() == 1)
			{
				if($userRow['userStatus']>0)
				{
					if($userRow['userPass']==md5($upass))
					{
						$_SESSION['userSession'] = $userRow['userID'];
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
		if(isset($_SESSION['userSession']))
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
		$_SESSION['userSession'] = false;
	}
	
	function send_mail($email,$message,$subject)
	{						
		require_once('includes/PHPMailer/class.phpmailer.php');
		$mail = new PHPMailer();
		$mail->IsSMTP(); 
		$mail->SMTPDebug  = 0;					 
		$mail->SMTPAuth   = true;				  
		$mail->SMTPSecure = "tls";				 
		$mail->Host	   = "imap.cse.iitb.ac.in";	  
		$mail->Port	   = 25;			 
		$mail->AddAddress($email);
		$mail->Username="iitbplusplusserver";  
		$mail->Password="iitb1016";			
		$mail->SetFrom('iitbplusplusserver@cse.iitb.ac.in','No Reply-IITBPlus+');
		$mail->AddReplyTo("iitbplusplusserver@cse.iitb.ac.in","No Reply-IITBPlus+");
		$mail->Subject = $subject;
		$mail->MsgHTML($message);
		$mail->Send();
	}	
}
