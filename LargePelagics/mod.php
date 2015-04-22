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
require_once("dbcon.php");
$takeusers="SELECT username FROM users";
$resulttu=mysqli_query($con, $takeusers);
$userscounter=0;
while($row=mysqli_fetch_array($resulttu)){
    $usernames[$userscounter] = $row['username'];
    $userscounter++;
}
for($i=0; $i<$userscounter; $i++){
    if($usernames[$i]==$_POST['username']){
        die('<img src="img/xi.png" width="25" height="25" />Given username already exists in database! <a href="createmod.php">Select another username!</a>');
    }
}
$sql="INSERT INTO users (username, password, privileges)
VALUES
('$_POST[username]','$_POST[password]','moderator')";

$newaction = "INSERT INTO users_action_history (action_username, action_newuser, action_date)
VALUES
('$usercheck','$_POST[username]', NOW())";
if (!mysqli_query($con,$sql))
  {
  die('Error: ' . mysqli_error($con));
  }elseif (!mysqli_query($con,$newaction))
  {
	  die('Error: ' . mysqli_error($con));
  }else {
	  echo "<img src=\"img/tick.png\" width=\"25\" height=\"25\" /><strong>New moderator created succesfully! New moderator username: <i>" . $_POST['username'] ."</i></strong> <p> You are redirected to homepage... </p><p> <i>if you aren't redirected <a href=\"index.php\">click here</a></i></p>";
	header("refresh:3;url=index.php");
  }

mysqli_close($con);
?>
</div>
</body></html>