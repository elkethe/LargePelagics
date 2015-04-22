<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Large Pelagic Database</title>
<link href="style.css" rel="stylesheet" type="text/css" /></head><body>
<div id="redirect">
<?php
session_start();
$username = $_POST['username'];
$password = $_POST['password'];
 
$mysqli = new mysqli('localhost', 'root', 'wtMGqJaF7DWgY', 'ELKETHE_DB');
 
$username = $mysqli->real_escape_string($username);
 
$query = "SELECT password
        FROM users
        WHERE username = '$username';";
 
$result = mysqli_query($mysqli, $query);
 
if($result->num_rows == 0) // User not found. So, redirect to login_form again.
{
	die("Username not found");
}
$passcheck = mysqli_fetch_array($result);

 
if($password != $passcheck['0']) // Incorrect password. So, redirect to login_form again.
{
    die ("Wrong Password! <a href=\"index.php\">Go Back!</a>");
	
}else{ // Redirect to home page after successful login.
	$query = "SELECT username, privileges FROM users WHERE username = '$username';";
	$result = mysqli_query($mysqli, $query);
	$forsession = mysqli_fetch_array($result);
	session_regenerate_id();
	$_SESSION['sess_username'] = $forsession['0'];
	$_SESSION['sess_privileges'] = $forsession['1'];
	$updatedbq = "UPDATE users SET last_login = NOW() WHERE username = '$username';";
	$updatedb = mysqli_query($mysqli, $updatedbq);
	echo "<img src=\"img/login.png\" width=\"25\" height=\"25\" /><strong>Succesfully logged in as <i>" . $username . "</i></strong> <p> You are redirected to homepage... </p><p> <i>if you aren't redirected <a href=\"index.php\">click here</a></i></p>";
	header("refresh:2;url=index.php");
}
?>
</div>
</body></html>
