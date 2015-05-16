<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Large Pelagic Database</title>
<link href="style.css" rel="stylesheet" type="text/css" /></head><body>
<div id="redirect">
<?php

session_start(); 
if(isset($_SESSION['sess_username']) && isset($_SESSION['sess_privileges']))
{
$usercheck = $_SESSION['sess_username'];
$privcheck = $_SESSION['sess_privileges'];
}
else {
	$privcheck=1;
	$usercheck=0;
	}
require_once('dbcon.php');
//$counter=$_POST['counter'];
//for($i=0; $i<$counter; $i++){
$ALB_measure_ID=$_POST['ALB_measure_ID'];
$fl=$_POST['fl'];
$gg=$_POST['gg'];
$dw=$_POST['dw'];
$rw=$_POST['rw'];
$sex=$_POST['sex'];
$matur_stage=$_POST['matur_stage'];
$gon_wei=$_POST['gon_wei'];
$life_status=$_POST['life_status'];
$bait_type=$_POST['bait_type'];
$commercial=$_POST['commercial'];
$sql="UPDATE ALBmeasure 
		SET 
		ALB_measure_ID = '$ALB_measure_ID',
		fl = '$fl', 
		gg = '$gg', 
		dw = '$dw', 
		rw = '$rw', 
		sex = '$sex', 
		matur_stage = '$matur_stage', 
		gon_wei = '$gon_wei', 
		life_status = '$life_status', 
		bait_type = '$bait_type', 
		commercial = '$commercial'
		
	WHERE ALB_measure_ID = '$ALB_measure_ID'";

if (!mysqli_query($con,$sql))
  {
  die('Error: ' . mysqli_error($con));
  }
  
  

$query="INSERT INTO users_action_history (action_ID, action_username, action_ALBmeasure, action_date)
VALUES
(NULL, '$usercheck', '$ALB_measure_ID', NOW())";

if (!mysqli_query($con,$query))
  {
  die('Error: ' . mysqli_error($con));
  }
//}
echo "<img src=\"img/tick.png\" width=\"25\" height=\"25\" /><strong>ALB measure data  changed succesfully!</strong> <p> You are redirected to homepage... </p><p> <i>if you aren't redirected <a href=\"index.php\">click here</a></i></p>";
header("refresh:5;url=index.php");



mysqli_close($con);
?>

</div>
</body>
</html>