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
    	          <h2>EDIT OTHER measure SIZE DATA</h2>
                  
                  <?php
				  		$name = $_GET['id'];
						$sql="SELECT * FROM OTHERmeasure WHERE OTHER_measure_ID = '$name'";
						$result = mysqli_query($con, $sql);
						$row = mysqli_fetch_array($result);
				  
				  ?>
                  
    	          <form action="change_other.php" method="post" >
                  <table width="100%" border="0" cellpadding="0" cellspacing="0">
                  	<tr><th>Change the fields you want and press submit</th></tr>
                    <tr><td>OTHER measure ID:</td>			<td><input type="text" name="OTHER_measure_ID" value=" <?php echo $row['OTHER_measure_ID'];?>" readonly></td></tr>
                    <tr><td>Species name:</td> 	<td><input type="text" name="species_name" value=" <?php echo $row['species_name'];?>"></td></tr>
                    <tr><td>Common name:</td> 	<td><input type="text" name="common_name" value=" <?php echo $row['common_name'];?>"></td></tr>
                    <tr><td>Fl:</td> 	<td><input type="text" name="fl" value=" <?php echo $row['fl'];?>"></td></tr>
                    <tr><td>Tl:</td> 	<td><input type="text" name="tl" value=" <?php echo $row['tl'];?>"></td></tr>
                    <tr><td>GG:</td> 	<td><input type="text" name="gg" value=" <?php echo $row['gg'];?>"></td></tr>
                    <tr><td>DW:</td> 			<td><input type="text" name="dw" value=" <?php echo $row['dw'];?>"></td></tr>
                    <tr><td>RW:</td>		<td><input type="text" name="rw" value=" <?php echo $row['rw'];?>"></td></tr>
                    <tr><td>Sex:</td> 			<td><input type="text" name="sex" value=" <?php echo $row['sex'];?>"></td></tr>
                    <tr><td>Life status:</td>		<td><input type="text" name="life_status" value=" <?php echo $row['life_status'];?>"></td></tr>
                    <tr><td>Bait type:</td> 			<td><input type="text" name="bait_type" value=" <?php echo $row['bait_type'];?>"></td></tr>
                    <tr><td>Commercial:</td>		<td><input type="text" name="commercial" value=" <?php echo $row['commercial'];?>"></td></tr>
                    <tr><td><input type="submit" id="button" name="Submit"></td></tr>
                  </table>
				  </form>
                  </div>
		</div>
        <?php }

       else 
       {
       	echo "You have to login to see this page!";
       }      ?>
    <div id="footer"><a href="help/index.html" target="_blank">HELP</a></div>
</div>
</body>
</html>