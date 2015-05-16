<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Large Pelagic Database</title>
        <link href="style.css" rel="stylesheet" type="text/css" /></head><body>
        <div id="redirect">
            <?php
            session_start();
            if (isset($_SESSION['sess_username']) && isset($_SESSION['sess_privileges'])) {
                $usercheck = $_SESSION['sess_username'];
                $privcheck = $_SESSION['sess_privileges'];
            } else {
                $privcheck = 1;
                $usercheck = 0;
            }
            require_once('dbcon.php');
            $new_amas = $_POST['new_amas'];
            $old_amas = $_POST['old_amas'];
            $vessel_name = $_POST['vessel_name'];
            $reg_no_state = $_POST['reg_no_state'];
            $port = $_POST['port'];
            $port_area = $_POST['port_area'];
            $grt = $_POST['grt'];
            $vl = $_POST['vl'];
            $vlc = $_POST['vlc'];
            $vw = $_POST['vw'];
            $hp = $_POST['hp'];
            $navigation = $_POST['navigation'];
            $communication = $_POST['communication'];
            $sql = "UPDATE vessel SET "
                    . "AMAS = '$new_amas',"
                    . "vessel_name = '$vessel_name',"
                    . "reg_no_state = '$reg_no_state',"
                    . "port = '$port',"
                    . "port_area = '$port_area',"
                    . "grt = '$grt',"
                    . "vl = '$vl',"
                    . "vlc = '$vlc',"
                    . "vw = '$vw',"
                    . "hp = '$hp',"
                    . "navigation = '$navigation',"
                    . "communication = '$communication'"
                    . " WHERE AMAS = '$old_amas';";
            if (!mysqli_query($con, $sql)) {
                die('Error: ' . mysqli_error($con));
            }

            $query = "INSERT INTO users_action_history (action_ID, action_username, action_AMAS, action_date)
VALUES
(NULL, '$usercheck', '$new_amas', NOW())";

            if (!mysqli_query($con, $query)) {
                die('Error: ' . mysqli_error($con));
            } else {
                echo "<img src=\"img/tick.png\" width=\"25\" height=\"25\" /><strong>Vessel data  changed succesfully!</strong> <p> You are redirected back... </p><p> <i>if you aren't redirected <a href=\"edit_vessel.php?amas=".$new_amas."\">click here</a></i></p>";
                header("refresh:5;url=edit_vessel.php?amas=".$new_amas."");
            }


            mysqli_close($con);
            ?>

        </div>
    </body>
</html>