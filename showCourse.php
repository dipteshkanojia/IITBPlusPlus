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
$sentCID = isset($_GET['cid']) ? $_GET['cid'] : '';
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
		<script>
			
			function showNewPost(){
				$( "#createThread" ).hide();
				var xmlhttp;
				var sentCID = $('#sentCID').val();
				if (window.XMLHttpRequest){
					xmlhttp=new XMLHttpRequest(); // code for IE7+, Firefox, Chrome, Opera, Safari
				}
				else{
					xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); // code for IE6, IE5
				}
		
				xmlhttp.onreadystatechange=function(){
					if (xmlhttp.readyState==4 && xmlhttp.status==200){
						$('#createThread').html(xmlhttp.responseText);
						//document.getElementById("createThread").innerHTML=xmlhttp.responseText;
						//document.getElementById("submit").className = "hidden";
						$("#createThread").show(1000);
					}
				}
				xmlhttp.open("POST","newPost.php",true);
				xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
				xmlhttp.send("sentCID=" + sentCID);
			}
			
			function replyToPost(replyObj){
				var xmlhttp;
				$("#responseTo" + replyTo).hide();
				$('#createThread').hide(1000);
				$('#createThread').html("");
				var sentCID = $('#sentCID').val();
				var button = replyObj.getAttribute('id');
				var replyTo = button.replace("button", "");
				//~ alert(replyTo);
				if (window.XMLHttpRequest){
					xmlhttp=new XMLHttpRequest(); // code for IE7+, Firefox, Chrome, Opera, Safari
				}
				else{
					xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); // code for IE6, IE5
				}
		
				xmlhttp.onreadystatechange=function(){
					if (xmlhttp.readyState==4 && xmlhttp.status==200){
						$("#"+button).hide(1000);
						$('#responseTo' + replyTo).html(xmlhttp.responseText);
						//document.getElementById("responseTo" + replyTo).innerHTML=xmlhttp.responseText;
						//document.getElementById(button).className = "hidden";
						$('#responseTo' + replyTo).show(1000);
					}
				}
				xmlhttp.open("POST","newPost.php",true);
				xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
				xmlhttp.send("sentCID=" + sentCID + "&replyTo=" + replyTo);
			}
			
			function createPost(replyTo){
				//alert("asd");
				//alert(replyTo);
				if(replyTo==0){
					if($('#postSummary').val() != '' && $('#postContent').val() != ''){
						$('#createThread').hide();
						var xmlhttp;
						var postType = $('.radButton:checked').val();
						var postSummary = $('#postSummary').val();
						var postContent = $('#postContent').val();
						var senderId = $('#senderId').val();
						var senderVisibility = $('#senderVisibility').val();
						var courseID = $('#courseID').val();
						//alert(courseID);
						var media = "NULL";
						if (window.XMLHttpRequest){
							xmlhttp=new XMLHttpRequest(); // code for IE7+, Firefox, Chrome, Opera, Safari
						}
						else{
							xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); // code for IE6, IE5
						}
						
						xmlhttp.onreadystatechange=function(){
							if (xmlhttp.readyState==4 && xmlhttp.status==200){
								$('#createThread').html(xmlhttp.responseText);
								$('#createThread').show(1000);
							}
						}
						xmlhttp.open("POST","createPost.php",true);
						xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
						xmlhttp.send("postType=" + postType + "&postSummary=" + postSummary + "&postContent=" + postContent + "&replyTo=0&senderId=" + senderId + "&senderVisibility=" + senderVisibility + "&media=" + media + "&courseID=" + courseID);
					}
					else{
						alert("Post Topic OR Post Content cannot be empty!");
					}
				}
				else{
					//alert("aassad");
					$('#createThread').hide(500);
					$('#createThread').html("");
					if($('#postSummary'+replyTo).val() != '' && $('#postContent'+replyTo).val() != ''){
						var xmlhttp;
						var divs = document.getElementsByTagName('div');
						for(var i = 0; i < 10; i++) {
							var idmatch = divs[i].id.match(/div[0-9]*/g);
							if(idmatch){
								alert(idmatch);
							}
						}
						var postType = $('.radButton:checked').val();
						var postSummary = $('#postSummary'+replyTo).val();
						var postContent = $('#postContent'+replyTo).val();
						alert(postSummary);
						alert(postContent);
						alert(replyTo);
						var senderId = $('#senderId').val();
						var senderVisibility = $('#senderVisibility').val();
						var courseID = $('#courseID').val();
						//alert(courseID);
						var media = "NULL";
						if (window.XMLHttpRequest){
							xmlhttp=new XMLHttpRequest(); // code for IE7+, Firefox, Chrome, Opera, Safari
						}
						else{
							xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); // code for IE6, IE5
						}
						
						xmlhttp.onreadystatechange=function(){
							if (xmlhttp.readyState==4 && xmlhttp.status==200){
								//$('#createThread').html(xmlhttp.responseText);
								$('#createThread').show(1000);
								location.reload();
							}
						}
						xmlhttp.open("POST","createPost.php",true);
						xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
						xmlhttp.send("postType=" + postType + "&postSummary=" + postSummary + "&postContent=" + postContent + "&replyTo=" + replyTo + "&senderId=" + senderId + "&senderVisibility=" + senderVisibility + "&media=" + media + "&courseID=" + courseID);
					}
					else{
						alert("Post Topic OR Post Content cannot be empty!");
					}
				}
			}
			
			function showAllPosts(threadObj) {
				var threadId = threadObj.getAttribute('id');
				//alert(threadID);
				var xmlhttp;
					if (window.XMLHttpRequest){
						xmlhttp=new XMLHttpRequest(); // code for IE7+, Firefox, Chrome, Opera, Safari
					}
					else{
						xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); // code for IE6, IE5
					}
				
					xmlhttp.onreadystatechange=function(){
						if (xmlhttp.readyState==4 && xmlhttp.status==200){
							document.getElementById("posts").innerHTML=xmlhttp.responseText;
							$('#createThread').hide(1000);
						}
					}
					xmlhttp.open("POST","getPostData.php",true);
					xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
					xmlhttp.send("threadId=" + threadId);
					
			}
			function dropCourse() {
				var sentCID = $('#sentCID').val();
				if(confirm("Do you really want to drop " + sentCID + " ?")){
					//alert("Drop");
					var xmlhttp;
					if (window.XMLHttpRequest){
						xmlhttp=new XMLHttpRequest(); // code for IE7+, Firefox, Chrome, Opera, Safari
					}
					else{
						xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); // code for IE6, IE5
					}
				
					xmlhttp.onreadystatechange=function(){
						if (xmlhttp.readyState==4 && xmlhttp.status==200){
							alert(xmlhttp.responseText);
							window.location.href= "home.php";
						}
					}
					xmlhttp.open("POST","dropCourse.php",true);
					xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
					xmlhttp.send("sentCID=" + sentCID);
				}
			}
			
		</script>
		
	</head>
	
	<body>
		<?php include 'navbar.php' ?>
		<?php include 'leftSidebar.php' ?>
		<!--/.fluid-container-->
		<input type="hidden" id="sentCID" value="<?php echo $sentCID; ?>"></input>
		<div class="container">
			<div class="box-around">
				<input type="button" class="btn btn-lg btn-success" value="Create Thread" onclick="showNewPost();"></input>
				<input type="button" class="btn btn-lg btn-danger" value="Drop Course" style=\"float: right;\" onclick="dropCourse();"></input>
			</div>
			<?php //echo $sentCID; 
				echo "<div id=\"createThread\"></div>";
			?>
			<div>
				<?php
					$stmtToCheckIfEnrolled = $user_home->runQuery("SELECT * FROM tbl_class_allocation WHERE classID=:classID AND userID=:userID");
					$res = $stmtToCheckIfEnrolled->execute(array(":classID"=>$sentCID, ":userID"=>$_SESSION['userSession']));
					
					if($stmtToCheckIfEnrolled->rowCount() > 0) { 
						$stmt = $user_home->runQuery("SELECT * FROM tbl_thread WHERE courseID=:courseID ORDER BY threadId DESC");
						$res = $stmt->execute(array(":courseID"=>$sentCID));
						if($stmt->rowCount() > 0) { ?> 
						<div id="threads" class="post-box-left">
							<center><h4>Current Threads</h4></center>
							<br/>
						<?php
							while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
								$stmtGetPostData = $user_home->runQuery("SELECT * FROM tbl_post WHERE postId=:postId");
								$res = $stmtGetPostData->execute(array(":postId"=>$row['postId']));
								$rowForPostData = $stmtGetPostData->fetch(PDO::FETCH_ASSOC);
								
								echo "<div class=\"threadBox\" id=\"".$row['threadId']."\" onclick=\"showAllPosts(this)\"><a class=\"btn btn-lg btn-primary\" href=\"#\" style=\"text-decoration: none; width: 100%; min-height: 80px; white-space: normal;\">".$rowForPostData['postSummary']."</a></div>";
								
							}
						?>
						
						
					
					
				
				</div>
				<div id="posts" class="post-box-right"><h3>Click on a thread to show posts!</h3></div>
				
				<?php } 
					else { ?>
						
						<div id="nothreads" class="wide-box-around"><h3>No Threads running for this course!</h3></div>
				<?php
					}
				} else { ?>
					<div id="nothreads" class="wide-box-around"><h3>You are not enrolled for this course!</h3></div>
				<?php 
				
				}
				
				?>
			</div>
		</div>
		
		
	</body>
	<?php include 'footer.php' ?>

</html>
