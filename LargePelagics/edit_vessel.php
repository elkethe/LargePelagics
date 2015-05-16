<?php
session_start();
if (isset($_SESSION['sess_username']) && isset($_SESSION['sess_privileges'])) {
    $usercheck = $_SESSION['sess_username'];
    $privcheck = $_SESSION['sess_privileges'];
} else {
    $privcheck = 1;
    $usercheck = 0;
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
                var user = document.forms["loginform"]["username"].value;
                if (user == null || user == "")
                {
                    alert("Ξέχασες να βάλεις username!");
                    return false;
                }
                var pass = document.forms["loginform"]["password"].value;
                if (pass == null || pass == "")
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
                <?php require_once("loginform.php"); ?>
            </div>
            <div id="main"></div>
            <div id="menu">
                <?php
                require_once("menu.php");
                if ($privcheck == "admin" || $privcheck == "moderator" || $privcheck == "user" && $usercheck != "" && $usercheck != NULL) {
                    ?></div>
                <div id="content">
                    <?php
                    require_once 'dbcon.php';
                    if (isset($_GET['amas'])) {
                        $amas = $_GET['amas'];
                        $vessel_q = "SELECT * FROM vessel WHERE AMAS = '$amas';";
                        $result = mysqli_query($con, $vessel_q);
                        $row = mysqli_fetch_array($result);
                        echo '<h2>Edit Vessel</h2>';
                        echo '<form action="change_vessel.php" method="post" >
                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <td width="50%" valign="top">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr><th>Vessel information</th></tr>
                            <input type="hidden" name="old_amas" value="' . $row['AMAS'] . '">
                            <tr><td>New AMAS:</td>			<td><input type="text" name="new_amas" value="' . $row['AMAS'] . '"></td></tr>
                            <tr><td>Vessel name:</td> 	<td><input type="text" name="vessel_name" value="' . $row['vessel_name'] . '"></td></tr>
                            <tr><td>Reg_no_state:</td> 	<td><input type="text" name="reg_no_state" value="' . $row['reg_no_state'] . '"></td></tr>
                            <tr><td>Port:</td> 			<td><input type="text" name="port" value="' . $row['port'] . '"></td></tr>
                            <tr><td>PortArea:</td>		<td><input type="text" name="port_area" value="' . $row['port_area'] . '"></td></tr>
                            <tr><td>GRT:</td> 			<td><input type="text" name="grt" value="' . $row['grt'] . '"></td></tr>
                            <tr><td>VL:</td> 			<td><input type="text" name="vl" value="' . $row['vl'] . '"></td></tr>
                            <tr><td>VLC:</td> 			<td><input type="text" name="vlc" value="' . $row['vlc'] . '"></td></tr>
                            <tr><td>VW:</td> 			<td><input type="text" name="vw" value="' . $row['vw'] . '"></td></tr>
                            <tr><td>HP:</td>			<td><input type="text" name="hp" value="' . $row['hp'] . '"></td></tr>
                            <tr><td>Navigation:</td>            <td><input type="text" name="navigation" value="' . $row['navigation'] . '"></td></tr>
                            <tr><td>Communication:</td> 	<td><input type="text" name="communication" value="' . $row['communication'] . '"></td></tr>
                                <tr><td><input type="submit" id="button" name="Update"></td></tr>
                                
                    </form>
                        </table>
                    </td>
                    <td width="50%" valign="top">
                        <table width="50%" border="0">
                            <tr><th>Edit Gear/Production</th></tr>
                            <tr><td><a href="edit_gear.php?takeamas=' . $row['AMAS'] . '">Edit gear</a> <sup style="color:#f00;"><em>If you changed AMAS, first submit the changes!</em></sup></td></tr>
                            <tr><td><a href="edit_production.php?takeamas=' . $row['AMAS'] . '">Edit production</a> <sup style="color:#f00;"><em>If you changed AMAS, first submit the changes!</em></sup></td></tr>
                        </table>
                    </td>
                    </table>';
                    } else {
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
                    }
                    ?>
                </div>
            </div>
            <?php
        } else {
            echo "You have to login to see this page!";
        }
        ?>
        <div id="footer"><a href="help/index.html" target="_blank">HELP</a></div>
        </div>
    </body>
</html>