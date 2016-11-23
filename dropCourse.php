<?php
	session_start();
	require_once 'class.user.php';
	$user_home = new USER();
	
	$stmt = $user_home->runQuery("SELECT * FROM tbl_users WHERE userID=:uid");
	$stmt->execute(array(":uid"=>$_SESSION['userSession']));
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	$filename = __FILE__;
	//echo "Asda";
	$sentCID = isset($_POST['sentCID']) ? $_POST['sentCID'] : '';
	
	$stmt = $user_home->runQuery("DELETE FROM tbl_class_allocation WHERE userID=:userID AND classID=:sentCID");
	$stmt->execute(array(":userID"=>$row['userID'], ":sentCID"=>$sentCID));
	echo "Dropped ".$sentCID;
?>
