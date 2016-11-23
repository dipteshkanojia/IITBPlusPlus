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
$filename = __FILE__;

?>



<!DOCTYPE html>
<html class="no-js">

	<head>
		<title>IIT-B Plus+</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
		<link href="bootstrap/css/bootstrap-select.min.css" rel="stylesheet" media="screen">
		<link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
		<link href="assets/styles.css" rel="stylesheet" media="screen">

		<script src="bootstrap/js/jquery-1.9.1.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
		<script src="bootstrap/js/bootstrap-select.min.js"></script>
		<script src="assets/scripts.js"></script>

	</head>

	<body class="mobilebody">
		<?php include 'navbar.php' ?>
		<?php include 'leftSidebar.php' ?>
		
		<!--/.fluid-container-->
		<div class="container">
		<?php
			$userID = $row['userID'];
			$stmtCourseList = $user_home->runQuery("SELECT * FROM tbl_class_allocation WHERE userID=:uid");
			$stmtCourseList->execute(array(":uid"=>$userID));
			$i=0;
			while ($coursesList = $stmtCourseList->fetch(PDO::FETCH_ASSOC)){
				$stmtCourseNameGet = $user_home->runQuery("SELECT * FROM tbl_courses WHERE courseID=:cid");
				$stmtCourseNameGet->execute(array(":cid"=>$coursesList['classID']));
				$courseName = $stmtCourseNameGet->fetch(PDO::FETCH_ASSOC);
				$stmtGetFacultyName = $user_home->runQuery("SELECT * FROM tbl_users WHERE userID=:fid");
				$stmtGetFacultyName->execute(array(":fid"=>$courseName['facultyID']));
				$facultyName = $stmtGetFacultyName->fetch(PDO::FETCH_ASSOC);
				echo "<a href=\"showCourse.php?cid=".$coursesList['classID']."\"><div id=\"course".$i."\" name=\"course".$i."\" class=\"course-box-around\">
						<p class=\"alignleft\" style=\"font-size: 20px; font-family: 'Bree Serif', serif;\">".$coursesList['classID']."</p>
						<p class=\"alignright\" style=\"font-size: 20px;\">".$courseName['courseName']."</p><br/><br/><br/><br/><br/>
						<p class=\"alignbottom alignleft\">Slot : ".$courseName['courseSlot']."</p>
						<p class=\"alignright\"><i class=\"glyphicon glyphicon-pencil\">&nbsp;</i>".$facultyName['fullName']."</p>
				</div></a>";
				$i++;
			}

		?>
		</div>


	</body>
<?php include 'footer.php' ?>
</html>
