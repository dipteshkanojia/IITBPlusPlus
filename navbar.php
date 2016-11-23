<?php

	$ext = pathinfo($filename, PATHINFO_FILENAME);

	$userID = $row['userID'];
	$stmt1 = $user_home->runQuery("SELECT * FROM tbl_class_allocation WHERE userID=:uid");
	$stmt1->execute(array(":uid"=>$userID));
	$courseIDviaGET = isset($_GET['cid']) ? $_GET['cid'] : '';
	//echo $courseIDviaGET;
	

?>
<link href="https://fonts.googleapis.com/css?family=Baloo+Bhaina|Delius+Unicase|Trocchi|Bree+Serif|Signika" rel="stylesheet">
<nav class="navbar navbar-default navbar-fixed-top" style="padding-left:2%; padding-right: 2%; padding-bottom: 0px; font-family: 'Baloo Bhaina', cursive;">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="home.php" style="font-family: 'Delius Unicase', cursive;">IIT-B Plus+ Community</a>
    </div>
	
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li <?php if($ext=="home"){ echo "class=\"active\""; } ?>>
			<a href="home.php">Home</a>
		</li>
		<li class="dropdown">
			<?php if($ext=="showCourse"){ $courseVar = 1; } else{ $courseVar = 0; } ?>
			<a href="#" data-toggle="dropdown" class="dropdown-toggle">Courses <b class="caret"></b>
			</a>
			<ul class="dropdown-menu" id="menu1">
			<?php
				while ($courses = $stmt1->fetch(PDO::FETCH_ASSOC)){
					//echo "<li></li>";
					$currentCourse = $courses['classID'];
					if($courseIDviaGET != $currentCourse){
						//echo $courseIDviaGET."<br/>".$courses['classID'];
						//echo $courseIDviaGET;
						//echo $courses['classID'];
						echo "<li style=\"font-family: 'Bree Serif', serif;\"><a href=\"showCourse.php?cid=".$currentCourse."\">".$currentCourse."</a></li>";
						
					}
					else{
						//echo $courses['classID'];
						echo "<li class=\"active\" style=\"font-family: 'Bree Serif', serif;\"><a href=\"showCourse.php?cid=".$currentCourse."\">".$currentCourse."</a></li>";
					}
					
				}
			?>
				<li role="separator" class="divider"></li>
				<li><a href="runningCourses.php">Course Enrollment</a></li>

				
			</ul>
		</li>
		<?php if($row['userStatus'] >= 8){ 
				echo "<li "; 
				if( ($ext=="addcourse") || ($ext=="runAddCourse") ){ 
					echo "class=\"active\""; 
				} 
				echo "><a href=\"addcourse.php\">Add Course</a></li>";  
			}
		?>
		<li <?php if( ($ext=="scheduleMeet") || ($ext=="scheduleMeet") ){ echo "class=\"active\""; } ?>>
			<a href="scheduleMeet.php">Schedule Meeting</a>
		</li>

	</ul>
<!--
      <form class="navbar-form navbar-left">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
-->

	<ul class="nav navbar-nav navbar-right">
		<?php  if( ($ext=="userSettings") || ($ext=="userSettings") ){ echo "<li style=\"font-family: 'Delius Unicase', cursive; font-size: 15px;\" class=\"active\"><a role=\"button\" href=\"#\">Settings</a></li>"; }  ?>
		<?php  if( ($ext=="runningCourses") || ($ext=="runningCourses") ){ echo "<li style=\"font-family: 'Delius Unicase', cursive; font-size: 15px;\" class=\"active\"><a role=\"button\" href=\"#\">Course Enrollment</a></li>"; }  ?>
		<?php if($ext=="showCourse"){ echo "<li class=\"active\" style=\"font-family: 'Delius Unicase', cursive; font-size: 25px;\"><a href=\"#\">".$courseIDviaGET."</a></li>"; } else{ $courseVar = 0; } ?>
		<li class="dropdown">

			<a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"> <i class="glyphicon glyphicon-user">&nbsp;&nbsp;</i> 
				<?php echo $row['fullName']; ?> <i class="caret"></i>
			</a>
				<ul class="dropdown-menu">
					<li>
						<a tabindex="-1" href="userSettings.php"><i class="glyphicon glyphicon-cog">&nbsp;</i>User Settings</a>
					</li>
					<li>
						<a tabindex="-1" href="runningCourses.php"><i class="glyphicon glyphicon-edit">&nbsp;</i>Course Enrollment</a>
					</li>
					<li role="separator" class="divider"></li>
					<li>
						<a tabindex="-1" href="logout.php"><i class="glyphicon glyphicon-log-out">&nbsp;</i>Logout</a>
					</li>
			</ul>
			
		</li>
		
	</ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
