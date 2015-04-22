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
<script type="text/javascript" src="jquery.js"></script>
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
	 if($privcheck == "admin" || $privcheck == "moderator" || $privcheck == "user" && $usercheck != "" && $usercheck != NULL) 
					 {
	  ?></div>
    	        <div id="content">
					 <?php
                  		echo "<h2>Insert AMAS or vessel name to search for vessels</h2>";
                 		echo "<form id=\"searchform\" method=\"post\" onsubmit=\"return false;\">
						<input autocomplete=\"off\" id=\"searchbox\" name=\"searchv\" onkeyup=\"sendRequest()\" onclick=\"sendRequest()\" type=\"textbox\">
        				</form>
						<div id=\"show_results\">
						</div>
						<script src=\"prototype.js\" type=\"text/javascript\"></script>
						<script>
						function sendRequest() {
							new Ajax.Updater('show_results', 'getvessel_edit.php', { method: 'post', parameters: $('searchform').serialize() });
						}
         				</script>"; 
					?>
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