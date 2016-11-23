<?php 
$filename = __FILE__;
?>
<?php

session_start();
require_once 'class.user.php';
$user_home = new USER();

if(!$user_home->is_logged_in())
{
	$user_home->redirect('index.php');
}

$stmt = $user_home->runQuery("SELECT * FROM tbl_users WHERE userID=:uid");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$userID = $row['userID'];
$userStatus = $row['userStatus'];

?>

<!DOCTYPE html>
<html class="no-js">
	
	<head>
		<title>IIT-B Plus+</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
		<link href="bootstrap/css/bootstrap-select.min.css" rel="stylesheet" media="screen">
		<link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
		<link rel="stylesheet" href="bootstrap/css/bootstrap-datepicker.min.css" />
		<link rel="stylesheet" href="bootstrap/css/bootstrap-datepicker3.min.css" />
		<link href="assets/styles.css" rel="stylesheet" media="screen">

		<script src="bootstrap/js/modernizr-2.6.2-respond-1.1.0.min.js"></script>
		<script src="bootstrap/js/jquery-1.9.1.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
		<script src="bootstrap/js/bootstrap-select.min.js"></script>
		<script src="assets/scripts.js"></script>
		<script src="bootstrap/js/bootstrap-datepicker.min.js"></script>
		<script>
			function populateCourseInfo(){
				$('#courseInfo').html('<b>Please wait . . . </b>');
				var xmlhttp;
				var courseID = $('#courseID').val();
				//alert(courseID);
				if(courseID == ""){
					$('#courseInfo').html('<h3>Please Select a course above to see related information here!</h3>');
					document.getElementById("submit").className = "hidden";
				}
				else
				{
					if (window.XMLHttpRequest){
						xmlhttp=new XMLHttpRequest(); // code for IE7+, Firefox, Chrome, Opera, Safari
					}
					else{
						xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); // code for IE6, IE5
					}
		
					xmlhttp.onreadystatechange=function(){
						if (xmlhttp.readyState==4 && xmlhttp.status==200){
							document.getElementById("courseInfo").innerHTML=xmlhttp.responseText;
							document.getElementById("submit").className = "";
						}
					}
					xmlhttp.open("POST","courseInfo.php",true);
					xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
					xmlhttp.send("courseID=" + courseID);
				}
			}
			function enrollInCourse(){
				//alert("asd");
				$('#courseInfo').html('<b>Please wait . . . </b>');
				var xmlhttp;
				var courseID = $('#courseID').val();
				var userID = $('#userID').val();
				var userStatus = $('#userStatus').val();
				//alert(userStatus);
				//alert(courseID);
				if(courseID == ""){
					$('#courseInfo').html('<h3>Please Select a course to Enroll!</h3>');
				}
				else
				{
					if (window.XMLHttpRequest){
						xmlhttp=new XMLHttpRequest(); // code for IE7+, Firefox, Chrome, Opera, Safari
					}
					else{
						xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); // code for IE6, IE5
					}
		
					xmlhttp.onreadystatechange=function(){
						if (xmlhttp.readyState==4 && xmlhttp.status==200){
							document.getElementById("courseInfo").innerHTML=xmlhttp.responseText;
							document.getElementById("submit").className = "hidden";
							setTimeout(function() {
								location.reload();
							}, 1000);
						}
					}
					xmlhttp.open("POST","courseEnroll.php",true);
					xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
					xmlhttp.send("courseID=" + courseID + "&userID=" + userID + "&userStatus=" + userStatus);
				}
			}
		</script>
		
	</head>
	
	<body>
		<?php include 'navbar.php' ?>
		<?php include 'leftSidebar.php' ?>
		
		
		<!--/.fluid-container-->
		<div class="container">
			
			<div id="course1" class="enroll-box-around">
				<input type="hidden" id="userID" value="<?php echo $userID; ?>"/>
				<input type="hidden" id="userStatus" value="<?php echo $userStatus; ?>"/>
				
				<select name="courseID" id="courseID" class="selectpicker show-tick form-control" data-live-search="true" title="Please Choose Courses to enroll" multiple data-max-options="1" onchange="populateCourseInfo()">
					<?php
					$stmt = $user_home->runQuery("SELECT * FROM tbl_courses");
					$stmt->execute();
					while ($courses = $stmt->fetch(PDO::FETCH_ASSOC)){
						$fid = $courses['facultyID'];
						$stmt1 = $user_home->runQuery("SELECT * FROM tbl_users WHERE userID=".$fid);
						$stmt1->execute();
						$facname = $stmt1->fetch(PDO::FETCH_ASSOC);
						echo "<option value=\"".$courses['courseID']."\">".$courses['courseName']."</option>";
					}
					?>
				</select>
			</div>
			<div id="wrapper" class="box-around">
				<div id="courseInfo">
					<h3>Please Select a course above to see related information here!</h3>
				</div>
				<div id="submit" class="hidden">
					<center><button id="enrollButton" class="btn btn-lg btn-primary" onclick="enrollInCourse()">Enroll</button></center>
				</div>
			</div>
		</div>
	</body>
</html>
