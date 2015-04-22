<?php session_start(); 
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
<link href='css/redmond/jquery-ui-1.10.3.custom.min.css' rel="stylesheet" type="text/css" />
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="js/jquery-ui.js"></script>
<script src="js/jquery-ui-timepicker.js"></script>
</head>

<body>
<div id="wrapper">
	<div id="header">
        <blockquote><h1>Large Pelagic Database</h1></blockquote>
        <blockquote><h2><a href="index.php">Home</a></h2></blockquote>
		   <?php
           require_once("loginform.php");
           require_once("dbcon.php");
           ?>
    </div>
    <div id="main"></div>
    	<div id="menu">
     <?php
	 require_once("menu.php");
	 if($privcheck == "admin" || $privcheck == "moderator" || $privcheck == "user" && $usercheck != "" && $usercheck != NULL) 
					 {
	  ?></div>
			
	<div id="content">
        <div class="left">
        <h2>Edit Species</h2>
        <?php
        	$sql = "SELECT * FROM species";
			$result = mysqli_query($con, $sql);
			echo "<div id=\"scrollit\">";
			echo "<table id=\"results\">
			<tr>
			<th>scientific</th>
			<th>common</th>
			<th colspan=\"2\">Edit</th>
			</tr>";
			
			
			while($row = mysqli_fetch_array($result))
			  {
			  echo "<tr>";
			  echo "<td>" . $row['scientific'] . "</td>";
			  echo "<td>" . $row['common'] . "</td>";
			  $name = $row['common'];
			  echo "<td><a href=remove_species.php?name=" . urlencode($name) . ">Remove Entry</a></td>";
			  echo "</tr>";
			  }
			  
			echo "</table>";
			echo "</div>";
		?>

      	<h2>Insert new species</h2>
        <form action="insert_species.php" method="post" >
                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr><td>Scientific:</td>			<td><input type="text" name="scientific"></td></tr>
                <tr><td>Common:</td> 					<td><input type="text" name="common"></td></tr>
                <tr><td><input type="submit" id="button" name="Submit"></td></tr>
                </table>
        </form>
        
        </div>
        <div class="center">
        <h2>Edit Gears</h2>
        <?php
					 
			$sql = "SELECT * FROM gears";
			
			$result = mysqli_query($con, $sql);
			echo "<table id=\"results\">
			<tr>
			<th>Name</th>
			<th>Code</th>
			<th colspan=\"2\">Edit</th>
			</tr>";
			while($row = mysqli_fetch_array($result))
			  {
			  echo "<tr>";
			  echo "<td>" . $row['name'] . "</td>";
			  echo "<td>" . $row['code'] . "</td>";
			  echo "<td><a href=remove_gear.php?name=" . $row['code'] . ">Remove Entry</a></td>";
			  echo "</tr>";
			  }
			echo "</table>";
		?>
        <h2>Insert new gears</h2>
        <form action="insert_gears.php" method="post" >
                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr><td>Name:</td>			<td><input type="text" name="name"></td></tr>
                <tr><td>Code:</td> 					<td><input type="text" name="code"></td></tr>
                <tr><td><input type="submit" id="button" name="Submit"></td></tr>
                </table>
        </form>
        </div>
        
        <div class="right">
        <h2>Edit Ports</h2>
        <?php
					 
			$sql = "SELECT * FROM ports";
			
			$result = mysqli_query($con, $sql);
			echo "<table id=\"results\">
			<tr>
			<th>Name</th>
			<th>Code</th>
			<th colspan=\"2\">Edit</th>
			</tr>";
			while($row = mysqli_fetch_array($result))
			  {
			  echo "<tr>";
			  echo "<td>" . $row['name'] . "</td>";
			  echo "<td>" . $row['code'] . "</td>";
			  echo "<td><a href=remove_port.php?name=" . $row['code'] . ">Remove Entry</a></td>";
			  echo "</tr>";
			  }
			echo "</table>";
		?><br /><br />
        <h2>Insert new ports</h2>
        <form action="insert_ports.php" method="post" >
                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr><td>Name:</td>			<td><input type="text" name="name"></td></tr>
                <tr><td>Code:</td> 					<td><input type="text" name="code"></td></tr>
                <tr><td><input type="submit" id="button" name="Submit"></td></tr>
                </table>
        </form>
        <?php }

       else 
       {
       	echo "You have to login to see this page!";
       }      ?>
        </div>
        
        
        
    </div>
</div>

</body>
</html>