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

            $error = FALSE;
            //Insert vessel
            $vessel_query = vQuery();
            $error = insertQuery($con, $vessel_query);
            if ($error) {
                die('Execution stopped in line: ' . __LINE__);
            }
            //Insert User Action History for new AMAS
            $uaction_query = userActionQuery($con, $usercheck, "amas", $_POST['amas']);
            $error = insertQuery($con, $uaction_query);
            if ($error) {
                die('Execution stopped in line: ' . __LINE__);
            }
            //Insert new production id
            $prid_query = pridQuery();
            $error = insertQuery($con, $prid_query);
            if ($error) {
                die('Execution stopped in line: ' . __LINE__);
            }
            //Insert production for said production id
            $production_id = mysqli_insert_id($con);
            $production_query = productionQuery($production_id);
            $error = insertQuery($con, $production_query);
            if ($error) {
                die('Execution stopped in line: ' . __LINE__);
            }

            //Insert User Action History for new Production
            $uaction_query = userActionQuery($con, $usercheck, "production", $production_id);
            $error = insertQuery($con, $uaction_query);
            if ($error) {
                die('Execution stopped in line: ' . __LINE__);
            }

            //Insert new dynamic vessel id
            $dvid_query = dvidQuery();
            $error = insertQuery($con, $dvid_query);
            if ($error) {
                die('Execution stopped in line: ' . __LINE__);
            }

            //Insert dynamic vessel for said dynamic vessel id
            $dyn_vessel_id = mysqli_insert_id($con);
            $dynvessel_query = dynvesselQuery($dyn_vessel_id);
            $error = insertQuery($con, $dynvessel_query);
            if ($error) {
                die('Execution stopped in line: ' . __LINE__);
            }

            //Insert User Action History for new Production
            $uaction_query = userActionQuery($con, $usercheck, "dynamic_vessel", $dyn_vessel_id);
            $error = insertQuery($con, $uaction_query);
            if ($error) {
                die('Execution stopped in line: ' . __LINE__);
            }

            if ($error) {
                echo "<img src=\"img/xi.png\" width=\"25\" height=\"25\" /><strong>Error(s) occured check above messages!</strong>";
                //header("refresh:3;url=inserted.php");
            } else {
                echo "<img src=\"img/tick.png\" width=\"25\" height=\"25\" /><strong>Vessel data stored succesfully!</strong> <p> You are redirected back... </p><p> <i>if you aren't redirected <a href=\"insertv.php\">click here</a></i></p>";
                header("refresh:3;url=insertv.php");
            }
            ###########################################
            ##              FUNCTIONS                ##
            ###########################################

            function userActionQuery($con, $user, $selcase, $id) {
                switch ($selcase) {
                    case "amas":
                        $sql = "INSERT INTO users_action_history (action_ID, action_username, action_AMAS, action_date)"
                                . " VALUES (NULL, '$user','$id', NOW());";
                        break;
                    case "production":
                        $sql = "INSERT INTO users_action_history (action_ID, action_username, action_pproduction_ID, action_date)"
                                . " VALUES (NULL, '$user',$id, NOW());";
                        break;
                    case "dynamic_vessel":
                        $sql = "INSERT INTO users_action_history (action_ID, action_username, action_vproduction_ID, action_date)"
                                . " VALUES (NULL, '$user',$id, NOW());";
                        break;
                    default:
                        echo '<br /><b>Wrong case to update user_action_history: <u>' . $selcase . '</u></b><br />';
                        break;
                }

                return $sql;
            }

            function dynvesselQuery($id) {
                $winch_type = $_POST['winch_type'];
                if (empty($_POST['gear_year'])) {
                    $year = 0000;
                } else {
                    $year = (int) $_POST['gear_year'];
                }
                $comments = addslashes($_POST['extra_comments']);
                $ll_length = $_POST['ll_length'];
                $float_distance = $_POST['float_distance'];
                $branch_line_distance = $_POST['branch_line_distance'];
                $ml_diameter = (int) $_POST['ml_diameter'];
                $bl_diameter = (int) $_POST['bl_diameter'];
                $bl_length = (int) $_POST['bl_length'];
                $float_length = (int) $_POST['float_length'];
                $hooks_set = $_POST['hooks_set'];
                $hooks_no = (int) $_POST['hooks_no'];
                $extras = $_POST['extras'];
                $sql = "INSERT INTO dynamic_vessel VALUES("
                        . "$id,'$winch_type',$year,'$comments','$ll_length','$float_distance','$branch_line_distance',$ml_diameter,$bl_diameter,$bl_length,$float_length,'$hooks_set',$hooks_no,'$extras');";
                return $sql;
            }

            function dvidQuery() {
                $amas = $_POST['amas'];
                $sql = "INSERT INTO dynamic_vessel_id VALUES("
                        . "'$amas',NULL);";
                return $sql;
            }

            function vQuery() {
                $amas = $_POST['amas'];
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
                $communication = $_POST[communication];
                $sql = "INSERT INTO vessel (AMAS, vessel_name, reg_no_state, port, port_area, grt, vl, vlc, vw, hp, navigation, communication) VALUES("
                        . "'$amas','$vessel_name','$reg_no_state','$port','$port_area','$grt','$vl','$vlc','$vw','$hp','$navigation','$communication');";
                return $sql;
            }

            function insertQuery($con, $query) {
                if (!mysqli_query($con, $query)) {
                    $dbtable = explode(" ", $query);
                    echo '<b>Error inserting data to ' . $dbtable[2] . ':</b><br />';
                    echo mysqli_error($con);
                    echo '<br />';
                    return (boolean) true;
                } else {
                    return (boolean) false;
                }
            }

            function pridQuery() {
                $amas = $_POST['amas'];
                $sql = "INSERT INTO production_ID VALUES(NULL,'$amas');";
                return $sql;
            }

            function productionQuery($id) {
                if (empty($_POST['pro_year'])) {
                    $year = 0000;
                } else {
                    $year = (int) $_POST['pro_year'];
                }
                $SWOproduction = (int) $_POST['SWOproduction'];
                $ALBproduction = (int) $_POST['ALBproduction'];
                $BFTproduction = (int) $_POST['BFTproduction'];
                $RVTproduction = (int) $_POST['RVTproduction'];
                $fishing_days = (int) $_POST['fishing_days'];
                $wtc = $_POST['wtc'];
                $bait = $_POST['bait'];
                $sql = "INSERT INTO production (production_ID, year, SWOproduction, ALBproduction, BFTproduction, RVTproduction, fishing_days,wtc, bait) VALUES("
                        . "$id,$year,$SWOproduction,$ALBproduction,$BFTproduction,$RVTproduction,$fishing_days,'$wtc','$bait');";
                return $sql;
            }

            mysqli_close($con);
            ?>

        </div>
    </body>
</html>