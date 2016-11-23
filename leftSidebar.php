<?php
	$stmt1 = $user_home->runQuery("SELECT * FROM tbl_class_allocation WHERE userID=:uid");
	$stmt1->execute(array(":uid"=>$userID));
	$sentCID = isset($_GET['cid']) ? $_GET['cid'] : '';
?>
<div class="left-box-around mobileNotShow">
	<h3>Active Courses</h3>
	<ul id="ulwala">

<?php
	while ($courses = $stmt1->fetch(PDO::FETCH_ASSOC)){
		//echo $courses['classID'];
		if($sentCID === $courses['classID']){
			echo "<li id=\"liactivewala\"><a href=\"showCourse.php?cid=".$courses['classID']."\">".$courses['classID']."</a></li>";
			
		}
		else{
			echo "<li id=\"liwala\"><a href=\"showCourse.php?cid=".$courses['classID']."\">".$courses['classID']."</a></li>";
		}
	}
?>

	</ul>
	<hr>
	<h3>Suggested Courses</h3>
	<p>Based on a search algorithm this section could be populated</p>
	
</div>
