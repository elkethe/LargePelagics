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
       <?php
	   require_once("loginform.php");
	    ?>
    </div>
    <div id="main"></div>
    	<div id="menu">
     <?php
	 require_once("menu.php");
	  ?></div>
    	        <div id="content">
    	          <?php
				  if($privcheck == "admin" && $usercheck != "" && $usercheck != NULL)
				  {
                                      require_once('dbcon.php');
                                      if(empty($_GET['username']) || is_null($_GET['username']) ){
                                      $sql="SELECT username, privileges FROM users";
                                      $result=mysqli_query($con, $sql);
                                      echo '<table id="results"><thead><tr>'
                                      . '<th>Username</th>'
                                              . '<th>Privileges</th>'
                                              . '<th>Edit</th>'
                                              . '<th>Delete</th></tr></thead><tbody>';
                                      while($row=mysqli_fetch_array($result)){
                                          echo '<tr><td>' . $row['username'] . '</td>';
                                          echo '<td>' . $row['privileges'] . '</td>';
                                          echo '<td><a href="edituser.php?username=' . $row['username'] . '&action=edit"> <img src="img/user_edit.png" /> </a></td>';
                                          echo '<td><a href="edituser.php?username=' . $row['username'] . '&action=delete"> <img src="img/user_delete.png" /> </a></td></tr>';
                                      }
                                      echo '</tbody></table>';
                                  }
                                      else if($_GET['action']==="edit"){
                                          $uname=$_GET['username'];
                                          $takeuserq="SELECT username, password, privileges FROM users WHERE username='$uname'";
                                          $result=mysqli_query($con, $takeuserq);
                                          if(mysqli_error($con)){
                                              echo mysqli_error($con);
                                          }
                                              while($rowk=mysqli_fetch_array($result)){
                                              echo '<form id="insertform" action="euser.php" method="post">'
                                              . '<b>Username: </b> <input type="text" name="username" value="'. $rowk['username'] .'" /> <br />'
                                              . '<b>Old Password: </b> <input type="text" name="oldpass" value="' . $rowk['password'] . '" readonly /> <br />'
                                              . '<b>New Password: </b> <input type="text" name="newpass" /> <br />'
                                                      . '<b>Privileges: </b><select name="privileges">'
                                                      . '<option value=""></option>'
                                                      . '<option value="admin">Administrator</option>'
                                                      . '<option value="moderator">Moderator</option>'
                                                      . '<option value="user">User</option>'
                                                      . '</select><sup>(Leave it blank to keep the old privileges, this user is <b>'.$rowk['privileges'].'</b>)</sup>'
                                                      . '<br /><input type="hidden" name="olduname" value="' . $rowk['username'] . '" />'
                                              . '<input type="submit" value="Update" /> <br />'
                                                      . '</form>';
                                              }
                                          
                                          
                                      } else if($_GET['action']==="delete"){
                                          $uname=$_GET['username'];
                                          $deluser="DELETE FROM users WHERE username='$uname'";
                                          $result=  mysqli_query($con, $deluser);
                                          if(mysqli_error($con)){
                                              echo "Error! <br />" . mysqli_error($con);
                                          }
                                          else {
                                              echo "User <b>".$uname."</b> succesfully deleted!";
                                              header("refresh:2;url=edituser.php");
                                          }
                                          
                                      }
                                      ?>
                                       
                    <?php
				  }elseif($privcheck == "user")
				  {
					  echo "You don't have the right privileges to create a new user!";
				  }else 
				  {
					  echo "Please login as a Moderator or Administrator to create a new user!";
				  }
                                  mysqli_close($con);
                  
    	          ?>
    	        </div>
	</div>
    <div id="footer"><a href="help/index.html" target="_blank">HELP</a></div>
</div>
</body>
</html>