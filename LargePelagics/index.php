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
       <?php //require_once("loginform.php"); ?>
    </div>
    <div id="main"></div>
    	<div id="menu">
     <?php
	 require_once("menu.php");
	  ?></div>
    	<div id="content">
            <?php
            if($privcheck == "admin" || $privcheck == "moderator" || $privcheck == "user" && $usercheck != "" && $usercheck != NULL)
            {
                echo "<form action=\"logout.php\">Logged in as <img src=\"img/user.png\" /><strong>" . $_SESSION['sess_username'] . "</strong> <input type=\"submit\" value=\"Logout\" id=\"button\" /></form>";
                
                
            } else{
                echo "<h2><img src=\"img/user.png\" />Login</h2><form name=\"loginform\" action=\"login.php\" method=\"post\" onsubmit=\"return check()\" id=\"login-form\">
        Username: <input name=\"username\" type=\"text\" value=\"\" size=\"15\" maxlength=\"15\" /><br />
        Password: <input name=\"password\" type=\"password\" size=\"15\" maxlength=\"15\" /><br />
        <input type=\"hidden\" name=\"redirurl\" value=\"" . $_SERVER['PHP_SELF'] . "\" />
        <input name=\"Submit\" type=\"submit\" value=\"Login\" id=\"button\" /></form>";
            }
?>
    	        </div>
  </div>
    <div id="footer"><a href="help/index.html" target="_blank">HELP</a></div>
</div>
</body>
</html>