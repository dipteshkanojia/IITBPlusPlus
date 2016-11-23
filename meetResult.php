<?php
	session_start();
	require_once 'class.user.php';
	$user_home = new USER();
	
	if(!$user_home->is_logged_in())
	{
		$user_home->redirect('index.php');
	}
	
	$studentUserId = isset($_POST['studentUserId']) ? $_POST['studentUserId'] : '';
	$meetingDate = isset($_POST['meetingDate']) ? $_POST['meetingDate'] : '';
	$meetingTime = isset($_POST['meetingTime']) ? $_POST['meetingTime'] : '';
	$about = isset($_POST['about']) ? $_POST['about'] : '';
	$approved = isset($_POST['result']) ? $_POST['result'] : '';


	$stmt = $user_home->runQuery("UPDATE tbl_schedule_meeting SET approved=:approved WHERE studentUserId=:studentUserId AND meetingDate=:meetingDate AND meetingTime=:meetingTime AND about=:about");
	$stmt->bindparam(":studentUserId",$studentUserId);
	$stmt->bindparam(":meetingDate",$meetingDate);
	$stmt->bindparam(":meetingTime",$meetingTime);
	$stmt->bindparam(":about",$about);
	$stmt->bindparam(":approved",$approved);
	$res = $stmt->execute();
	
	if($approved==1){
		$result = "Meeting Approved!";
	} else if ($approved==-1){
		$result = "Meeting Rejected!";
	} else {
		$result = "Meeting Postponed!";
	}
	
	if($res != 1){
		echo "<br/>Error executing MySQL Query, Please check the data sent!";
	}
	else{
		echo $result;
	}
?>

