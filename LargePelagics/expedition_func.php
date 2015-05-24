<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Large Pelagic Database</title>
        <link href="style.css" rel="stylesheet" type="text/css" /></head><body>
        <div id="redirect">
            <?php
            session_start();
            error_reporting(E_ERROR | E_WARNING | E_PARSE);
            if (isset($_SESSION['sess_username']) && isset($_SESSION['sess_privileges'])) {
                $usercheck = $_SESSION['sess_username'];
                $privcheck = $_SESSION['sess_privileges'];
            } else {
                $privcheck = 1;
                $usercheck = 0;
            }
            require_once 'dbcon.php';
            $error = false;
            $ins_exp_query = expVars();
            $error = insertExpedition($con, $ins_exp_query);
            if ($error) {
                die('Execution stopped!' . __LINE__);
            }
            $expid = mysqli_insert_id($con);
            $ins_uaction_query = userActionQuery($con, $usercheck, "expedition", $expid);
            $error = insertUsersAction($con, $ins_uaction_query);
            if ($error) {
                die('Execution stopped!' . __LINE__);
            }
            $amascounter = (int) $_POST['amascounter'];
            for ($i = 0; $i < $amascounter; $i++) {
                $amas = $_POST['AMAS'];
                $ins_vexp_query = vesselExpQuery($amas[$i], $amascounter, $expid);
                $error = insertVExp($con, $ins_vexp_query);
                if ($error) {
                    die('Execution stopped!' . __LINE__);
                }
            }
            $spcounter = $_POST['speciescounter'];
            for ($i = 0; $i < $spcounter; $i++) {
                if ($_POST['species'][$i] != NULL) {
                    $exp_size_query = expSizeQuery($i, $expid);
                    $error = insertExpSize($con, $exp_size_query);
                    if ($error) {
                        die('Execution stopped!' . __LINE__);
                    }
                }
            }if ($_POST['species'][0] != NULL) {
                $ins_uaction_query = userActionQuery($con, $usercheck, "expedition_size", $expid);
                $error = insertUsersAction($con, $ins_uaction_query);
                if ($error) {
                    die('Execution stopped!' . __LINE__);
                }
            }
            $spmcounter = (int) $_POST['speciesmeasurecounter'];
            for ($i = 0; $i < $spmcounter; $i++) {
                $ins_spmeasurement_query = spMeasurementQuery($i, $expid);
                if ($ins_spmeasurement_query != NULL) {
                    $error = insertSpMeasurement($con, $ins_spmeasurement_query);
                    if ($error) {
                        die('Execution stopped!' . __LINE__);
                    }
                    $spmid = mysqli_insert_id($con);
                    $speciesmeasure = $_POST['speciesmeasure'];
                    switch ($speciesmeasure[$i]) {
                        case "Albacore":
                            $ins_alb_query = ALBQuery($i, $spmid);
                            $error = insertALBmeasure($con, $ins_alb_query);
                            if ($error) {
                                die('Execution stopped!' . __LINE__);
                            }
                            $uaction_query = userActionQuery($con, $usercheck, "albmeasure", $spmid);
                            $error = insertUsersAction($con, $uaction_query);
                            if ($error) {
                                die('Execution stopped!' . __LINE__);
                            }
                            break;
                        case "Bluefin tuna":
                            $ins_bft_query = BFTQuery($i, $spmid);
                            $error = insertBFTmeasure($con, $ins_bft_query);
                            if ($error) {
                                die('Execution stopped!' . __LINE__);
                            }
                            $uaction_query = userActionQuery($con, $usercheck, "bftmeasure", $spmid);
                            $error = insertUsersAction($con, $uaction_query);
                            if ($error) {
                                die('Execution stopped!' . __LINE__);
                            }
                            break;
                        case "Oilfish":
                            $ins_rvt_query = RVTQuery($i, $spmid);
                            $error = insertRVTmeasure($con, $ins_rvt_query);
                            if ($error) {
                                die('Execution stopped!' . __LINE__);
                            }
                            $uaction_query = userActionQuery($con, $usercheck, "rvtmeasure", $spmid);
                            $error = insertUsersAction($con, $uaction_query);
                            if ($error) {
                                die('Execution stopped!' . __LINE__);
                            }
                            break;
                        case "Swordfish":
                            $ins_swo_query = SWOQuery($i, $spmid);
                            $error = insertSWOmeasure($con, $ins_swo_query);
                            if ($error) {
                                die('Execution stopped!' . __LINE__);
                            }
                            $uaction_query = userActionQuery($con, $usercheck, "swomeasure", $spmid);
                            $error = insertUsersAction($con, $uaction_query);
                            if ($error) {
                                die('Execution stopped!' . __LINE__);
                            }
                            break;
                        default:
                            $ins_other_query = OTHERQuery($con, $i, $spmid);
                            $error = insertOTHERmeasure($con, $ins_other_query);
                            if ($error) {
                                die('Execution stopped!' . __LINE__);
                            }
                            $uaction_query = userActionQuery($con, $usercheck, "othermeasure", $spmid);
                            $error = insertUsersAction($con, $uaction_query);
                            if ($error) {
                                die('Execution stopped!' . __LINE__);
                            }
                            break;
                    }
                }
            }
            if ($error) {
                echo "<img src=\"img/xi.png\" width=\"25\" height=\"25\" /><strong>Error(s) occured check above messages!</strong>";
                //header("refresh:3;url=inserted.php");
            } else {
                echo "<img src=\"img/tick.png\" width=\"25\" height=\"25\" /><strong>Expedition data stored succesfully!</strong> <p> You are redirected back... </p><p> <i>if you aren't redirected <a href=\"inserted.php\">click here</a></i></p>";
                header("refresh:3;url=inserted.php");
            }

            ###########################################
            ##              FUNCTIONS                ##
            ###########################################

            function insertOTHERmeasure($con, $query) {
                if (!mysqli_query($con, $query)) {
                    echo '<b>Error inserting data to OTHERmeasure: </b><br />';
                    echo mysqli_error($con);
                    echo '<br />';
                    return (boolean) true;
                } else {
                    return (boolean) false;
                }
            }

            function OTHERQuery($con, $im, $spmid) {
                $speciesmeasure = mysqli_real_escape_string($con, $_POST['speciesmeasure'][$im]);
                $ssquery = "SELECT scientific FROM species WHERE common='$speciesmeasure'";
                $resultsciq = mysqli_query($con, $ssquery);
                $snamerow = mysqli_fetch_array($resultsciq);
                $scientificname = $snamerow['scientific'];

                if (empty($_POST['measurefl'][$im])) {
                    $fl = 0;
                } else {
                    $fl = $_POST['measurefl'][$im];
                }
                if (empty($_POST['measuretl'][$im])) {
                    $tl = 0;
                } else {
                    $tl = $_POST['measuretl'][$im];
                }
                if (empty($_POST['measuregg'][$im])) {
                    $gg = 0;
                } else {
                    $gg = $_POST['measuregg'][$im];
                }
                if (empty($_POST['measuredw'][$im])) {
                    $dw = 0;
                } else {
                    $dw = $_POST['measuredw'][$im];
                }
                if (empty($_POST['measurerw'][$im])) {
                    $rw = 0;
                } else {
                    $rw = $_POST['measurerw'][$im];
                }
                $sex = $_POST['measuresex'];
                $life_status = $_POST['measurelife_status'];
                $bait_type = $_POST['measurebait_type'];
                $commercial = $_POST['measurecommercial'];
                $sql = "INSERT INTO OTHERmeasure VALUES ("
                        . "$spmid,'$scientificname','$speciesmeasure',$fl,$tl,$gg,$dw,$rw,"
                        . "'$sex[$im]','$life_status[$im]','$bait_type[$im]','$commercial[$im]');";
                return $sql;
            }

            function insertSWOmeasure($con, $query) {
                if (!mysqli_query($con, $query)) {
                    echo '<b>Error inserting data to SWOmeasure: </b><br />';
                    echo mysqli_error($con);
                    echo '<br />';
                    return (boolean) true;
                } else {
                    return (boolean) false;
                }
            }

            function SWOQuery($im, $spmid) {
                if (empty($_POST['measureljfl'][$im])) {
                    $ljfl = 0;
                } else {
                    $ljfl = $_POST['measureljfl'][$im];
                }
                if (empty($_POST['measuregg'][$im])) {
                    $gg = 0;
                } else {
                    $gg = $_POST['measuregg'][$im];
                }
                if (empty($_POST['measuredw'][$im])) {
                    $dw = 0;
                } else {
                    $dw = $_POST['measuredw'][$im];
                }
                if (empty($_POST['measurerw'][$im])) {
                    $rw = 0;
                } else {
                    $rw = $_POST['measurerw'][$im];
                }
                $sex = $_POST['measuresex'];
                if (empty($_POST['measurepfl'][$im])) {
                    $pfl = 0;
                } else {
                    $pfl = $_POST['measurepfl'][$im];
                }
                if (empty($_POST['measurehead_length'][$im])) {
                    $head_length = 0;
                } else {
                    $head_length = $_POST['measurehead_length'][$im];
                }
                if (empty($_POST['measurematur_stage'][$im])) {
                    $matur_stage = 0;
                } else {
                    $matur_stage = $_POST['measurematur_stage'][$im];
                }
                if (empty($_POST['measuregon_wei'][$im])) {
                    $gon_wei = 0;
                } else {
                    $gon_wei = $_POST['measuregon_wei'][$im];
                }
                $parasites = $_POST['measureparasites'];
                $life_status = $_POST['measurelife_status'];
                $bait_type = $_POST['measurebait_type'];
                $commercial = $_POST['measurecommercial'];
                $sql = "INSERT INTO SWOmeasure VALUES ("
                        . "$spmid,$ljfl,$gg,'$sex[$im]',$rw,$dw,$pfl,$head_length,"
                        . "$matur_stage,$gon_wei,'$parasites[$im]','$life_status[$im]','$bait_type[$im]','$commercial[$im]');";
                return $sql;
            }

            function insertRVTmeasure($con, $query) {
                if (!mysqli_query($con, $query)) {
                    echo '<b>Error inserting data to RVTmeasure: </b><br />';
                    echo mysqli_error($con);
                    echo '<br />';
                    return (boolean) true;
                } else {
                    return (boolean) false;
                }
            }

            function RVTQuery($im, $spmid) {
                if (empty($_POST['measurefl'][$im])) {
                    $fl = 0;
                } else {
                    $fl = $_POST['measurefl'][$im];
                }
                if (empty($_POST['measuregg'][$im])) {
                    $gg = 0;
                } else {
                    $gg = $_POST['measuregg'][$im];
                }
                if (empty($_POST['measuredw'][$im])) {
                    $dw = 0;
                } else {
                    $dw = $_POST['measuredw'][$im];
                }
                if (empty($_POST['measurerw'][$im])) {
                    $rw = 0;
                } else {
                    $rw = $_POST['measurerw'][$im];
                }
                if (empty($_POST['measuretl'][$im])) {
                    $tl = 0;
                } else {
                    $tl = $_POST['measuretl'][$im];
                }
                if (empty($_POST['measurepffl'][$im])) {
                    $pffl = 0;
                } else {
                    $pffl = $_POST['measurepffl'][$im];
                }
                $sex = $_POST['measuresex'];
                $life_status = $_POST['measurelife_status'];
                $bait_type = $_POST['measurebait_type'];
                $commercial = $_POST['measurecommercial'];
                $sql = "INSERT INTO RVTmeasure VALUES ("
                        . "$spmid,$fl,$tl,$pffl,$dw,$rw,'$sex[$im]',"
                        . "'$life_status[$im]','$bait_type[$im]','$commercial[$im]');";
                return $sql;
            }

            function insertBFTmeasure($con, $query) {
                if (!mysqli_query($con, $query)) {
                    echo '<b>Error inserting data to BFTmeasure: </b><br />';
                    echo mysqli_error($con);
                    echo '<br />';
                    return (boolean) true;
                } else {
                    return (boolean) false;
                }
            }

            function BFTQuery($im, $spmid) {
                if (empty($_POST['measurefl'][$im])) {
                    $fl = 0;
                } else {
                    $fl = $_POST['measurefl'][$im];
                }
                if (empty($_POST['measuregg'][$im])) {
                    $gg = 0;
                } else {
                    $gg = $_POST['measuregg'][$im];
                }
                if (empty($_POST['measuredw'][$im])) {
                    $dw = 0;
                } else {
                    $dw = $_POST['measuredw'][$im];
                }
                if (empty($_POST['measurerw'][$im])) {
                    $rw = 0;
                } else {
                    $rw = $_POST['measurerw'][$im];
                }
                $sex = $_POST['measuresex'];
                if (empty($_POST['measurepfl'][$im])) {
                    $pfl = 0;
                } else {
                    $pfl = $_POST['measurepfl'][$im];
                }
                if (empty($_POST['measurematur_stage'][$im])) {
                    $matur_stage = 0;
                } else {
                    $matur_stage = $_POST['measurematur_stage'][$im];
                }
                if (empty($_POST['measuregon_wei'][$im])) {
                    $gon_wei = 0;
                } else {
                    $gon_wei = $_POST['measuregon_wei'][$im];
                }
                $life_status = $_POST['measurelife_status'];
                $bait_type = $_POST['measurebait_type'];
                $commercial = $_POST['measurecommercial'];
                $sql = "INSERT INTO BFTmeasure VALUES ("
                        . "$spmid,$fl,$gg,$dw,$rw,'$sex[$im]',$pfl,$matur_stage,$gon_wei,"
                        . "'$life_status[$im]','$bait_type[$im]','$commercial[$im]');";
                return $sql;
            }

            function insertALBmeasure($con, $query) {
                if (!mysqli_query($con, $query)) {
                    echo '<b>Error inserting data to ALBmeasure: </b><br />';
                    echo mysqli_error($con);
                    echo '<br />';
                    return (boolean) true;
                } else {
                    return (boolean) false;
                }
            }

            function ALBQuery($im, $spmid) {
                if (empty($_POST['measurefl'][$im])) {
                    $fl = 0;
                } else {
                    $fl = $_POST['measurefl'][$im];
                }
                if (empty($_POST['measuregg'][$im])) {
                    $gg = 0;
                } else {
                    $gg = $_POST['measuregg'][$im];
                }
                if (empty($_POST['measuredw'][$im])) {
                    $dw = 0;
                } else {
                    $dw = $_POST['measuredw'][$im];
                }
                if (empty($_POST['measurerw'][$im])) {
                    $rw = 0;
                } else {
                    $rw = $_POST['measurerw'][$im];
                }
                $sex = $_POST['measuresex'];
                if (empty($_POST['measurematur_stage'][$im])) {
                    $matur_stage = 0;
                } else {
                    $matur_stage = $_POST['measurematur_stage'][$im];
                }
                if (empty($_POST['measuregon_wei'][$im])) {
                    $gon_wei = 0;
                } else {
                    $gon_wei = $_POST['measuregon_wei'][$im];
                }
                $life_status = $_POST['measurelife_status'];
                $bait_type = $_POST['measurebait_type'];
                $commercial = $_POST['measurecommercial'];
                $sql = "INSERT INTO ALBmeasure VALUES ("
                        . "$spmid,$fl,$gg,$dw,$rw,'$sex[$im]',$matur_stage,$gon_wei,'$life_status[$im]',"
                        . "'$bait_type[$im]','$commercial[$im]');";
                return $sql;
            }

            function insertSpMeasurement($con, $query) {
                if (!mysqli_query($con, $query)) {
                    echo '<b>Error inserting data to species_measurement: </b><br />';
                    echo mysqli_error($con);
                    echo '<br />';
                    return (boolean) true;
                } else {
                    return (boolean) false;
                }
            }

            function spMeasurementQuery($counter, $id) {
                $speciesmeasure = $_POST['speciesmeasure'];
                if ($speciesmeasure[$counter] == NULL || $speciesmeasure[$counter] == "") {
                    return NULL;
                } else {
                    $sql = "INSERT INTO species_measurements VALUES ("
                            . "$id,'$speciesmeasure[$counter]',NULL);";
                    return $sql;
                }
            }

            function insertExpSize($con, $query) {
                if (!mysqli_query($con, $query)) {
                    echo '<b>Error inserting data to expedition_size: </b><br />';
                    echo mysqli_error($con);
                    echo '<br />';
                    return (boolean) true;
                } else {
                    return (boolean) false;
                }
            }

            function expSizeQuery($counter, $id) {
                $spweight = $_POST['speciesweight'];
                $spnumber = $_POST['speciesnumber'];
                $species = $_POST['species'];
                $commercial = $_POST['commercial'];
                $sql = "INSERT INTO expedition_size VALUES ("
                        . "$spweight[$counter],$spnumber[$counter],'$species[$counter]',$id,'$commercial[$counter]');";
                return $sql;
            }

            function insertVExp($con, $query) {
                if (!mysqli_query($con, $query)) {
                    echo '<b>Error inserting data to vessel_expeditions: </b><br />';
                    echo mysqli_error($con);
                    echo '<br />';
                    return (boolean) true;
                } else {
                    return (boolean) false;
                }
            }

            function vesselExpQuery($amas, $amascounter, $expid) {
                $sql = "INSERT INTO vessel_expeditions VALUES "
                        . "('$amas',$expid,$amascounter);";
                return $sql;
            }

            function userActionQuery($con, $user, $selcase, $id) {
                switch ($selcase) {
                    case "expedition":
                        $sql = "INSERT INTO users_action_history (action_ID, action_username, action_eexpedition_ID, action_date)"
                                . " VALUES (NULL, '$user', $id, NOW());";
                        break;
                    case "albmeasure":
                        $sql = "INSERT INTO users_action_history (action_ID, action_username, action_ALBmeasure, action_date)"
                                . " VALUES (NULL, '$user', $id, NOW());";
                        break;
                    case "bftmeasure":
                        $sql = "INSERT INTO users_action_history (action_ID, action_username, action_BFTmeasure, action_date)"
                                . " VALUES (NULL, '$user', $id, NOW());";
                        break;
                    case "rvtmeasure":
                        $sql = "INSERT INTO users_action_history (action_ID, action_username, action_RVTmeasure, action_date)"
                                . " VALUES (NULL, '$user', $id, NOW());";
                        break;
                    case "swomeasure":
                        $sql = "INSERT INTO users_action_history (action_ID, action_username, action_SWOmeasure, action_date)"
                                . " VALUES (NULL, '$user', $id, NOW());";
                        break;
                    case "othermeasure":
                        $sql = "INSERT INTO users_action_history (action_ID, action_username, action_OTHERmeasure, action_date)"
                                . " VALUES (NULL, '$user', $id, NOW());";
                        break;
                    case "expedition_size":
                        $sql = "INSERT INTO users_action_history (action_ID, action_username, action_size_expedition_ID, action_date)"
                                . " VALUES (NULL, '$user', $id, NOW());";
                        break;
                    default:
                        echo '<br /><b>Wrong case to update user_action_history: <u>' . $selcase . '</u></b><br />';
                        break;
                }

                return $sql;
            }

            function insertUsersAction($con, $query) {
                if (!mysqli_query($con, $query)) {
                    echo '<b>Error inserting data to users_action_history: </b><br />';
                    echo mysqli_error($con);
                    echo '<br />';
                    return (boolean) true;
                } else {
                    return (boolean) false;
                }
            }

            function insertExpedition($con, $query) {
                if (!mysqli_query($con, $query)) {
                    echo '<b>Error inserting data to expedition: </b><br />';
                    echo mysqli_error($con);
                    echo '<br />';
                    return (boolean) true;
                } else {
                    return (boolean) false;
                }
            }

            function expVars() {
                //Correcting empty dates
                if (empty($_POST['deploydate'])) {
                    $deploydate = "0000-00-00";
                } else {
                    $deploydate = $_POST['deploydate'];
                }
                if (empty($_POST['returndate'])) {
                    $returndate = "0000-00-00";
                } else {
                    $returndate = $_POST['returndate'];
                }
                $hooksday = $_POST['hooksday'];
                $fishingdays = (int) $_POST['fishingdays'];
                $effort = (int) $_POST['effort'];
                $gear = $_POST['gear'];
                $detailarea = $_POST['detailarea'];
                $startsettingtime = $_POST['startsettingtime'];
                /// Converting LATs and LONs
                //// Start/End LAT and LON
                $startlat = $_POST['startlatd'] + ($_POST['startlatm'] / 60) + ($_POST['startlats'] / 3600);
                if ($_POST['startlatdir'] == "S") {
                    $startlat = $startlat * (-1);
                }
                $startlon = $_POST['startlond'] + ($_POST['startlonm'] / 60) + ($_POST['startlons'] / 3600);
                if ($_POST['startlondir'] == "W") {
                    $startlon = $startlon * (-1);
                }
                $endlat = $_POST['endlatd'] + ($_POST['endlatm'] / 60) + ($_POST['endlats'] / 3600);
                if ($_POST['endlatdir'] == "S") {
                    $endlat = $endlat * (-1);
                }
                $endlon = $_POST['endlond'] + ($_POST['endlonm'] / 60) + ($_POST['endlons'] / 3600);
                if ($_POST['endlondir'] == "W") {
                    $endlon = $endlon * (-1);
                }
                //// Start/End Haul LAT and LON
                $startlathaul = $_POST['startlathauld'] + ($_POST['startlathaulm'] / 60) + ($_POST['startlathauls'] / 3600);
                if ($_POST['startlathauldir'] == "S") {
                    $startlathaul = $startlathaul * (-1);
                }
                $startlonhaul = $_POST['startlonhauld'] + ($_POST['startlonhaulm'] / 60) + ($_POST['startlonhauls'] / 3600);
                if ($_POST['startlonhauldir'] == "W") {
                    $startlonhaul = $startlonhaul * (-1);
                }
                $endlathaul = $_POST['endlathauld'] + ($_POST['endlathaulm'] / 60) + ($_POST['endlathauls'] / 3600);
                if ($_POST['endlathauldir'] == "S") {
                    $endlathaul = $endlathaul * (-1);
                }
                $endlonhaul = $_POST['endlonhauld'] + ($_POST['endlonhaulm'] / 60) + ($_POST['endlonhauls'] / 3600);
                if ($_POST['endlonhauldir'] == "W") {
                    $endlonhaul = $endlonhaul * (-1);
                }
                $endsettime = $_POST['endsettime'];
                $starthaultime = $_POST['starthaultime'];
                $endhaultime = $_POST['endhaultime'];
                $lightsticks = (int) $_POST['lightsticks'];
                $infoorigin = $_POST['infoorigin'];
                $comments = htmlspecialchars($_POST['comments'], ENT_QUOTES);
                if ($comments == "comments") {
                    $comments = NULL;
                }
                $sql = "INSERT INTO expedition VALUES"
                        . "(NULL, '$deploydate', '$returndate','$hooksday',"
                        . "$fishingdays,$effort,'$gear','$detailarea','$startsettingtime',"
                        . "'$startlat','$startlon','$endsettime','$endlat','$endlon',"
                        . "'$starthaultime','$startlathaul','$startlonhaul',"
                        . "'$endhaultime','$endlathaul','$endlonhaul',"
                        . "$lightsticks,'$infoorigin','$comments');";
                return $sql;
            }

            mysqli_close($con);
            ?>
        </div>
    </body></html>