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
    <script src="jquery.js" type="text/javascript"></script>
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
       <?php require_once("loginform.php");
	   require_once("dbcon.php"); ?>
    </div>
    <div id="main"></div>
    	<div id="menu">
     <?php
	 require_once("menu.php");
	  ?></div>
    	<div id="content">
				<?php
				if($privcheck == "admin" || $privcheck == "moderator" && $usercheck != "" && $usercheck != NULL){
                ?>
				<h2>Users' actions</h2>
                <form name="analysis" id="analysis" action="">
                    Username: <input type="text" id="usersname" name="usersname" /> <sup>(Leave this blank to see all users' actions!)</sup><br />
                    Number of the most recent user's actions: <input type="text" id="noactions" name="noactions" />
                </form>
                    <div id="useractions" style="display: none;"></div>


                    <script>
                        $(function () {
                            $("#noactions").keyup(function () {
                                $.post("getuah.php", $("#analysis").serialize(), function (data) {
                                    $("#useractions").html(data);
                                    $("#useractions").show("slow");
                                })
                            })
                        });
                        /*$(function () {
                            $("#useractions").keyup(function () {
                                $.post("getuah.php", $("#useractions").serialize(), function (data) {
                                    $("#useractions").html(data);
                                    $("#useractions").show("slow");
                                })
                            })
                        });*/
                    </script>

				<?php
                } else{
					echo "You have to login as moderator or administrator to see this page!";
					}
				?>


    	        </div>
  </div>
    <div id="footer"><a href="help/index.html" target="_blank">HELP</a></div>
</div>
</body>
</html>