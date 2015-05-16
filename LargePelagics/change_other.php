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
$cname = addslashes($_POST['common_name']);
$sql="UPDATE OTHERmeasure 
		SET 
		OTHER_measure_ID = '$_POST[OTHER_measure_ID]',
		species_name = '$_POST[species_name]', 
		common_name = '$cname',
		fl = '$_POST[fl]', 
		tl = '$_POST[tl]',
		gg = '$_POST[gg]', 
		dw = '$_POST[dw]', 
		rw = '$_POST[rw]', 
		sex = '$_POST[sex]', 
		life_status = '$_POST[life_status]', 
		bait_type = '$_POST[bait_type]', 
		commercial = '$_POST[commercial]'
		
	WHERE OTHER_measure_ID = '$_POST[OTHER_measure_ID]'";

if (!mysqli_query($con,$sql))
  {
  die('Error: ' . mysqli_error($con));
  }
  
  

$query="UPDATE users_action_history SET
    action_date = NOW()
    WHERE action_OTHERmeasure = '$_POST[OTHER_measure_ID]'";

if (!mysqli_query($con,$query))
  {
  die('Error: ' . mysqli_error($con));
  }
  else
{
  echo "<img src=\"img/tick.png\" width=\"25\" height=\"25\" /><strong>OTHER measure data  changed succesfully!</strong> <p> You are redirected to homepage... </p><p> <i>if you aren't redirected <a href=\"index.php\">click here</a></i></p>";
header("refresh:5;url=index.php");
} 


mysqli_close($con);
?>

</div>
</body>
</html>