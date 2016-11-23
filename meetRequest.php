<?php
	session_start();
	require_once 'class.user.php';
	$user_home = new USER();
	
	if(!$user_home->is_logged_in())
	{
		$user_home->redirect('index.php');
	}
	
	$userID = isset($_POST['userID']) ? $_POST['userID'] : '';
	$facultyID = isset($_POST['facultyID']) ? $_POST['facultyID'] : '';
	$meetDate = isset($_POST['meetDate']) ? $_POST['meetDate'] : '';
	$meetTime = isset($_POST['meetTime']) ? $_POST['meetTime'] : '';
	$about = isset($_POST['about']) ? $_POST['about'] : '';
	$approved = "0";

	/*Check if already requested for a meet for the course*/
	$stmt = $user_home->runQuery("SELECT * FROM tbl_schedule_meeting WHERE studentUserID=:uid AND facultyUserID=:fid");
	$stmt->execute(array(":uid"=>$userID, ":fid"=>$facultyID,));
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	
	if($row['studentUserID']==$userID){
		echo "<h3>Cannot schedule more than one meeting request with the same Faculty! Please e-mail / contact the faculty manually!</h3>";
	}
	else{
		$stmt = $user_home->runQuery("INSERT into tbl_schedule_meeting (studentUserID, facultyUserID, meetingDate, meetingTime, about, approved) 
										VALUES (:uid, :fid, :mdate, :mtime,:about, :approved)");
		$stmt->bindparam(":uid",$userID);
		$stmt->bindparam(":fid",$facultyID);
		$stmt->bindparam(":mdate",$meetDate);
		$stmt->bindparam(":mtime",$meetTime);
		$stmt->bindparam(":about",$about);
		$stmt->bindparam(":approved",$approved);
		$res = $stmt->execute();
		if($res != 1){
			echo "<br/>Error executing MySQL Query, Please check the data sent!";
		}
		else{
			$stmtGetFacultyName = $user_home->runQuery("SELECT * FROM tbl_users WHERE userID=:fid");
			$stmtGetFacultyName->execute(array(":fid"=>$facultyID));
			$facultyName = $stmtGetFacultyName->fetch(PDO::FETCH_ASSOC);
			echo "<h4>Meeting Requested with Faculty: ".$facultyName['fullName'].", for Date: ".$meetDate.", at ".$meetTime.".<br/>Please wait for them to approve the meeting.</h4>";
		}
		
	}
	
?>
