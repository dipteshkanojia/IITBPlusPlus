<?php
	session_start();
	require_once 'class.user.php';
	$user_home = new USER();
	
	
	
	$stmt = $user_home->runQuery("SELECT * FROM tbl_users WHERE userID=:uid");
	$stmt->execute(array(":uid"=>$_SESSION['userSession']));
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	$filename = __FILE__;
	//echo "Asda";
	$threadId = isset($_POST['threadId']) ? $_POST['threadId'] : '';
	//echo $threadId;
	$stmt = $user_home->runQuery("SELECT * from tbl_thread WHERE threadId=:threadId");
	$stmt->execute(array(":threadId"=>$threadId));
	
	function createDataArray($postId, $user_home){
		//echo $postId;
		//echo $user_home;
		$stmt2 = $user_home->runQuery("SELECT * from tbl_post WHERE replyTo=:replyTo");
		$stmt2->execute(array(":replyTo"=>$postId));
		$count = $stmt2->rowCount();
		//echo $count;
		while($row3 = $stmt2->fetch(PDO::FETCH_ASSOC)){
			//echo $row3['senderId'];
			$stmtGetUser = $user_home->runQuery("SELECT * FROM tbl_users WHERE userID=:userID");
			$stmtGetUser->execute(array(":userID"=>$row3['senderId']));
			$nameArray = $stmtGetUser->fetch(PDO::FETCH_ASSOC);
			$type='';
			if($row3['postType']=='Q'){
				$type="Question";
			} else {
				$type="Note";
			}
			if($row3['senderVisibility']=='N'){
				$name = "Anonymous";
			} else {
				$name = $nameArray['fullName'];
			}
			echo "<ul class=\"postStyle\"><li style=\"font-size: 16px;\"><b>".$row3['postSummary']."</b><span class=\"glyphicon glyphicon-user btn btn-sm btn-warning\" style=\"float: right; font-size: 14px;\">&nbsp;".$name."</span><br/><br/><i>".nl2br($row3['postContent'])."</i><br/></li>";
			echo "<br/><div><div class=\"label label-info\" style=\"float: left; width: 40%; font-size: 14px; white-space: normal; height: 30%; word-wrap: break-word;\">".$type."&nbsp;&nbsp;at&nbsp;&nbsp;".$row3['dateOfPost']."</div>";
			echo "<button class=\"btn btn-xs btn-success\" style=\"width: 30%;; float: right; font-size: 14px;\" id=\"button".$row3['postId']."\" onclick=\"replyToPost(this)\">Reply</button></div><br/><br/>";
			if($row3['media']!="NULL") { echo "<a href=\"".$row3['media']."\" download><button class=\"btn btn-md btn-info\">Download Attachment</button></a>"; }
			echo "<div id=\"responseTo".$row3['postId']."\"></div>";
			createDataArray($row3['postId'], $user_home);
			echo "</ul>";
		 }
	}
		
	while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		//echo $row['postId'];
		$stmt1 = $user_home->runQuery("SELECT * FROM tbl_post WHERE postId=:postId");
		$stmt1->execute(array(":postId"=>$row['postId']));
		$row2 = $stmt1->fetch(PDO::FETCH_ASSOC);
		$stmtGetUserTop = $user_home->runQuery("SELECT * FROM tbl_users WHERE userID=:userID");
		$stmtGetUserTop->execute(array(":userID"=>$row2['senderId']));
		$nameArrayTop = $stmtGetUserTop->fetch(PDO::FETCH_ASSOC);
		$type='';
		if($row2['postType']=='Q'){
			$type="Question";
		} else {
			$type="Note";
		}
		if($row2['senderVisibility']=='N'){
				$nameTop = "Anonymous";
			} else {
				$nameTop = $nameArrayTop['fullName'];
			}
		echo "<b  style=\"font-size: 16px;\">".$row2['postSummary']."</b><span class=\"glyphicon glyphicon-user btn btn-sm btn-danger\" style=\"float: right; font-size: 14px;\">&nbsp;".$nameTop."</span><br/><br/><i style=\"font-size: 16px;\">".nl2br($row2['postContent'])."</i><br/>";
			echo "<br/><div><div class=\"label label-info\" style=\"float: left; width: 40%; font-size: 14px; white-space: normal; height: 30%; word-wrap: break-word;\">".$type."&nbsp;&nbsp;at&nbsp;&nbsp;".$row2['dateOfPost']."</div>";
		echo "<button class=\"btn btn-sm btn-success\" style=\"width: 30%; float: right; font-size: 14px;\" id=\"button".$row2['postId']."\" onclick=\"replyToPost(this)\">Reply</button></div><br/><br/>";
		if($row2['media']!="NULL") { echo "<a href=\"".$row2['media']."\" download><button class=\"btn btn-md btn-info\">Download Attachment</button></a>"; }
		echo "<div id=\"responseTo".$row2['postId']."\"></div>";
		createDataArray($row2['postId'], $user_home);
	}
	
	
	
?>
