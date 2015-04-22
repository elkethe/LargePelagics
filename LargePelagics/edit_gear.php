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
<body>
<div id="wrapper">
	<div id="header">
        <blockquote><h1>Large Pelagic Database</h1></blockquote>
        <blockquote><h2><a href="index.php">Home</a></h2></blockquote>
       <?php require_once("loginform.php"); ?>
    </div>
    <div id="main"></div>
    	<div id="menu">
     <?php
	 require_once("menu.php");
	  ?></div>

        
        <div id="content">
    	          <p>INSERT VESSEL DATA</p>
                  <?php $amas = $_GET["takeamas"];?>
    	          <form action="gear.php" method="post" >
                  <table width="100%" border="0" cellpadding="0" cellspacing="0">
                  <td width="100%%" valign="top">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr><th>Gear information</th></tr>
                    <tr><td>Winch type:</td>			<td><input type="text" name="Winch_type"></td></tr>
                    <tr><td>Year:</td>			<td><input type="text" name="year"></td></tr>
                    <tr><td>Float distance:</td>			<td><input type="text" name="float_distance"></td></tr>
                    <tr><td>Branch line distance:</td>			<td><input type="text" name="branch_line_distance"></td></tr>
                    <tr><td>MLdiameter:</td>			<td><input type="text" name="ml_diameter"></td></tr>
                    <tr><td>Blddiameter:</td>			<td><input type="text" name="bl_diameter"></td></tr>
                    <tr><td>BLlength:</td>			<td><input type="text" name="bl_length"></td></tr>
                    <tr><td>FloatLength:</td>			<td><input type="text" name="float_length"></td></tr>
                    <tr><td>Hooks/Set:</td>			<td><input type="text" name="hooks_set"></td></tr>
                    <tr><td>Hooks number:</td>			<td><input type="text" name="hooks_no"></td></tr>
                    <tr><td>Extra Comments:</td>			<td><input type="textarea"  name="extra_comments"></td></tr>
                    <tr><td><input type="hidden" name="takeamas" value="<?php echo $amas;?>" /></td></tr>
                    <tr><td><input type="submit" id="button" name="Submit"></td></tr>
					</table>
                   </td>
                   </table>
				  </form>
                  </div>
		</div>
    <div id="footer"><a href="help/index.html" target="_blank">HELP</a></div>
</div>
</body>
</html>