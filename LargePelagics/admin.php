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
	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Large Pelagic Database</title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="wrapper">
	<div id="header">
        <h1>Large Pelagic Database</h1>
        <h2><a href="index.php">Home</a> -> <a href="admin.php">Admin Panel</a></h2>
    </div>
    <div id="main">
    	<div id="menu"> <div id="menu-top">Login</div>
     <?php
	 require_once("loginform.php");
	  ?></div>
    	        <div id="content"><?php 
				if($privcheck == "admin")
				{
					echo '<h2>Online Users</h2>';
					$mysqli = new mysqli("localhost", "root", "george2533", "ELKETHE_DB");
					$onlineq = "SELECT username, privileges, last_login FROM users WHERE last_login > last_logout;";
					$result = mysqli_query($mysqli, $onlineq);
					if($result->num_rows == 0) // User not found. So, redirect to login_form again.
					{
						echo "<i>No users online!</i>";
					}else
					{
						echo "<table id=\"online\">
								<tr>
									<th>username</th>
									<th>Privileges</th>
									<th>Logged in at:</th>
								</tr>";
						while($row = mysqli_fetch_array($result))
						{
							echo "<tr>";
							echo "<td>" . $row['username'] . "</td>";
							echo "<td>" . $row['privileges'] . "</td>";
							echo "<td>" . $row['last_login'] . "</td>";
							echo "</tr>";
						}
						echo "</table>";
				}
				}
					 ?>
    	        </div>
				<?php
	 require_once("menu.php");
	  ?>
  </div>
    <div id="footer"><a href="help/index.html" target="_blank">HELP</a></div>
</div>
</body>
</html>
