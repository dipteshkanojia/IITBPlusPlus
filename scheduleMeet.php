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
$filename = __FILE__;
$approved = 1;
$notApproved = 0;
$rejected = -1;
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

		<script src="bootstrap/js/jquery-1.9.1.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
		<script src="bootstrap/js/bootstrap-select.min.js"></script>
		<script src="bootstrap/js/bootstrap-datepicker.min.js"></script>
		<script src="assets/scripts.js"></script>
		<script>
		$(document).ready(function() {
			$('#meetDatePicker')
				.datepicker({
					autoclose: true,
					format: 'yyyy/mm/dd'
				})
			
		});
		
		function meetRequest(){
				//alert("asd");
				$('#requestInfo').html('<b>Please wait . . . </b>');
				var xmlhttp;
				var userID = $('#userID').val();
				var facultyID = $('#facultyID').val();
				var meetDate = $('#meetDate').val();
				var meetTime = $('#meetTime').val();
				var about = $('#about').val();
				if (window.XMLHttpRequest){
					xmlhttp=new XMLHttpRequest(); // code for IE7+, Firefox, Chrome, Opera, Safari
				}
				else{
					xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); // code for IE6, IE5
				}
		
				xmlhttp.onreadystatechange=function(){
					if (xmlhttp.readyState==4 && xmlhttp.status==200){
						document.getElementById("requestInfo").innerHTML=xmlhttp.responseText;
						document.getElementById("submit").className = "hidden";
						setTimeout(function() {
								location.reload();
						}, 1000);
					}
				}
				xmlhttp.open("POST","meetRequest.php",true);
				xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
				xmlhttp.send("userID=" + userID + "&facultyID=" + facultyID + "&meetDate=" + meetDate + "&meetTime=" + meetTime + "&about=" + about);
				
			}
			function meetResult(i,res){
				//alert(i);
				//alert(res);
				var xmlhttp;
				var about = document.getElementById("about"+i).innerText;
				var studentUserId = document.getElementById("studentUserId"+i).value;
				//alert(id);
				var meetingDate = document.getElementById("meetingDate"+i).innerText;
				var meetingTime = document.getElementById("meetingTime"+i).innerText;
				//~ //alert(about);
				if (window.XMLHttpRequest){
					xmlhttp=new XMLHttpRequest(); // code for IE7+, Firefox, Chrome, Opera, Safari
				}
				else{
					xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); // code for IE6, IE5
				}
		
				xmlhttp.onreadystatechange=function(){
					if (xmlhttp.readyState==4 && xmlhttp.status==200){
						document.getElementById("approval"+i).innerText=xmlhttp.responseText;
						setTimeout(function() {
								location.reload();
						}, 1000);
					}
				}
				xmlhttp.open("POST","meetResult.php",true);
				xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
				xmlhttp.send("about=" + about + "&studentUserId=" + studentUserId + "&meetingDate=" + meetingDate + "&meetingTime=" + meetingTime + "&result=" + res);
			}
		</script>
		
	</head>
	
	<body>
		<?php include 'navbar.php' ?>
		<?php include 'leftSidebar.php' ?>
		
		
		<!--/.fluid-container-->
		<div class="container">
			<div class="wide-box-around">
				<input type="hidden" id="userID" value="<?php echo $userID; ?>"/>
				<h2 class="form-signin-heading">Request meeting time with Faculty</h2>
				<h5>Pick a date and enter a time</h5>
				<hr/>
				<div class="form-group">
					<div class="date">
						<div class="input-group input-append date" id="meetDatePicker"  style="width:49%; float: left;">
							<input type="text" class="form-control input-block-level" placeholder="Request Meeting Date here (Tentative)" name="meetDate" id="meetDate" />
							<span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
						</div>
						<div class="time" style="width: 49%; float: right;"><input class="form-control" type="text" id="meetTime" name="meetTime" placeholder="Mention time requested here..."></input></div>
						<br/>
					</div>
				</div>
				<br/>
				<input class="form-control" type="text" id="about" name="about" placeholder="Mention your meeting agenda / Why are you requesting a meet here..."></input>

				
				<br/>
				<select name="facultyID" id="facultyID" class="selectpicker show-tick form-control" data-live-search="true" title="Choose Faculty Name..." multiple data-max-options="1">
					<?php
					$stmt = $user_home->runQuery("SELECT * FROM tbl_users WHERE userStatus=8");
					$stmt->execute();
					while ($users = $stmt->fetch(PDO::FETCH_ASSOC)){
						echo "<option value=\"".$users['userID']."\">".$users['fullName']."</option>";
					}
					?>
				</select>
				<hr/>
				<input type="button" class="btn btn-lg btn-warning" id="submit" name="submit" value="Request"  onclick="meetRequest();"></input>
				<?php 
				
					if($userStatus == 8){
						echo "<hr>";
						$stmtToGetMeetingReq = $user_home->runQuery("SELECT * FROM tbl_schedule_meeting WHERE facultyUserID=:userID AND approved=:approved");
						$stmtToGetMeetingReq->execute(array(":userID"=>$userID, ":approved"=>$notApproved));
						echo "<table class=\"table table-striped table-bordered\"><tr><th>Agenda</th><th>Name</th><th>Date</th><th>Time</th><th>Action</th></tr>";
						$i=1;
						while($rowOfUnapprovedMeets = $stmtToGetMeetingReq->fetch(PDO::FETCH_ASSOC)){
							
							$studentUserID = $rowOfUnapprovedMeets['studentUserID'];
							$meetingDate = $rowOfUnapprovedMeets['meetingDate'];
							$meetingTime = $rowOfUnapprovedMeets['meetingTime'];
							$about = $rowOfUnapprovedMeets['about'];
							
							$stmtGetStudName = $user_home->runQuery("SELECT fullName FROM tbl_users WHERE userID=:studentUserID");
							$stmtGetStudName->execute(array(":studentUserID"=>$studentUserID));
							$StudentArray = $stmtGetStudName->fetch(PDO::FETCH_ASSOC);
							$name = $StudentArray['fullName'];
							echo "<tr><td id=\"about".$i."\">".$about."</td><td id=\"name".$i."\">".$name."</td><td id=\"meetingDate".$i."\">".$meetingDate."</td><td id=\"meetingTime".$i."\">".$meetingTime."</td><td id=\"approval".$i."\"><input type=\"button\" class=\"btn btn-xs btn-success\" value=\"Approve\" onclick=\"meetResult('".$i."','1');\" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"button\" class=\"btn btn-xs btn-danger\" value=\"Reject\" onclick=\"meetResult('".$i."','-1');\" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"button\" class=\"btn btn-xs btn-warning\" value=\"Postpone\" onclick=\"meetResult('".$i."','2');\" /></td></tr>";
							echo "<input type=\"hidden\" value=\"".$studentUserID."\" id=\"studentUserId".$i."\">";
							$i++;
						}
						echo "</table>";
					}
				?>
				<div id="requestInfo"></div>
			</div>
			<div class="wide-box-around">
				<?php
					
					$stmt = $user_home->runQuery("SELECT * FROM tbl_schedule_meeting WHERE studentUserID=:uid AND approved=:app");
					$stmt->execute(array(":uid"=>$userID, ":app"=>$approved));
					
					$count = $stmt->rowCount(); 
					if($count){
						echo "<h2 class=\"form-signin-heading\">Approved meetings</h2>";
						echo "<h5>Approved Meetings</h5>";
						echo "<table class=\"table table-striped table-bordered\"><th>Faculty</th><th>Date</th><th>Time</th><th>Status</th>";
						while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
							//echo $row;
							$stmtGetFacultyName = $user_home->runQuery("SELECT * FROM tbl_users WHERE userID=:fid");
							$stmtGetFacultyName->execute(array(":fid"=>$row['facultyUserID']));
							$facultyName = $stmtGetFacultyName->fetch(PDO::FETCH_ASSOC);
							echo "<tr><td>".$facultyName['fullName']."</td><td>".$row['meetingDate']."</td><td>".$row['meetingTime']."</td><td style=\"color: green\">Approved</td></tr>";
							
						}
						echo "</table>";
					}
					else{
						echo "<h3>No approved meetings!</h3>";
					}
				$stmtReject = $user_home->runQuery("SELECT * FROM tbl_schedule_meeting WHERE studentUserID=:uid AND approved=:app");
				$stmtReject->execute(array(":uid"=>$userID, ":app"=>$rejected));
				
				$countRej = $stmtReject->rowCount();
				if($countRej) {
				?>
				<hr>
				<h2 class="form-signin-heading">Rejected meetings</h2>
				<h5>Rejected by Faculty...</h5>
				<?php
					echo "<table class=\"table table-striped table-bordered\"><th>Faculty</th><th>Date</th><th>Time</th><th>Status</th>";
					while($row = $stmtReject->fetch(PDO::FETCH_ASSOC)){
						$stmtGetFacultyName = $user_home->runQuery("SELECT * FROM tbl_users WHERE userID=:fid");
						$stmtGetFacultyName->execute(array(":fid"=>$row['facultyUserID']));
						$facultyName = $stmtGetFacultyName->fetch(PDO::FETCH_ASSOC);
						echo "<tr><td>".$facultyName['fullName']."</td><td>".$row['meetingDate']."</td><td>".$row['meetingTime']."</td><td style=\"color: red\">Rejected</td></tr>";
					}
					echo "</table>";
				}
				if($count){
				?>
				<hr>
				<h2 class="form-signin-heading">Requested meetings</h2>
				<h5>Yet to be approved by Faculty...</h5>
				<?php
					$stmt = $user_home->runQuery("SELECT * FROM tbl_schedule_meeting WHERE studentUserID=:uid AND approved=:app");
					$stmt->execute(array(":uid"=>$userID, ":app"=>$notApproved));
					echo "<table class=\"table table-striped table-bordered\"><th>Faculty</th><th>Date</th><th>Time</th><th>Status</th>";
					while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
						$stmtGetFacultyName = $user_home->runQuery("SELECT * FROM tbl_users WHERE userID=:fid");
						$stmtGetFacultyName->execute(array(":fid"=>$row['facultyUserID']));
						$facultyName = $stmtGetFacultyName->fetch(PDO::FETCH_ASSOC);
						echo "<tr><td>".$facultyName['fullName']."</td><td>".$row['meetingDate']."</td><td>".$row['meetingTime']."</td><td style=\"color: red\">Not Approved</td></tr>";
					}
					echo "</table>";
				}
				else {
				?>
				<h3>No meeting requests are pending for approval!</h3>
				<?php } ?>
			</div>
				
		</div>
		
		
	</body>
	<?php include 'footer.php' ?>

</html>
