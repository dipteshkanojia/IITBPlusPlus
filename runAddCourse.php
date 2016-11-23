<?php
session_start();
$filename = __FILE__;
require_once 'class.user.php';
$user_home = new USER();

if(!$user_home->is_logged_in())
{
	$user_home->redirect('index.php');
}

$stmt = $user_home->runQuery("SELECT * FROM tbl_users WHERE userID=:uid");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$courseID = isset($_POST['courseID']) ? $_POST['courseID'] : '';
$courseName = isset($_POST['courseName']) ? $_POST['courseName'] : '';
$courseSlot = isset($_POST['courseSlot']) ? $_POST['courseSlot'] : '';
$instName = isset($_POST['instName']) ? $_POST['instName'] : '';
$startDate = isset($_POST['startDate']) ? $_POST['startDate'] : '';
$endDate = isset($_POST['endDate']) ? $_POST['endDate'] : '';
$courseTerm = isset($_POST['courseTerm']) ? $_POST['courseTerm'] : '';
$courseDesc = isset($_POST['courseDesc']) ? $_POST['courseDesc'] : '';
$facultyID = isset($_POST['facultyID']) ? $_POST['facultyID'] : '';

?>

<!DOCTYPE html>
<html class="no-js">
	
	<head>
		<title>IIT-B Plus+</title>
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
		<link href="bootstrap/css/bootstrap-select.min.css" rel="stylesheet" media="screen">
		<link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
		<link rel="stylesheet" href="bootstrap/css/bootstrap-datepicker.min.css" />
		<link rel="stylesheet" href="bootstrap/css/bootstrap-datepicker3.min.css" />
		<link href="assets/styles.css" rel="stylesheet" media="screen">
		<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<script src="bootstrap/js/modernizr-2.6.2-respond-1.1.0.min.js"></script>
		<script src="bootstrap/js/jquery-1.9.1.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
		<script src="bootstrap/js/bootstrap-select.min.js"></script>
		<script src="assets/scripts.js"></script>
	</head>
	
	<body>
		<?php include 'navbar.php' ?>
		<!--/.fluid-container-->
		<div class="container">
			<div class="box-around">
				<?php
					$stmt = $user_home->runQuery("INSERT into tbl_class_allocation (userID, classID, userStatus) 
													VALUES (:fid, :cid, 8)");
					$stmt->bindparam(":cid",$courseID);
					$stmt->bindparam(":fid",$facultyID);
					$res = $stmt->execute();
					
					if($res != 1){
						echo "<br/>Error Adding faculty to course enrollment automatically!";
					}
					
					$stmt = $user_home->runQuery("INSERT into tbl_courses (courseID, courseName, courseSlot, instName, startDate, endDate, courseTerm, courseDescription, facultyID) 
													 VALUES (:cid, :fname, :cslot, :iname,:sdate, :edate, :cterm, :cdesc, :fid)");
					$stmt->bindparam(":cid",$courseID);
					$stmt->bindparam(":fname",$courseName);
					$stmt->bindparam(":cslot",$courseSlot);
					$stmt->bindparam(":iname",$instName);
					$stmt->bindparam(":sdate",$startDate);
					$stmt->bindparam(":edate",$endDate);
					$stmt->bindparam(":cterm",$courseTerm);
					$stmt->bindparam(":cdesc",$courseDesc);
					$stmt->bindparam(":fid",$facultyID);
					$res = $stmt->execute();
					
					if($res != 1){
						echo "<br/>Error executing MySQL Query for adding in list of courses, Please check the data sent!";
					}
					else{
						$stmt = $user_home->runQuery("SELECT * FROM tbl_users WHERE userID=:uid");
						$stmt->execute(array(":uid"=>$facultyID));
						$row = $stmt->fetch(PDO::FETCH_ASSOC);
						if($courseTerm=="ODD")
						{ 
							$courseTermValue = "Odd Semester Course"; 
						} 
						else 
						{ 
							$courseTermValue = "Even Semester Course"; 
						}
						echo "<table class=\"table table-striped table-bordered\"><th colspan=2>Course Added to Database </th><tr><td>Course ID</td><td>".$courseID."</td></tr><tr><td>Course Name</td><td>".$courseName."</td></tr><tr><td>Course Slot</td><td>".$courseSlot."</td></tr><tr><td>Course Instructor</td><td>".$row['fullName']."</td></tr><tr><td>Department / Institute</td><td>".$instName."</td></tr><tr><td>Tentative Start Date</td><td>".$startDate."</td></tr><tr><td>Tentative End Date</td><td>".$endDate."</td></tr><tr><td>Course Term</td><td>".$courseTermValue."</td></tr></table>";
						//echo $res."<br/>".$courseID."<br/>".$courseName."<br/>".$courseSlot."<br/>".$instName."<br/>".$startDate."<br/>".$endDate."<br/>".$courseTerm."<br/>".$courseDesc."<br/>".$facultyID;
					}
				?>
				<center><a href="home.php"><input type="button" class="btn btn-lg btn-danger" value="Back Home"></input></a></center>
			</div>
		</div>
	</body>
	<?php include 'footer.php' ?>
</html>

