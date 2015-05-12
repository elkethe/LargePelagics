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
$counter=$_POST['counter'];
$id=$_POST['size_expedition_ID_1'];
$old="SELECT * FROM expedition_size WHERE size_expedition_ID = '$id'";
$oldq=  mysqli_query($con, $old);
$x=1;
while($oldrow=mysqli_fetch_array($oldq)){
    $oldspecies[$x]= $oldrow['species'];
    $x++;
}
for($i=1; $i<=$counter; $i++){
$size_expedition_ID=$_POST['size_expedition_ID_'.$i];
$weight=$_POST['weight_'.$i];
$num=$_POST['num_'.$i];
$species=$_POST['species_'.$i];
$commercial=$_POST['commercial_'.$i];
$old_species=$oldspecies[$i];
$uord=$_POST['update_'.$i];
if($uord=="update"){
$sql="UPDATE expedition_size
		SET 
		size_expedition_ID = '$size_expedition_ID',
		weight = '$weight', 
		num = '$num', 
		species = '$species',
                commercial = '$commercial'
		
	WHERE species='$old_species' AND size_expedition_ID = '$size_expedition_ID'";

if (!mysqli_query($con,$sql))
  {
  die($i . 'Error: ' . mysqli_error($con));
  }
} else {
    $sql="DELETE FROM expedition_size WHERE species='$old_species' AND size_expedition_ID = '$size_expedition_ID'";

if (!mysqli_query($con,$sql))
  {
  die($i . 'Error: ' . mysqli_error($con));
  }
  $query = "DELETE FROM users_action_history WHERE action_size_expedition_ID = '$size_expedition_ID'";
  if (!mysqli_query($con,$query))
  {
  die('Error: ' . mysqli_error($con));
  }
}
}  

if (!mysqli_query($con,$query))
  {
  die('Error: ' . mysqli_error($con));
  }
  else
{
  echo "<img src=\"img/tick.png\" width=\"25\" height=\"25\" /><strong>Expedition size data  changed succesfully!</strong> <p> You are redirected to homepage... </p><p> <i>if you aren't redirected <a href=\"index.php\">click here</a></i></p>";
//header("refresh:5;url=index.php");
} 


mysqli_close($con);
?>

</div>
</body>
</html>