<?php
/*session_start(); 
if(isset($_SESSION['sess_username']) && isset($_SESSION['sess_privileges']))
{
$usercheck = $_SESSION['sess_username'];
$privcheck = $_SESSION['sess_privileges'];
}
else {
	$privcheck=1;
	$usercheck=0;
	}

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
       if(isset($_SESSION['sess_username'])) 
	   {
		   echo "<form action=\"logout.php\">Logged in as <strong>" . $_SESSION['sess_username'] . "</strong> <input type=\"submit\" value=\"Logout\" id=\"button\" /></form>";
	   } 
	   else 
	   {
		  		   echo "<form name=\"loginform\" action=\"login.php\" method=\"post\" onsubmit=\"return check()\" id=\"login-form\">
        Username: <input name=\"username\" type=\"text\" value=\"\" size=\"15\" maxlength=\"15\" /> Password: <input name=\"password\" type=\"password\" size=\"15\" maxlength=\"15\" /><input name=\"Submit\" type=\"submit\" value=\"Login\" id=\"button\" /></form>";
	   }
    </div>
    <div id="main"></div>
    	<div id="menu">
     
	 require_once("menu.php");
	  </div>
    	<div id="content">
				<?php if($privcheck == "admin" && $usercheck != "" && $usercheck != NULL)
				{
					echo '<a href="admin.php">Admin Panel</a>';
				}
					 */
    	          
/*******EDIT LINES 3-8*******/
$DB_Server = "localhost"; //MySQL Server    
$DB_Username = "root"; //MySQL Username     
$DB_Password = "wtMGqJaF7DWgY";             //MySQL Password     
$DB_DBName = "ELKETHE_DB";         //MySQL Database Name  
$DB_TBLName = "vessel"; //MySQL Table Name   
$filename = "vessels_".date('dmY');         //File Name
/*******YOU DO NOT NEED TO EDIT ANYTHING BELOW THIS LINE*******/    
//create MySQL connection   
$sql = "Select * from $DB_TBLName";
$Connect = @mysql_connect($DB_Server, $DB_Username, $DB_Password) or die("Couldn't connect to MySQL:<br>" . mysql_error() . "<br>" . mysql_errno());
//select database   
$Db = @mysql_select_db($DB_DBName, $Connect) or die("Couldn't select database:<br>" . mysql_error(). "<br>" . mysql_errno());   
//execute query 
$result = @mysql_query($sql,$Connect) or die("Couldn't execute query:<br>" . mysql_error(). "<br>" . mysql_errno());    
$file_ending = "xls";
//header info for browser
header("Content-Type: application/xls");    
header("Content-Disposition: attachment; filename=$filename.xls");  
header("Pragma: no-cache"); 
header("Expires: 0");
/*******Start of Formatting for Excel*******/   
//define separator (defines columns in excel & tabs in word)
$sep = "\t"; //tabbed character
//start of printing column names as names of MySQL fields
for ($i = 0; $i < mysql_num_fields($result); $i++) {
echo mysql_field_name($result,$i) . $sep;
}
print("\n");    
//end of printing column names  
//start while loop to get data
    while($row = mysql_fetch_row($result))
    {
        $schema_insert = "";
        for($j=0; $j<mysql_num_fields($result);$j++)
        {
            if(!isset($row[$j]))
                $schema_insert .= "NULL".$sep;
            elseif ($row[$j] != "")
                $schema_insert .= "$row[$j]".$sep;
            else
                $schema_insert .= "".$sep;
        }
        $schema_insert = str_replace($sep."$", "", $schema_insert);
        $schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
        $schema_insert .= "\t";
        print(trim($schema_insert));
        print "\n";
    }   
/*
    	        </div>
  </div>
    <div id="footer"><a href="help/index.html" target="_blank">HELP</a></div>
</div>
</body>
</html>*/ ?>
