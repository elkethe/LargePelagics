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

                    <h2>Insert/Edit Production</h2>
                    <form action="production.php" method="post" >
                        <?php
                        require_once("dbcon.php");
                        if (!empty($_GET["takeamas"]) && empty($_GET['id'])) {
                            $amas = $_GET["takeamas"];
                            $sql = "SELECT production.production_ID,production.year FROM production INNER JOIN production_ID ON production.production_ID = production_ID.production_ID WHERE production_ID.AMAS='$amas';";
                            $res = mysqli_query($con, $sql);
                            if (!$res) {
                                die('error: ' . mysqli_error($con));
                            }

                            echo '<table width="100%" border="0" cellpadding="0" cellspacing="0">
                  <td width="100%" valign="top">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr><th>Production Info</th></tr>';
                            echo '<tr><td>';
                            echo 'Production years inserted for this amas: ';
                            while ($row = mysqli_fetch_array($res)) {
                                echo '<a href="edit_production.php?id=' . $row['production_ID'] . '">' . $row['year'] . '</a>, ';
                            }
                            echo '</tr></td>';
                            echo '<tr><td>Year:</td>			<td><input type="text" name="year"></td></tr>
                    <tr><td>SWOproduction:</td>			<td><input type="text" name="SWOproduction"></td></tr>
                    <tr><td>ALBproduction:</td>			<td><input type="text" name="ALBproduction"></td></tr>
                    <tr><td>BFTproduction:</td>			<td><input type="text" name="BFTproduction"></td></tr>
                    <tr><td>RVTproduction:</td>			<td><input type="text" name="RVTproduction"></td></tr>
                    <tr><td>Fishing days:</td>			<td><input type="text" name="fishing_days"></td></tr>
                    <tr><td>Wtc:</td>			<td><input type="text" name="wtc"></td></tr>
                    <tr><td>Bait:</td>			<td><input type="text" name="bait"></td></tr>
                    <tr><td><input type="hidden" name="takeamas" value="' . $amas . '" /></td></tr>
                    <tr><td><input type="submit" id="button" name="Submit"></td></tr>
					</table>
                   </td>
                   </table>';
                        } else if (!empty($_GET["id"])) {

                            $id = $_GET["id"];
                            $pidq = "SELECT AMAS FROM production_ID WHERE production_ID='$id'";
                            $rpidq = mysqli_query($con, $pidq);
                            $amas = mysqli_fetch_array($rpidq)['AMAS'];
                            $prodq = "SELECT * FROM production WHERE production_ID='$id'";
                            $rprodq = mysqli_query($con, $prodq);
                            echo '<a href="edit_production.php?takeamas=' . $amas . '">< Insert new production!</a>';
                            while ($row = mysqli_fetch_array($rprodq)) {
                                echo '<table width="100%" border="0" cellpadding="0" cellspacing="0">
                  <td width="100%" valign="top">';
                                echo '<table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr><th>Production Info</th></tr>
                    <tr><td>AMAS:</td>			<td><b>' . $amas . '</b></td></tr>
                    <tr><td>Year:</td>			<td><input type="text" name="year" value="' . $row['year'] . '"></td></tr>
                    <tr><td>SWOproduction:</td>			<td><input type="text" name="SWOproduction" value="' . $row['SWOproduction'] . '"></td></tr>
                    <tr><td>ALBproduction:</td>			<td><input type="text" name="ALBproduction" value="' . $row['ALBproduction'] . '"></td></tr>
                    <tr><td>BFTproduction:</td>			<td><input type="text" name="BFTproduction" value="' . $row['BFTproduction'] . '"></td></tr>
                    <tr><td>RVTproduction:</td>			<td><input type="text" name="RVTproduction" value="' . $row['RVTproduction'] . '"></td></tr>
                    <tr><td>Fishing days:</td>			<td><input type="text" name="fishing_days" value="' . $row['fishing_days'] . '"></td></tr>
                    <tr><td>Wtc:</td>			<td><input type="text" name="wtc" value="' . $row['wtc'] . '"></td></tr>
                    <tr><td>Bait:</td>			<td><input type="text" name="bait" value="' . $row['bait'] . '"></td></tr>
                    <tr><td><input type="hidden" name="production_ID" value="' . $id . '" />
                    <input type="submit" id="button" name="Submit"></td></tr>
					</table>
                   </td>
                   </table>';
                            }
                        }
                        ?>


                    </form>
                </div>
            </div>
            <div id="footer"><a href="help/index.html" target="_blank">HELP</a></div>
            </div>
        </body>
</html>
