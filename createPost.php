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
	
	<body>
		<?php include 'navbar.php' ?>
		<?php include 'leftSidebar.php' ?>
		<div class="container">
		<?php
			$replyTo = isset($_POST['replyTo']) ? $_POST['replyTo'] : NULL;
			//~ echo $replyTo."<br/>";
			$postType = isset($_POST['postType']) ? $_POST['postType'] : '';
			//~ echo $postType."<br/>";
			$postSummary = isset($_POST['postSummary']) ? $_POST['postSummary'] : $_POST['postSummary'.$replyTo];
			//~ echo $postSummary."<br/>";
			$postContent = isset($_POST['postContent']) ? $_POST['postContent'] : $_POST['postContent'.$replyTo];
			//~ echo $postContent."<br/>";
			$senderId = isset($_POST['senderId']) ? $_POST['senderId'] : '';
			//~ echo $senderId."<br/>";
			$senderVisibility = isset($_POST['senderVisibility']) ? $_POST['senderVisibility'] : '';
			//~ echo $senderVisibility."<br/>";
			$media = isset($_POST['my-file-selector'.$replyTo]) ? $_POST['my-file-selector'.$replyTo] : '';
			//~ echo $media."<br/>";
			$courseID = isset($_POST['courseID']) ? $_POST['courseID'] : '';
			//~ echo $courseID."<br/>";
			//echo $courseID;
			if(basename($_FILES["my-file-selector".$replyTo]["name"])){
				$target_dir = "uploads/";
				$target_file = $target_dir . basename($_FILES["my-file-selector".$replyTo]["name"]) ;
				$uploadOk = 1;
				$FileType = pathinfo($target_file, PATHINFO_EXTENSION);
				if ($_FILES["my-file-selector".$replyTo]["size"] > 102400000) { //100KB is 102400 not 100000
					echo "<br/><br/><div class=\"wide-box-around\">Sorry, your file is too large.</div><br/><br/>";
					$uploadOk = 0;
				}
				//~ if($FileType != "txt") {
					//~ echo "<br/><br/>Sorry, only TXT files are allowed.<br/><br/>";
					//~ $uploadOk = 0;
				//~ }
				if ($uploadOk == 0) {
					echo "<br/><br/><div class=\"wide-box-around\">No file was uploaded.</div><br/><br/>";
				} else {
					$stmt = $user_home->runQuery("INSERT into tbl_post (postType, postSummary, postContent, replyTo, senderId, senderVisibility, media) 
												VALUES (:postType, :postSummary, :postContent, :replyTo, :senderId, :senderVisibility, :media)");
					$stmt->bindparam(":postType",$postType);
					$stmt->bindparam(":postSummary",$postSummary);
					$stmt->bindparam(":postContent",$postContent);
					$stmt->bindparam(":replyTo",$replyTo);
					$stmt->bindparam(":senderId",$senderId);
					$stmt->bindparam(":senderVisibility",$senderVisibility);
					$stmt->bindparam(":media",$target_file);
					$res = $stmt->execute();
					
					$stmt2 = $user_home->runQuery("SELECT * FROM tbl_post WHERE senderID=:senderId AND postContent=:postContent AND postSummary=:postSummary AND replyTo=:replyTo");
					$stmt2->execute(array(":senderId"=>$senderId, ":postContent"=>$postContent, ":postSummary"=>$postSummary, ":replyTo"=>$replyTo));
					
					$row = $stmt2->fetch(PDO::FETCH_ASSOC);
					if(isset($row) && isset($row['postId']))
					{ 
						$postId = $row['postId']; 
					} 
					echo "<div class=\"wide-box-around\">";
					if($res != 1){
						echo "<br/>Error executing MySQL Query, Please check the data sent!";
					}
					else{
						echo "<div class=\"wide-box-around\">Post Created!</br><br/>";
					}
					$target_file = $target_dir . $postId . "-" . basename($_FILES["my-file-selector".$replyTo]["name"]) ;
					//echo $target_file;
				}
					if (move_uploaded_file($_FILES["my-file-selector".$replyTo]["tmp_name"], $target_file)) {
						$stmt = $user_home->runQuery("UPDATE tbl_post SET media=:media WHERE postId=:postId");
						$stmt->bindparam(":media",$target_file);
						$stmt->bindparam(":postId",$postId);
						$stmt->execute();
					}
					//echo $replyTo;
					if($replyTo == "0"){
					//echo $courseID;
					$stmt1 = $user_home->runQuery("INSERT into tbl_thread (courseID, postId) 
														VALUES (:courseID, :postId)");
					$stmt1->bindparam(":courseID",$courseID);
					$stmt1->bindparam(":postId",$postId);
					$res1 = $stmt1->execute();
				}
				
				if($res1 == 1){
					echo "<br/>Thread Created! Refresh page to check changes!<br/></div>";
				}
				echo "<a href=\"showCourse.php?cid=".$courseID."\"><button class=\"btn btn-lg btn-success\">Click here to go back to Previous Course</button></a>";
				echo "</div>";
				}
				
			else{
				$target_file="NULL";
				$stmt = $user_home->runQuery("INSERT into tbl_post (postType, postSummary, postContent, replyTo, senderId, senderVisibility, media) 
												VALUES (:postType, :postSummary, :postContent, :replyTo, :senderId, :senderVisibility, :media)");
				$stmt->bindparam(":postType",$postType);
				$stmt->bindparam(":postSummary",$postSummary);
				$stmt->bindparam(":postContent",$postContent);
				$stmt->bindparam(":replyTo",$replyTo);
				$stmt->bindparam(":senderId",$senderId);
				$stmt->bindparam(":senderVisibility",$senderVisibility);
				$stmt->bindparam(":media",$target_file);
				$res = $stmt->execute();
				
				$stmt2 = $user_home->runQuery("SELECT * FROM tbl_post WHERE senderID=:senderId AND postContent=:postContent AND postSummary=:postSummary AND replyTo=:replyTo");
				$stmt2->execute(array(":senderId"=>$senderId, ":postContent"=>$postContent, ":postSummary"=>$postSummary, ":replyTo"=>$replyTo));
				
				$row = $stmt2->fetch(PDO::FETCH_ASSOC);
				if(isset($row) && isset($row['postId']))
				{ 
					$postId = $row['postId']; 
				} 
				echo "<div class=\"wide-box-around\">";
				if($res != 1){
					echo "<br/>Error executing MySQL Query, Please check the data sent!";
				}
				else{
					echo "<div class=\"wide-box-around\">Post Created!<br/><br/>";
				}
				//echo $postId;
				//echo $replyTo;
				if($replyTo == "0"){
					//echo $courseID;
					$stmt1 = $user_home->runQuery("INSERT into tbl_thread (courseID, postId) 
														VALUES (:courseID, :postId)");
					$stmt1->bindparam(":courseID",$courseID);
					$stmt1->bindparam(":postId",$postId);
					$res1 = $stmt1->execute();
				}
				
				if($res1 == 1){
					echo "<br/>Thread Created! Refresh page to check changes!<br/></div>";
				}
				echo "<a href=\"showCourse.php?cid=".$courseID."\"><button class=\"btn btn-lg btn-success\">Go back to Course</button></a>";
				echo "</div>";
			}
		?>
		</div>
	</body>
</html>
