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
if(!empty($_GET['action'])){
    $id=$_GET['id'];
    $delete="DELETE FROM expedition WHERE expedition_ID='$id'";
    $delres=  mysqli_query($con, $delete);
    if(mysqli_error($con)){
        die('Error: ' . mysqli_error($con));
    }
    $delaction="DELETE FROM users_action_history WHERE action_eexpedition_ID='$id'";
    $delres2=  mysqli_query($con, $delaction);
    if(mysqli_error($con)){
        die('Error: ' . mysqli_error($con));
    }
} else {
$sql="UPDATE expedition 
		SET 
		expedition_ID = '$_POST[expedition_ID]',
		deployDate = '$_POST[deployDate]', 
		returnDate = '$_POST[returnDate]', 
		Hooks_day = '$_POST[Hooks_day]', 
		FishingDays = '$_POST[FishingDays]', 
		Effort = '$_POST[Effort]', 
		Gear = '$_POST[Gear]', 
		Detail_Area = '$_POST[Detail_Area]', 
		StartSettingtime = '$_POST[StartSettingTime]', 
		StartLat = '$_POST[StartLat]', 
		StartLON = '$_POST[StartLON]',
		EndSetTime = '$_POST[EndSetTime]',
		EndLAT = '$_POST[EndLAT]', 
		EndLON = '$_POST[EndLON]', 
		StartHaulTime = '$_POST[StartHaulTime]', 
		StartLATHaul = '$_POST[StartLATHaul]', 
		StartLONHaul = '$_POST[StartLONHaul]', 
		EndHaulTime = '$_POST[EndHaulTime]', 
		EndLATHaul = '$_POST[EndLATHaul]', 
		EndLONHaul = '$_POST[EndLONHaul]', 
		Lightsticks = '$_POST[Lightsticks]', 
		InfoOrigin = '$_POST[InfoOrigin]',
		Comments = '$_POST[Comments]'
		
	WHERE expedition_ID = '$_POST[expedition_ID]'";

if (!mysqli_query($con,$sql))
  {
  die('Error: ' . mysqli_error($con));
  }
  
  

$query="INSERT INTO users_action_history (action_ID, action_username, action_eexpedition_ID, action_date)
VALUES
(NULL, '$usercheck', '$_POST[expedition_ID]', NOW())";

if (!mysqli_query($con,$query))
  {
  die('Error: ' . mysqli_error($con));
  }
}
if(mysqli_error($con)){
    die('Error: ' . mysqli_errno($con));
} else
{
  echo "<img src=\"img/tick.png\" width=\"25\" height=\"25\" /><strong>Expedition data  changed succesfully!</strong> <p> You are redirected to homepage... </p><p> <i>if you aren't redirected <a href=\"index.php\">click here</a></i></p>";
header("refresh:5;url=index.php");
} 


mysqli_close($con);
?>

</div>
</body>
</html>