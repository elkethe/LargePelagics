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
<script type="text/javascript">
function check()
{
var user=document.forms["loginform"]["username"].value;
if (user==null || user=="")
  {
  alert("Ξέχασες να βάλεις username!");
  return false;
  }
var pass=document.forms["loginform"]["password"].value;
if (pass==null || pass=="")
  {
  alert("Ξέχασες να βάλεις password!");
  return false;
  }
}
</script>

</head>
<body>
<div id="wrapper">
	<div id="header">
        <blockquote><h1>Large Pelagic Database</h1></blockquote>
        <blockquote><h2><a href="index.php">Home</a></h2></blockquote>
       <?php require_once("loginform.php");?>
    </div>
    <div id="main"></div>
    	<div id="menu">
     <?php
	 require_once("menu.php");
	 require_once("dbcon.php");
	 if($privcheck == "admin" || $privcheck == "moderator" || $privcheck == "user" && $usercheck != "" && $usercheck != NULL) 
					 {
	  ?></div>
        <div id="content">
    	          <h2>Edit Expedition Data</h2>
                  
                  <?php
				  		$name = $_GET["id"];
						$sql="SELECT * FROM expedition WHERE expedition_ID = '$name'";
						$result = mysqli_query($con, $sql);
						$row = mysqli_fetch_array($result);
				  
				  ?>
                  
    	          <form action="change_exp.php" method="post" >
                  <table width="100%" border="0" cellpadding="0" cellspacing="0">
                  	<tr><th>Change the fields you want and press submit</th></tr>
                    <tr><td>expedition_ID:</td>			<td><input type="text" name="expedition_ID" value=" <?php echo $row['expedition_ID'];?>" readonly /></td></tr>
                    <tr><td>deployDate:</td> 	<td><input type="text" name="deployDate" value=" <?php echo $row['deployDate'];?>" /></td></tr>
                    <tr><td>returnDate:</td> 	<td><input type="text" name="returnDate" value=" <?php echo $row['returnDate'];?>" /></td></tr>
                    <tr><td>Hooks day:</td> 			<td><input type="text" name="Hooks_day" value=" <?php echo $row['Hooks_day'];?>" /></td></tr>
                    <tr><td>Fishing days:</td>		<td><input type="text" name="FishingDays" value=" <?php echo $row['FishingDays'];?>"></td></tr>
                    <tr><td>Effort:</td> 			<td><input type="text" name="Effort" value=" <?php echo $row['Effort'];?>"></td></tr>
                    <tr><td>Gear:</td> 			<td><input type="text" name="Gear" value=" <?php echo $row['Gear'];?>"></td></tr>
                    <tr><td>Detail Area:</td> 			<td><input type="text" name="Detail_Area" value=" <?php echo $row['Detail_Area'];?>"></td></tr>
                    <tr><td>Start Setting time:</td> 			<td><input type="text" name="StartSettingTime" value=" <?php echo $row['StartSettingTime'];?>"></td></tr>
                    <tr><td>Start Lat:</td>				<td><input type="text" name="StartLat" value=" <?php echo $row['StartLat'];?>"></td></tr>
                    <tr><td>Start LON:</td> 	<td><input type="text" name="StartLON" value=" <?php echo $row['StartLON'];?>"></td></tr>
                    <tr><td>End Setting Time:</td> 	<td><input type="text" name="EndSetTime" value=" <?php echo $row['EndSetTime'];?>"></td></tr>
                    <tr><td>EndLAT:</td>			<td><input type="text" name="EndLAT" value=" <?php echo $row['EndLAT'];?>"></td></tr>
                    <tr><td>EndLON:</td> 	<td><input type="text" name="EndLON" value=" <?php echo $row['EndLON'];?>"></td></tr>
                    <tr><td>StartHaulTime:</td> 	<td><input type="text" name="StartHaulTime" value=" <?php echo $row['StartHaulTime'];?>"></td></tr>
                    <tr><td>StartLATHaul:</td> 			<td><input type="text" name="StartLATHaul" value=" <?php echo $row['StartLATHaul'];?>"></td></tr>
                    <tr><td>StartLONHaul:</td>		<td><input type="text" name="StartLONHaul" value=" <?php echo $row['StartLONHaul'];?>"></td></tr>
                    <tr><td>EndHaulTime:</td> 			<td><input type="text" name="EndHaulTime" value=" <?php echo $row['EndHaulTime'];?>"></td></tr>
                    <tr><td>EndLATHaul:</td> 			<td><input type="text" name="EndLATHaul" value=" <?php echo $row['EndLATHaul'];?>"></td></tr>
                    <tr><td>EndLONHaul:</td> 			<td><input type="text" name="EndLONHaul" value=" <?php echo $row['EndLONHaul'];?>"></td></tr>
                    <tr><td>Lightsticks:</td> 			<td><input type="text" name="Lightsticks" value=" <?php echo $row['Lightsticks'];?>"></td></tr>
                    <tr><td>InfoOrigin:</td>				<td><input type="text" name="InfoOrigin" value=" <?php echo $row['InfoOrigin'];?>"></td></tr>
                    <tr><td>Comments:</td> 	<td><input type="text" name="Comments" value=" <?php echo $row['Comments'];?>" size="50"></td></tr>
                    <tr><td><input type="submit" id="button" name="Submit"></td></tr>
                  </table>
				  </form>
                  </div>
		</div>
                                                <?php 
                                                
                                                }

       else 
       {
       	echo "You have to login to see this page!";
       }      ?>
    <div id="footer"><a href="help/index.html" target="_blank">HELP</a></div>
</div>
</body>
</html>