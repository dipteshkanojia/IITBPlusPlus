<?php
session_start();
require_once 'class.user.php';
$user_home = new USER();

if(!$user_home->is_logged_in())
{
	$user_home->redirect('index.php');
}

$courseID = isset($_POST['courseID']) ? $_POST['courseID'] : '';

//echo $courseID;

$stmt = $user_home->runQuery("SELECT * FROM tbl_courses WHERE courseID=:cid");
$stmt->execute(array(":cid"=>$courseID));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if(isset($row) && ($row['courseTerm']=="ODD"))
{ 
	$courseTermValue = "Odd Semester Course"; 
} 
else 
	{ 
	$courseTermValue = "Even Semester Course"; 
}
echo "<table class=\"table table-striped table-bordered\"><th colspan=2>Course Information </th><tr><td>Course ID</td><td>".$courseID."</td></tr><tr><td>Course Name</td><td>".$row['courseName']."</td></tr><tr><td>Course Slot</td><td>".$row['courseSlot']."</td></tr><tr><td>Course Instructor</td><td>".$row['facultyID']."</td></tr><tr><td>Course Term</td><td>".$courseTermValue."</td></tr><tr><td>Course Description</td><td>".$row['courseDescription']."</td></tr></table>";

?>
