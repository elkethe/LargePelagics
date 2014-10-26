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

$sql="INSERT INTO vessel (AMAS, vessel_name, reg_no_state, port, port_area, grt, vl, vlc, vw, hp, navigation, communication)
VALUES
('$_POST[amas]','$_POST[vessel_name]','$_POST[reg_no_state]','
  $_POST[port]','$_POST[port_area]','$_POST[grt]','
  $_POST[vl]','$_POST[vlc]','$_POST[vw]','
  $_POST[hp]','$_POST[navigation]','$_POST[communication]')";

if (!mysqli_query($con,$sql))
  {
  die('Error: ' . mysqli_error($con));
  }
  
  
  $sql="INSERT INTO production_ID (AMAS)
VALUES
('$_POST[amas]')";

if (!mysqli_query($con,$sql))
{
die('3Error: ' . mysqli_error($con));
}else{
$lastId1 = $con->insert_id;
}

$sql="INSERT INTO production (production_ID, year, SWOproduction, ALBproduction, BFTproduction, RVTproduction, fishing_days, 
wtc, bait)
VALUES
($lastId1,'$_POST[year]','$_POST[SWOproduction]','$_POST[ALBproduction]','
  $_POST[BFTproduction]','$_POST[RVTproduction]','$_POST[fishing_days]','
  $_POST[wtc]','$_POST[bait]')";

if (!mysqli_query($con,$sql))
  {
  die('Error: ' . mysqli_error($con));
  }
  

  $sql="INSERT INTO dynamic_vessel_ID (AMAS)
VALUES
('$_POST[amas]')";

if (!mysqli_query($con,$sql))
{
die('3Error: ' . mysqli_error($con));
}else{
$lastId = $con->insert_id;
}

$sql="INSERT INTO dynamic_vessel (vessel_production_ID, Winch_type, year, float_distance, branch_line_distance, ml_diameter, bl_diameter, bl_length, float_length, hooks_set, hooks_no, extras)
VALUES
($lastId,'$_POST[Winch_type]','$_POST[year]','$_POST[float_distance]','
  $_POST[branch_line_distance]','$_POST[ml_diameter]','$_POST[bl_diameter]','
  $_POST[bl_length]','$_POST[float_length]','$_POST[hooks_set]','$_POST[hooks_no]','$_POST[extra_comments]')";

if (!mysqli_query($con,$sql))
  {
  die('Error: ' . mysqli_error($con));
  }
  

$query="INSERT INTO users_action_history (action_ID, action_username, action_AMAS, action_vproduction_ID, action_pproduction_ID, action_date)
VALUES
(NULL, '$usercheck', '$_POST[amas]', '$lastId', '$lastId1', NOW())";

if (!mysqli_query($con,$query))
  {
  die('Error: ' . mysqli_error($con));
  }
  else
{
  echo "<img src=\"img/tick.png\" width=\"25\" height=\"25\" /><strong>Vessel data stored succesfully!</strong> <p> You are redirected to homepage... </p><p> <i>if you aren't redirected <a href=\"index.php\">click here</a></i></p>";
header("refresh:5;url=index.php");
} 


mysqli_close($con);
?>

</div>
</body>
</html>