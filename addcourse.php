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
		$(document).ready(function() {
			$('#startDatePicker')
				.datepicker({
					autoclose: true,
					format: 'yyyy/mm/dd'
				})
			$('#endDatePicker')
			.datepicker({
				autoclose: true,
				format: 'yyyy/mm/dd'
			})
		});
		</script>
		
	</head>
	
	<body>
		<?php include 'navbar.php' ?>
		<?php include 'leftSidebar.php' ?>

		
		<!--/.fluid-container-->
		<div class="container">
			<form action="runAddCourse.php" class="wide-box-around" method="post">
				<h2 class="form-signin-heading">Add a Course</h2>
				<hr/>
				<input type="text" class="form-control input-block-level" placeholder="Course ID" name="courseID" name="courseID" required />
				<br/>
				<input type="text" class="form-control input-block-level" placeholder="Course Name" name="courseName" name="courseName" required />
				<br/>
				<input type="text" class="form-control input-block-level" placeholder="Course Slot" name="courseSlot" name="courseSlot" required />
				<br/>
				<input type="text" class="form-control input-block-level" placeholder="Department / Institute" id="instName" name="instName" required />
				<br/>
				<div class="form-group">
					<div class="date">
						<div class="input-group input-append date" id="startDatePicker" style="width: 49%; float: left;">
							<input type="text" class="form-control input-block-level" placeholder="Course Start Date (Tentative)" name="startDate" id="startDate" />
							<span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
						</div>
						<div class="input-group input-append date" id="endDatePicker"  style="width: 49%; float: right;">
							<input type="text" class="form-control input-block-level" placeholder="Course End Date (Tentative)" name="endDate" id="endDate" />
							<span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
						</div>
						<br/>
					</div>
				</div>
				<br/>
				<select name="courseTerm" id="courseTerm" class="selectpicker show-tick form-control" title="Please Choose Semester">
					<option value="ODD">Odd Semester Course</option>
					<option value="EVEN">Even Semester Course</option>
				</select>
				<br/>&nbsp;<br/>
				<textarea class="form-control input-block-level" placeholder="Course Description & Pre-requisites" name="courseDesc" id="courseDesc" rows="11" cols="100" required></textarea>
				<br/>
				<select name="facultyID" id="facultyID" class="selectpicker show-tick form-control" data-live-search="true" title="Please Choose Course Instructor" multiple data-max-options="1">
					<?php
					$stmt = $user_home->runQuery("SELECT * FROM tbl_users WHERE userStatus=8");
					$stmt->execute();
					while ($users = $stmt->fetch(PDO::FETCH_ASSOC)){
						echo "<option value=\"".$users['userID']."\">".$users['fullName']."</option>";
					}
					?>
				</select>
				<br/>
				<hr/>
				<div>
					<div style="float: left; width: 50%;"><button class="btn btn-lg btn-primary" type="submit">Submit</button></div>
				
					<div style="float: right;"><a href="home.php"><input type="button" class="btn btn-lg btn-danger" value="Cancel"></input></a></div>
				
				</div>
			</form>
		</div>
	</body>
	<?php include 'footer.php' ?>
</html>
