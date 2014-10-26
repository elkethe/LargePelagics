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
            require_once ('dbcon.php');

            if (mysqli_connect_errno()) {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }
            mysqli_set_charset($con, "utf8");
            if (!empty($_GET['action'])) {
                $id = $_GET['id'];
                $delete = "DELETE FROM production_ID WHERE production_ID='$id'";
                $delres = mysqli_query($con, $delete);
                if (mysqli_error($con)) {
                    die('Error: ' . mysqli_error($con));
                }
                $delaction = "DELETE FROM users_action_history WHERE action_pproduction_ID='$id'";
                $delres2 = mysqli_query($con, $delaction);
                if (mysqli_error($con)) {
                    die('Error: ' . mysqli_error($con));
                }
            } else {
                if (!empty($_POST['takeamas'])) {
                    $sql = "INSERT INTO production_ID (AMAS)
VALUES
('$_POST[takeamas]')";

                    if (!mysqli_query($con, $sql)) {
                        die('3Error: ' . mysqli_error($con));
                    } else {
                        $lastId = $con->insert_id;
                    }

                    $sql = "INSERT INTO production (production_ID, year, SWOproduction, ALBproduction, BFTproduction, RVTproduction, fishing_days, 
wtc, bait)
VALUES
($lastId,'$_POST[year]','$_POST[SWOproduction]','$_POST[ALBproduction]','
  $_POST[BFTproduction]','$_POST[RVTproduction]','$_POST[fishing_days]','
  $_POST[wtc]','$_POST[bait]')";

                    if (!mysqli_query($con, $sql)) {
                        die('Error: ' . mysqli_error($con));
                    }


                    $query = "INSERT INTO users_action_history (action_ID, action_username, action_pproduction_ID, action_date)
VALUES
(NULL, '$usercheck', '$lastId', NOW())";
                } else {
                    $sql = "UPDATE production SET year='$_POST[year]', SWOproduction='$_POST[SWOproduction]', ALBproduction='$_POST[ALBproduction]', BFTproduction='$_POST[BFTproduction]', RVTproduction='$_POST[RVTproduction]', fishing_days = '$_POST[fishing_days]', wtc='$_POST[wtc]', bait='$_POST[bait]' WHERE production_ID='$_POST[production_ID]'";
                    if (!mysqli_query($con, $sql)) {
                        die('Error: ' . mysqli_error($con));
                    }
                    $lastId = $_POST['production_ID'];
                    $query = "INSERT INTO users_action_history (action_ID, action_username, action_pproduction_ID, action_date)
VALUES
(NULL, '$usercheck', '$lastId', NOW())";
                }
                if (!mysqli_query($con, $query)) {
                    die('Error: ' . mysqli_error($con));
                }
            }
            if (mysqli_error($con)) {
                die('Error: ' . mysqli_errno($con));
            } else {
                echo "<img src=\"img/tick.png\" width=\"25\" height=\"25\" /><strong>Production data stored succesfully! ID:<u>" . $lastId . "</u></strong> <p> You are redirected to homepage... </p><p> <i>if you aren't redirected <a href=\"index.php\">click here</a></i></p>";
                header("refresh:5;url=index.php");
            }

            mysqli_close($con);
            ?>

        </div>
    </body>
</html>
