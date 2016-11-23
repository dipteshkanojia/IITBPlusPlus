<?php

	session_start();
	require_once 'class.user.php';
	$user_home = new USER();
	
	if(!$user_home->is_logged_in())
	{
		$user_home->redirect('index.php');
	}
	
	$userID = isset($_POST['userID']) ? $_POST['userID'] : '';
	$courseID = isset($_POST['courseID']) ? $_POST['courseID'] : '';
	$userStatus = isset($_POST['userStatus']) ? $_POST['userStatus'] : '';
	
	/*Check if already enrolled for the course*/
	$stmt = $user_home->runQuery("SELECT * FROM tbl_class_allocation WHERE userID=:uid AND classID=:cid");
	$stmt->execute(array(":cid"=>$courseID, ":uid"=>$userID));
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	
	if(isset($row['userID']) && ($row['userID']==$userID)){
		/*Tell they are already enrolled*/
		echo "<h3>You are already enrolled for the course!</h3>";
	}
	else{
		/*Enroll for the course*/
		$stmt = $user_home->runQuery("INSERT into tbl_class_allocation (userID, classID, userStatus) 
										VALUES (:uid, :cid, :ustatus)");
		
		$stmt->bindparam(":uid",$userID);
		$stmt->bindparam(":cid",$courseID);
		$stmt->bindparam(":ustatus",$userStatus);
		
		$res = $stmt->execute();
	
		if($res != 1){
			echo "<br/>Error executing MySQL Query, Please check the data sent!";
		}
		else{
			
			$stmt = $user_home->runQuery("SELECT * FROM tbl_courses WHERE courseID=:cid");
			$stmt->execute(array(":cid"=>$courseID));
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			
			echo "You have been enrolled for ".$row['courseName']." (".$courseID.")";
			
		}
	}

?>
