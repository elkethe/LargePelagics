<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Large Pelagic Database</title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body><div id="redirect">
<?php
session_start();
$mysqli = new mysqli('localhost', 'root', 'wtMGqJaF7DWgY', 'ELKETHE_DB');
$username = $_SESSION['sess_username'];
$updatedbq = "UPDATE users SET last_logout = NOW() WHERE username = '$username';";
$updatedb = mysqli_query($mysqli, $updatedbq);
unset($_SESSION['sess_username']);
unset($_SESSION['sess_privileges']);
if(isset($_SESSION['sess_privileges']) || isset($_SESSION['sess_username']))
{
	session_destroy;
}

echo "<img src=\"img/logout.png\" width=\"25\" height=\"25\" /><strong>Succesfully logged out!</strong> <p> You are redirected to homepage... </p><p> <i>if you aren't redirected <a href=\"index.php\">click here</a></i></p>";
header("refresh:5;url=index.php");
?>
</div>
</body>
</html>
