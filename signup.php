<?php
session_start();
require_once 'class.user.php';

$reg_user = new USER();

if($reg_user->is_logged_in()!="")
{
	$reg_user->redirect('home.php');
}


if(isset($_POST['btn-signup']))
{
	$uname = trim($_POST['txtuname']);
	$email = trim($_POST['txtemail']);
	$upass = trim($_POST['txtpass']);
	$stat  = trim($_POST['status']);
	$fullname = trim($_POST['txtfullname']);
	$rollno = trim($_POST['txtrollno']);
	$instname = trim($_POST['schoolname']);
	$code = md5(uniqid(rand()));
	
	$stmt = $reg_user->runQuery("SELECT * FROM tbl_users WHERE userEmail=:email_id");
	$stmt->execute(array(":email_id"=>$email));
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	
	if($stmt->rowCount() > 0)
	{
		$msg = "
			  <div class='alert alert-error'>
				<button class='close' data-dismiss='alert'>&times;</button>
					<strong>Sorry !</strong>  email allready exists , Please Try another one
			  </div>
			  ";
	}
	else
	{
		if($reg_user->register($uname,$email,$upass,$code,$fullname,$rollno,$instname))
		{			
			$id = $reg_user->lasdID();		
			$key = base64_encode($id);
			$id = $key;
			
			$message = "					
						Hello $uname,
						<br /><br />
						Welcome to IITBPlus+!<br/>
						To complete your registration  please , just click following link<br/>
						<br /><br />
						<a href='http://www.cfilt.iitb.ac.in/iitbplus/verify.php?id=$id&code=$code&status=$stat'>Click HERE to Activate :)</a>
						<br /><br />
						Thanks,";
						
			$subject = "Confirm Registration";
						
			$reg_user->send_mail($email,$message,$subject);	
			$msg = "
					<div class='alert alert-success'>
						<button class='close' data-dismiss='alert'>&times;</button>
						<strong>Success!</strong>  We've sent an email to $email.
					Please click on the confirmation link in the email to create your account. 
			  		</div>
					";
		}
		else
		{
			echo "sorry , Query could no execute...";
		}		
	}
}
?>
<!DOCTYPE html>
<html>
  <head>
	<title>Signup</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
	<link href="bootstrap/css/bootstrap-select.min.css" rel="stylesheet" media="screen">
	<link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
	<link href="assets/styles.css" rel="stylesheet" media="screen">
	<script src="bootstrap/js/modernizr-2.6.2-respond-1.1.0.min.js"></script>
	<script src="bootstrap/js/jquery-1.9.1.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
		<script src="bootstrap/js/bootstrap-select.min.js"></script>
  </head>
  <body id="login">
	  <?php include 'header.php' ?>
	<div class="container">
				<?php if(isset($msg)) echo $msg;  ?>
	  <form class="form-signin" method="post">
		<h2 class="form-signin-heading">Sign Up</h2><hr />
		<input type="text" class="form-control input-lg" placeholder="Full Name" name="txtfullname" required />
		<input type="text" class="form-control input-lg" placeholder="Roll Number" name="txtrollno" required />
		<input type="text" class="form-control input-lg" placeholder="Institute" name="schoolname" required />		 
		<input type="text" class="form-control input-lg" placeholder="Username" name="txtuname" required />
		<input type="email" class="form-control input-lg" placeholder="Email address" name="txtemail" required />
		<input type="password" class="form-control input-lg" placeholder="Password" name="txtpass" required />
		<select name="status" class="form-control input-lg selectpicker" required>
			<option value="1">Student</option>
			<option value="8">Faculty</option>
		</select>
	 	<hr />
		<button class="btn btn-lg btn-primary" type="submit" name="btn-signup">Sign Up</button>
		<a href="index.php" style="float:right;" class="btn btn-default btn-lg">Sign In</a>
	  </form>

	</div>

  </body>
  	  <?php include 'footer.php' ?>

</html>
