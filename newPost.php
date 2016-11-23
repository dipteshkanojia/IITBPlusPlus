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
//echo $row['fullName'];

?>
<?php
	$courseID = isset($_POST['sentCID']) ? $_POST['sentCID'] : '';
	$replyTo = isset($_POST['replyTo']) ? $_POST['replyTo'] : '0';
	//echo $replyTo;
	$senderId = $row['userID'];
	$stmtGetPostData = $user_home->runQuery("SELECT * from tbl_post WHERE postId=:replyTo");
	$stmtGetPostData->execute(array(":replyTo"=>$replyTo));
	$postArray = $stmtGetPostData->fetch(PDO::FETCH_ASSOC);
	$replyPostSummary="RE: ".$postArray['postSummary'];
	//echo $courseID;
	//echo $sentCID;
?><br/>
<div id="div<?php echo $replyTo; ?>" class="wide-box-around">
	<form id="form<?php echo $replyTo; ?>" name="form<?php echo $replyTo; ?>" action="createPost.php" enctype="multipart/form-data" method="POST">
		<?php if($replyTo == 0) { ?> <h3>Create a new thread</h3><br/> <?php } ?>
		<input type="hidden" id="senderId" name="senderId" value="<?php echo $senderId; ?>"/>
		<input type="hidden" id="replyTo" name="replyTo" value="<?php echo $replyTo; ?>"/>
		<input type="hidden" id="courseID" name="courseID" value="<?php echo $courseID; ?>"/>
		<label class="radio-inline"><input type="radio" class="radButton" name="postType" value="Q" checked> Question </label>
		<label class="radio-inline"><input type="radio" class="radButton" name="postType" value="N"> Note </label><br/><br/>
		<?php if($replyTo == 0) { ?>
			<input type="text" class="form-control" id="postSummary" name="postSummary" placeholder="Enter thread topic"></input><br/>
		<?php } else { ?>
			<input type="text" class="form-control" id="postSummary<?php echo $replyTo; ?>" name="postSummary<?php echo $replyTo; ?>"value="<?php echo $replyPostSummary; ?>"></input><br/>
		<?php } ?>
		<?php if($replyTo == 0) { ?>
			<textarea class="form-control" rows="10" id="postContent" name="postContent" placeholder="Enter your message" wrap="hard"></textarea><br/>
		<?php } else { ?>
			<textarea class="form-control" rows="10" id="postContent<?php echo $replyTo; ?>" name="postContent<?php echo $replyTo; ?>" placeholder="Enter your message" wrap="hard"></textarea><br/>
		<?php } ?>
		
			<label class="btn btn-primary glyphicon glyphicon-folder-open" for="my-file-selector<?php echo $replyTo; ?>">
				<input id="my-file-selector<?php echo $replyTo; ?>" name="my-file-selector<?php echo $replyTo; ?>" type="file" style="display:none;" onchange="$('#upload-file-info<?php echo $replyTo; ?>').html($(this).val());">
					Attach&nbsp;File&hellip;
			</label>
		<span class='label label-info' id="upload-file-info<?php echo $replyTo; ?>"></span>
		
		<br/><br/>
		<div>
			<div style="float: left; width: 25%">
				<input type="button" id="Submit" value="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Post&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" class="btn btn-lg btn-success" onclick="form<?php echo $replyTo; ?>.submit()"></input>
			</div>
			<div style="float: right; ">
				<input type="button" value="Cancel" class="btn btn-lg btn-danger" onclick="location.reload();"></input>
			</div>
			<div style="margin: 0 auto; width: 50%% ">
				<select style="max-width: 250px;" name="senderVisibility" id="senderVisibility" class="show-tick form-control" data-max-options="1">
				<?php
					
					echo "<option value=\"Y\">".$row['fullName']."</option>";
					echo "<option value=\"N\">Anonymous</option>";
					
				?>
				</select>
				
				<br/>
				<br/>
			</div>
		</div>
		<br/>
	</form>
	
	<div id="requestInfo"></div>
</div>

