<?php session_start(); 
$usercheck = $_SESSION['sess_username'];
$privcheck = $_SESSION['sess_privileges'];?>
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
        <h1>Large Pelagic Database</h1>
        <h2><a href="index.php">Home</a></h2>
    </div>
    <div id="main">
    	<div id="menu"> <div id="menu-top">Login</div>
     <?php
	 require_once("loginform.php");
	  ?></div>
    	        <div id="content">
                <?php
				$menu = $_GET['menu'];
				$action = $_GET['action'];
				if ($menu != $privcheck)
				{
					die ("Permission denied! <a href=\"index.php\">Go to homepage</a>");
				}
				if($menu == "user")
				switch ($menu)
				{
					case "user":
						
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