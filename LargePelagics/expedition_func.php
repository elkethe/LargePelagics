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
                die('Execution stopped!'.__LINE__);
            }
            $expid = mysqli_insert_id($con);
            $ins_uaction_query = userActionQuery($con, $usercheck, "expedition", $expid);
            $error = insertUsersAction($con, $ins_uaction_query);
            if ($error) {
                die('Execution stopped!'.__LINE__);
            }
            $amascounter = (int) $_POST['amascounter'];
            for ($i = 1; $i <= $amascounter; $i++) {
                $amas = $_POST['AMAS' . $i];
                $ins_vexp_query = vesselExpQuery($amas, $amascounter, $expid);
                $error = insertVExp($con, $ins_vexp_query);
                if ($error) {
                    die('Execution stopped!'.__LINE__);
                }
            }
            $spcounter = $_POST['speciescounter'];
            for ($i = 1; $i <= $spcounter; $i++) {
                $exp_size_query = expSizeQuery($i, $expid);
                $error = insertExpSize($con, $exp_size_query);
                if ($error) {
                    die('Execution stopped!'.__LINE__);
                }
            }
            $ins_uaction_query = userActionQuery($con, $usercheck, "expedition_size", $expid);
            $error = insertUsersAction($con, $ins_uaction_query);
            if ($error) {
                die('Execution stopped!'.__LINE__);
            }
            $spmcounter = (int) $_POST['speciesmeasurecounter'];
            for ($i = 0; $i <= $spmcounter; $i++) {
                $ins_spmeasurement_query = spMeasurementQuery($i, $expid);
                if ($ins_spmeasurement_query != NULL) {
                    $error = insertSpMeasurement($con, $ins_spmeasurement_query);
                    if ($error) {
                        die('Execution stopped!'.__LINE__);
                    }
                    $spmid = mysqli_insert_id($con);
                    $speciesmeasure = $_POST['speciesmeasure_' . $i];
                    switch ($speciesmeasure) {
                        case "Albacore":
                            $ins_alb_query = ALBQuery($i, $spmid);
                            $error = insertALBmeasure($con, $ins_alb_query);
                            if ($error) {
                                die('Execution stopped!'.__LINE__);
                            }
                            $uaction_query = userActionQuery($con, $usercheck, "albmeasure", $spmid);
                            $error = insertUsersAction($con, $uaction_query);
                            if ($error) {
                                die('Execution stopped!'.__LINE__);
                            }
                            break;
                        case "Bluefin tuna":
                            $ins_bft_query = BFTQuery($i, $spmid);
                            $error = insertBFTmeasure($con, $ins_bft_query);
                            if ($error) {
                                die('Execution stopped!'.__LINE__);
                            }
                            $uaction_query = userActionQuery($con, $usercheck, "bftmeasure", $spmid);
                            $error = insertUsersAction($con, $uaction_query);
                            if ($error) {
                                die('Execution stopped!'.__LINE__);
                            }
                            break;
                        case "Oilfish":
                            $ins_rvt_query = RVTQuery($i, $spmid);
                            $error = insertRVTmeasure($con, $ins_rvt_query);
                            if ($error) {
                                die('Execution stopped!'.__LINE__);
                            }
                            $uaction_query = userActionQuery($con, $usercheck, "rvtmeasure", $spmid);
                            $error = insertUsersAction($con, $uaction_query);
                            if ($error) {
                                die('Execution stopped!'.__LINE__);
                            }
                            break;
                        case "Swordfish":
                            $ins_swo_query = SWOQuery($i, $spmid);
                            $error = insertSWOmeasure($con, $ins_swo_query);
                            if ($error) {
                                die('Execution stopped!'.__LINE__);
                            }
                            $uaction_query = userActionQuery($con, $usercheck, "swomeasure", $spmid);
                            $error = insertUsersAction($con, $uaction_query);
                            if ($error) {
                                die('Execution stopped!'.__LINE__);
                            }
                            break;
                        default:
                            $ins_other_query = OTHERQuery($con, $i, $spmid);
                            $error = insertOTHERmeasure($con, $ins_other_query);
                            if ($error) {
                                die('Execution stopped!'.__LINE__);
                            }
                            $uaction_query = userActionQuery($con, $usercheck, "othermeasure", $spmid);
                            $error = insertUsersAction($con, $uaction_query);
                            if ($error) {
                                die('Execution stopped!'.__LINE__);
                            }
                            break;
                    }
                }
            }
            if($error){
                echo "<img src=\"img/xi.png\" width=\"25\" height=\"25\" /><strong>Error(s) occured check above messages!</strong>";
                //header("refresh:3;url=inserted.php");
            } else {
                echo "<img src=\"img/tick.png\" width=\"25\" height=\"25\" /><strong>Expedition data stored succesfully!</strong> <p> You are redirected to homepage... </p><p> <i>if you aren't redirected <a href=\"index.php\">click here</a></i></p>";
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
                $speciesmeasure = mysqli_real_escape_string($con, $_POST['speciesmeasure_' . $im]);
                $ssquery = "SELECT scientific FROM species WHERE common='$speciesmeasure'";
                $resultsciq = mysqli_query($con, $ssquery);
                $snamerow = mysqli_fetch_array($resultsciq);
                $scientificname = $snamerow['scientific'];
                
                $fl = (double) $_POST['measurefl_' . $im];
                $tl = (double) $_POST['measuretl_' . $im];
                $gg = (double) $_POST['measuregg_' . $im];
                $dw = (double) $_POST['measuredw_' . $im];
                $rw = (double) $_POST['measurerw_' . $im];
                $sex = $_POST['measuresex_' . $im];
                $life_status = $_POST['measurelife_status_' . $im];
                $bait_type = $_POST['measurebait_type_' . $im];
                $commercial = $_POST['measurecommercial_' . $im];
                $sql = "INSERT INTO OTHERmeasure VALUES ("
                        . "$spmid,'$scientificname','$speciesmeasure',$fl,$tl,$gg,$dw,$rw,"
                        . "'$sex','$life_status','$bait_type','$commercial');";
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
                $ljfl = (double) $_POST['measureljfl_' . $im];
                $gg = (double) $_POST['measuregg_' . $im];
                $sex = $_POST['measuresex_' . $im];
                $rw = (double) $_POST['measurerw_' . $im];
                $dw = (double) $_POST['measuredw_' . $im];
                $pfl = (double) $_POST['measurepfl_' . $im];
                $head_length = (double) $_POST['measurehead_length_' . $im];
                $matur_stage = (int) $_POST['measurematur_stage_' . $im];
                $gon_wei = (double) $_POST['measuregon_wei_' . $im];
                $parasites = $_POST['measureparasites_' . $im];
                $life_status = $_POST['measurelife_status_' . $im];
                $bait_type = $_POST['measurebait_type_' . $im];
                $commercial = $_POST['measurecommercial_' . $im];
                $sql = "INSERT INTO SWOmeasure VALUES ("
                        . "$spmid,$ljfl,$gg,'$sex',$rw,$dw,$pfl,$head_length,"
                        . "$matur_stage,$gon_wei,'$parasites',$life_status','$bait_type','$commercial');";
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
                $fl = (double) $_POST['measurefl_' . $im];
                $tl = (double) $_POST['measuretl_' . $im];
                $pffl = (double) $_POST['measurpffl_' . $im];
                $gg = (double) $_POST['measuregg_' . $im];
                $dw = (double) $_POST['measuredw_' . $im];
                $rw = (double) $_POST['measurerw_' . $im];
                $sex = $_POST['measuresex_' . $im];
                $life_status = $_POST['measurelife_status_' . $im];
                $bait_type = $_POST['measurebait_type_' . $im];
                $commercial = $_POST['measurecommercial_' . $im];
                $sql = "INSERT INTO RVTmeasure VALUES ("
                        . "$spmid,$fl,$tl,$pffl,$dw,$rw,'$sex',"
                        . "'$life_status','$bait_type','$commercial');";
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
                $fl = (double) $_POST['measurefl_' . $im];
                $gg = (double) $_POST['measuregg_' . $im];
                $dw = (double) $_POST['measuredw_' . $im];
                $rw = (double) $_POST['measurerw_' . $im];
                $sex = $_POST['measuresex_' . $im];
                $pfl = (double) $_POST['measurepfl_' . $im];
                $matur_stage = (int) $_POST['measurematur_stage_' . $im];
                $gon_wei = (double) $_POST['measuregon_wei_' . $im];
                $life_status = $_POST['measurelife_status_' . $im];
                $bait_type = $_POST['measurebait_type_' . $im];
                $commercial = $_POST['measurecommercial_' . $im];
                $sql = "INSERT INTO BFTmeasure VALUES ("
                        . "$spmid,$fl,$gg,$dw,$rw,'$sex',$pfl,$matur_stage,$gon_wei,"
                        . "'$life_status','$bait_type','$commercial');";
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
                $fl = (double) $_POST['measurefl_' . $im];
                $gg = (double) $_POST['measuregg_' . $im];
                $dw = (double) $_POST['measuredw_' . $im];
                $rw = (double) $_POST['measurerw_' . $im];
                $sex = $_POST['measuresex_' . $im];
                $matur_stage = (int) $_POST['measurematur_stage_' . $im];
                $gon_wei = (double) $_POST['measuregon_wei_' . $im];
                $life_status = $_POST['measurelife_status_' . $im];
                $bait_type = $_POST['measurebait_type_' . $im];
                $commercial = $_POST['measurecommercial_' . $im];
                $sql = "INSERT INTO ALBmeasure VALUES ("
                        . "$spmid,$fl,$gg,$dw,$rw,'$sex',$matur_stage,$gon_wei,'$life_status',"
                        . "'$bait_type','$commercial');";
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
                $speciesmeasure = $_POST['speciesmeasure_' . $counter];
                if ($speciesmeasure == NULL || $speciesmeasure == "") {
                    return NULL;
                } else {
                    $sql = "INSERT INTO species_measurements VALUES ("
                            . "$id,'$speciesmeasure',NULL);";
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
                if ($counter == 1) {
                    $spweight = (double) $_POST['speciesweight'];
                    $spnumber = (int) $_POST['speciesnumber'];
                    $species = $_POST['species'];
                    $commercial = $_POST['commercial'];
                    $sql = "INSERT INTO expedition_size VALUES ("
                            . "$spweight,$spnumber,'$species',$id,'$commercial');";
                    return $sql;
                } else {
                    $spweight = (double) $_POST['speciesweight' . $counter];
                    $spnumber = (int) $_POST['speciesnumber' . $counter];
                    $species = $_POST['species' . $counter];
                    $commercial = $_POST['commercial' . $counter];
                    $sql = "INSERT INTO expedition_size VALUES ("
                            . "$spweight,$spnumber,'$species',$id,'$commercial');";
                    return $sql;
                }
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
                        echo '<br /><b>Wrong case to update user_action_history: <u>' .$selcase.'</u></b><br />';
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