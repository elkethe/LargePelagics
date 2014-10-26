<div id="login">
<?php if(isset($_SESSION['sess_username']))
	   {
		   echo "<form action=\"logout.php\">Logged in as <img src=\"img/user.png\" /><strong>" . $_SESSION['sess_username'] . "</strong> <input type=\"submit\" value=\"Logout\" id=\"button\" /></form>";
	   } 
	   else 
	   {
		  		   echo "<form name=\"loginform\" action=\"login.php\" method=\"post\" onsubmit=\"return check()\" id=\"login-form\">
        <img src=\"img/user.png\" />Username: <input name=\"username\" type=\"text\" value=\"\" size=\"15\" maxlength=\"15\" /> Password: <input name=\"password\" type=\"password\" size=\"15\" maxlength=\"15\" /><input type=\"hidden\" name=\"redirurl\" value=\"" . $_SERVER['PHP_SELF'] . "\" /><input name=\"Submit\" type=\"submit\" value=\"Login\" id=\"button\" /></form>";
	   }?>
    </div>