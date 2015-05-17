<?php

require_once('dbcon.php');
if ($_POST['selectquery'] === "measurements") {
    $measurecols='';
    if (!empty($_POST['smvesselcols'])) {
        if ($_POST['smvesselcols'][0] == "all") {
            $measurecols = "AMAS,vessel_name,reg_no_state,port,port_area,grt,vl,vlc,vw,hp,gears,navigation,communication";
        } else {
            $measurecols = implode(',', $_POST['smvesselcols']);
        }
    }
    if (!empty($_POST['smexpeditioncols'])) {
        if (!empty($measurecols)) {
            $measurecols.=',';
        }
        if ($_POST['smexpeditioncols'][0] == "all") {
            $measurecols.="deployDate,returnDate,Hooks_day,FishingDays,Effort,Gear,Detail_Area,StartSettingTime,StartLat,StartLON,EndSetTime,EndLAT,EndLON,StartHaulTime,StartLATHaul,StartLONHaul,EndHaulTime,EndLATHaul,EndLONHaul,Lightsticks,InfoOrigin,Comments";
        } else {
            $measurecols.=implode(',', $_POST['smexpeditioncols']);
        }
    }
    /* SHOWS ALBACORE MEASUREMENTS
      //
      //
     */
    if ($_POST['measurements_species_search'] === "ALB") {
        $searchyear = $_POST['measurements_year'];
        $albquery = "SELECT * FROM vessel
		INNER JOIN vessel_expeditions
		ON vessel.AMAS=vessel_expeditions.vexpedition_AMAS
		INNER JOIN expedition
		ON vessel_expeditions.veexpedition_ID=expedition.expedition_ID
		INNER JOIN species_measurements
		ON expedition.expedition_ID=species_measurements.measure_expedition_ID
		INNER JOIN ALBmeasure
		ON species_measurements.measure_ID=ALBmeasure.ALB_measure_ID
		WHERE YEAR(STR_TO_DATE(deployDate, '%Y-%m-%d'))='$searchyear' ORDER BY deployDate";
        $result = mysqli_query($con, $albquery);
        if (!empty($measurecols)) {
            $measurecols.=',';
        }
        $measurecols.="fl,gg,dw,rw,sex,matur_stage,gon_wei,life_status,bait_type,commercial";
        $mcarray = explode(',', $measurecols);
        $mcacount = count($mcarray);
        $forexport = '<table id="results" class="tablesorter">
                <thead>
				<tr id="results">';
        for ($i = 0; $i < $mcacount; $i++) {
            $forexport.='<th>' . $mcarray[$i] . '</th>';
        }
        $forexport.='		</tr>
				</thead><tbody>';
        while ($row = mysqli_fetch_array($result)) {
            $forexport .= '<tr>';
            for ($i = 0; $i < $mcacount; $i++) {
                $forexport.='<td>' . $row[$mcarray[$i]] . '</td>';
            }
            $forexport.='</tr>';
        }
        $forexport .='</tbody></table>';
        echo '<form name="exportanalysis" method="post" action="exportanalysis.php">
		<input type="hidden" name="export" value="' . htmlspecialchars($forexport, ENT_QUOTES) . '" />
		<label for="selectcsv"><img src="img/csv-icon.png" width="50" height="50" /> </label>
		<input type="radio" name="filexport" value="csv" id="selectcsv" required />
		<label for="selectxls"><img src="img/xls-icon.png" width="50" height="50" /> </label>
		<input type="radio" name="filexport" value="xls" id="selectxls" />
		<input type="submit" value="Download" />';
        echo $forexport;
    }
    /* SHOWS BFT MEASUREMENTS
      //
      //
     */ else if ($_POST['measurements_species_search'] === "BFT") {
        $searchyear = $_POST['measurements_year'];
        $bftquery = "SELECT * FROM vessel
		INNER JOIN vessel_expeditions
		ON vessel.AMAS=vessel_expeditions.vexpedition_AMAS
		INNER JOIN expedition
		ON vessel_expeditions.veexpedition_ID=expedition.expedition_ID
		INNER JOIN species_measurements
		ON expedition.expedition_ID=species_measurements.measure_expedition_ID
		INNER JOIN BFTmeasure
		ON species_measurements.measure_ID=BFTmeasure.BFT_measure_ID
		WHERE YEAR(STR_TO_DATE(deployDate, '%Y-%m-%d'))='$searchyear' ORDER BY deployDate";
        $result = mysqli_query($con, $bftquery);
        if (!empty($measurecols)) {
            $measurecols.=',';
        }
        $measurecols.="fl,gg,dw,rw,sex,pfl,matur_stage,gon_wei,life_status,bait_type,commercial";
        $mcarray = explode(',', $measurecols);
        $mcacount = count($mcarray);
        $forexport = '<table id="results" class="tablesorter">
                <thead>
				<tr id="results">';
        for ($i = 0; $i < $mcacount; $i++) {
            $forexport.='<th>' . $mcarray[$i] . '</th>';
        }
        $forexport.='		</tr>
				</thead><tbody>';
        while ($row = mysqli_fetch_array($result)) {
            $forexport .= '<tr>';
            for ($i = 0; $i < $mcacount; $i++) {
                $forexport.='<td>' . $row[$mcarray[$i]] . '</td>';
            }
            $forexport.='</tr>';
        }
        $forexport .='</tbody></table>';
        echo '<form name="exportanalysis" method="post" action="exportanalysis.php">
		<input type="hidden" name="export" value="' . htmlspecialchars($forexport, ENT_QUOTES) . '" />
		<label for="selectcsv"><img src="img/csv-icon.png" width="50" height="50" /> </label>
		<input type="radio" name="filexport" value="csv" id="selectcsv" required />
		<label for="selectxls"><img src="img/xls-icon.png" width="50" height="50" /> </label>
		<input type="radio" name="filexport" value="xls" id="selectxls" />
		<input type="submit" value="Download" />';
        echo $forexport;
    }
    /* SHOWS RVT MEASUREMENTS
      //
      //
     */ else if ($_POST['measurements_species_search'] === "RVT") {
        $searchyear = $_POST['measurements_year'];
        $rvtquery = "SELECT * FROM vessel
		INNER JOIN vessel_expeditions
		ON vessel.AMAS=vessel_expeditions.vexpedition_AMAS
		INNER JOIN expedition
		ON vessel_expeditions.veexpedition_ID=expedition.expedition_ID
		INNER JOIN species_measurements
		ON expedition.expedition_ID=species_measurements.measure_expedition_ID
		INNER JOIN RVTmeasure
		ON species_measurements.measure_ID=RVTmeasure.RVT_measure_ID
		WHERE YEAR(STR_TO_DATE(deployDate, '%Y-%m-%d'))='$searchyear' ORDER BY deployDate";
        $result = mysqli_query($con, $rvtquery);
        if (!empty($measurecols)) {
            $measurecols.=',';
        }
        $measurecols.="fl,tl,pffl,gg,dw,rw,sex,life_status,bait_type,commercial";
        $mcarray = explode(',', $measurecols);
        $mcacount = count($mcarray);
        $forexport = '<table id="results" class="tablesorter">
                <thead>
				<tr id="results">';
        for ($i = 0; $i < $mcacount; $i++) {
            $forexport.='<th>' . $mcarray[$i] . '</th>';
        }
        $forexport.='		</tr>
				</thead><tbody>';
        while ($row = mysqli_fetch_array($result)) {
            $forexport .= '<tr>';
            for ($i = 0; $i < $mcacount; $i++) {
                $forexport.='<td>' . $row[$mcarray[$i]] . '</td>';
            }
            $forexport.='</tr>';
        }
        $forexport .='</tbody></table>';
        echo '<form name="exportanalysis" method="post" action="exportanalysis.php">
		<input type="hidden" name="export" value="' . htmlspecialchars($forexport, ENT_QUOTES) . '" />
		<label for="selectcsv"><img src="img/csv-icon.png" width="50" height="50" /> </label>
		<input type="radio" name="filexport" value="csv" id="selectcsv" required />
		<label for="selectxls"><img src="img/xls-icon.png" width="50" height="50" /> </label>
		<input type="radio" name="filexport" value="xls" id="selectxls" />
		<input type="submit" value="Download" />';
        echo $forexport;
    }
    /* SHOWS SWO MEASUREMENTS
      //
      //
     */ else if ($_POST['measurements_species_search'] === "SWO") {
        $searchyear = $_POST['measurements_year'];
        $swoquery = "SELECT * FROM vessel
		INNER JOIN vessel_expeditions
		ON vessel.AMAS=vessel_expeditions.vexpedition_AMAS
		INNER JOIN expedition
		ON vessel_expeditions.veexpedition_ID=expedition.expedition_ID
		INNER JOIN species_measurements
		ON expedition.expedition_ID=species_measurements.measure_expedition_ID
		INNER JOIN SWOmeasure
		ON species_measurements.measure_ID=SWOmeasure.SWO_measure_ID
		WHERE YEAR(STR_TO_DATE(deployDate, '%Y-%m-%d'))='$searchyear' ORDER BY deployDate";
        $result = mysqli_query($con, $swoquery);
        if (!empty($measurecols)) {
            $measurecols.=',';
        }
        $measurecols.="ljfl,gg,sex,rw,dw,pfl,head_length,matur_stage,gon_wei,parasites,life_status,bait_type,commercial";
        $mcarray = explode(',', $measurecols);
        $mcacount = count($mcarray);
        $forexport = '<table id="results" class="tablesorter">
                <thead>
				<tr id="results">';
        for ($i = 0; $i < $mcacount; $i++) {
            $forexport.='<th>' . $mcarray[$i] . '</th>';
        }
        $forexport.='		</tr>
				</thead><tbody>';
        while ($row = mysqli_fetch_array($result)) {
            $forexport .= '<tr>';
            for ($i = 0; $i < $mcacount; $i++) {
                $forexport.='<td>' . $row[$mcarray[$i]] . '</td>';
            }
            $forexport.='</tr>';
        }
        $forexport .='</tbody></table>';
        echo '<form name="exportanalysis" method="post" action="exportanalysis.php">
		<input type="hidden" name="export" value="' . htmlspecialchars($forexport, ENT_QUOTES) . '" />
		<label for="selectcsv"><img src="img/csv-icon.png" width="50" height="50" /> </label>
		<input type="radio" name="filexport" value="csv" id="selectcsv" required />
		<label for="selectxls"><img src="img/xls-icon.png" width="50" height="50" /> </label>
		<input type="radio" name="filexport" value="xls" id="selectxls" />
		<input type="submit" value="Download" />';
        echo $forexport;
    }
} else if ($_POST['selectquery'] === "expedition") {
    //Vessel Columns and Expedition Columns check
    if ($_POST['vesselcolumns'][0] == "all") {
        $columns = "AMAS,vessel_name,reg_no_state,port,port_area,grt,vl,vlc,vw,hp,gears,navigation,communication";
    } else {
        $columns = implode(',', $_POST['vesselcolumns']);
    }
    if ($_POST['expeditioncolumns'][0] == "all") {
        if (!empty($columns)) {
            $columns.=',';
        }
        $columns.="deployDate,returnDate,Hooks_day,FishingDays,Effort,Gear,Detail_Area,StartSettingTime,StartLat,StartLON,EndSetTime,EndLAT,EndLON,StartHaulTime,StartLATHaul,StartLONHaul,EndHaulTime,EndLATHaul,EndLONHaul,Lightsticks,InfoOrigin,Comments";
    } else {
        if (!empty($columns)) {
            $columns.=',';
        }
        $columns.= implode(',', $_POST['expeditioncolumns']);
    }
    if (!empty($_POST['catch'])) {
        if (!empty($columns)) {
            $columns.=',';
        }
        $columns.="species,weight,num,commercial";
    }
    //AMAS check
    if ($_POST['searchv'] === '0') {
        $amas = 'UNKN';
    } elseif ($_POST['searchv'] != "") {
        $amas = $_POST['searchv'];
    } else {
        $amas = NULL;
    }
    //Deploy Date FROM and TO check
    #Deploy Date From:
    if (empty($_POST['deploydatefrom'])) {
        $datefrom = '0000-00-00';
    } else if (strlen($_POST['deploydatefrom']) == 4) {
        $datefrom = $_POST['deploydatefrom'] . '-01-01';
    } else if (strlen($_POST['deploydatefrom']) == 7) {
        $datefrom = $_POST['deploydatefrom'] . '-01';
    } else {
        $datefrom = $_POST['deploydatefrom'];
    }
    #Deploy Date To:
    if (empty($_POST['deploydateto'])) {
        $dateto = '9999-12-31';
    } else if (strlen($_POST['deploydateto']) == 4) {
        $dateto = $_POST['deploydateto'] . '-12-31';
    } else if (strlen($_POST['deploydateto']) == 7) {
        $dateto = $_POST['deploydateto'] . '-31';
    } else {
        $dateto = $_POST['deploydateto'];
    }
    if (!is_null($amas)) {
        $expeditionq = "SELECT $columns FROM vessel
                INNER JOIN vessel_expeditions
                ON vessel.AMAS=vessel_expeditions.vexpedition_AMAS AND vessel.AMAS = '$amas'
                INNER JOIN expedition
                ON vessel_expeditions.veexpedition_ID=expedition.expedition_ID
                INNER JOIN expedition_size
                ON expedition.expedition_ID=expedition_size.size_expedition_ID                
                WHERE expedition.deployDate >= '$datefrom' AND expedition.deployDate <= '$dateto'";
        $result = mysqli_query($con, $expeditionq);
        echo mysqli_error($con);
        $columns = explode(',', $columns);
        $columnscounter = count($columns);
        $forexport = '<table id="results" class="tablesorter"><thead><tr>';
        for ($i = 0; $i < $columnscounter; $i++) {
            $forexport.='<th>' . $columns[$i] . '</th>';
        }
        $forexport.='</tr></thead><tbody>';
        while ($row = mysqli_fetch_array($result)) {
            $forexport.='<tr>';
            for ($i = 0; $i < $columnscounter; $i++) {
                $forexport.='<td>' . $row[$columns[$i]] . '</td>';
            }
            $forexport.='</tr>';
        }
        $forexport .= '</tbody></table>';
        echo '<form name="exportanalysis" method="post" action="exportanalysis.php">
		            <input type="hidden" name="export" value="' . htmlspecialchars($forexport, ENT_QUOTES) . '" />
		            <label for="selectcsv"><img src="img/csv-icon.png" width="50" height="50" /> </label>
		            <input type="radio" name="filexport" value="csv" id="selectcsv" required />
		            <label for="selectxls"><img src="img/xls-icon.png" width="50" height="50" /> </label>
		            <input type="radio" name="filexport" value="xls" id="selectxls" />
		            <input type="submit" value="Download" />';
        echo $forexport;
    } else {
        $expeditionq = "SELECT $columns FROM vessel
                INNER JOIN vessel_expeditions
                ON vessel.AMAS=vessel_expeditions.vexpedition_AMAS
                INNER JOIN expedition
                ON vessel_expeditions.veexpedition_ID=expedition.expedition_ID
                INNER JOIN expedition_size
                ON expedition.expedition_ID=expedition_size.size_expedition_ID                
                WHERE expedition.deployDate >= '$datefrom' AND expedition.deployDate <= '$dateto'";
        $result = mysqli_query($con, $expeditionq);
        echo mysqli_error($con);
        $columns = explode(',', $columns);
        $columnscounter = count($columns);
        $forexport = '<table id="results" class="tablesorter"><thead><tr>';
        for ($i = 0; $i < $columnscounter; $i++) {
            $forexport.='<th>' . $columns[$i] . '</th>';
        }
        $forexport.='</tr></thead><tbody>';
        while ($row = mysqli_fetch_array($result)) {
            $forexport.='<tr>';
            for ($i = 0; $i < $columnscounter; $i++) {
                $forexport.='<td>' . $row[$columns[$i]] . '</td>';
            }
            $forexport.='</tr>';
        }
        $forexport .= '</tbody></table>';
        echo '<form name="exportanalysis" method="post" action="exportanalysis.php">
		            <input type="hidden" name="export" value="' . htmlspecialchars($forexport, ENT_QUOTES) . '" />
		            <label for="selectcsv"><img src="img/csv-icon.png" width="50" height="50" /> </label>
		            <input type="radio" name="filexport" value="csv" id="selectcsv" required />
		            <label for="selectxls"><img src="img/xls-icon.png" width="50" height="50" /> </label>
		            <input type="radio" name="filexport" value="xls" id="selectxls" />
		            <input type="submit" value="Download" />';
        echo $forexport;
    }
} else if ($_POST['selectquery'] === "production") {
    //AMAS check
    if ($_POST['pvessel'] != "") {
        $amas = $_POST['pvessel'];
    } else {
        $amas = NULL;
    }

    //Year check
    if (empty($_POST['pyear'])) {
        $year = NULL;
    } else {
        $year = $_POST['pyear'];
    }
    //Vessel Columns and Production Columns check
    if (isset($_POST['pvcols'])) {
        if ($_POST['pvcols'][0] == "all") {
            $columns = "vessel.AMAS,vessel_name,reg_no_state,port,port_area,grt,vl,vlc,vw,hp,gears,navigation,communication";
        } else {
            $columns = implode(',', $_POST['pvcols']);
        }
    }
    if (isset($_POST['pcols'])) {
        if ($_POST['pcols'][0] == "all") {
            if (!empty($columns)) {
                $columns.=',';
            }
            $columns.= "year,SWOproduction,ALBproduction,BFTproduction,RVTproduction,fishing_days,wtc,bait";
        } else {
            if (!empty($columns)) {
                $columns.=',';
            }
            $columns.= implode(',', $_POST['pcols']);
        }
    }
    #CASE AMAS!=NULL && YEAR!=NULL
    if (!is_null($amas) && !is_null($year)) {
        $productionq = "SELECT $columns FROM vessel
		INNER JOIN production_ID
		ON vessel.AMAS=production_ID.AMAS AND vessel.AMAS = '$amas'
		INNER JOIN production
		ON production_ID.production_ID=production.production_ID
		WHERE year='$year'";
        $result = mysqli_query($con, $productionq);
        echo mysqli_error($con);
        $columns = explode(',', $columns);
        $columnscounter = count($columns);
        $forexport = '<table id="results" class="tablesorter"><thead><tr>';
        for ($i = 0; $i < $columnscounter; $i++) {
            $forexport.='<th>' . $columns[$i] . '</th>';
        }
        $forexport.='</tr></thead><tbody>';
        if (explode('.', $columns[0])[0] == "vessel") {
            $columns = str_replace('vessel.', '', $columns);
        }
        while ($row = mysqli_fetch_array($result)) {
            $forexport.='<tr>';
            for ($i = 0; $i < $columnscounter; $i++) {
                $forexport.='<td>' . $row[$columns[$i]] . '</td>';
            }
            $forexport.='</tr>';
        }
        $forexport .= '</tbody></table>';
        echo '<form name="exportanalysis" method="post" action="exportanalysis.php">
		            <input type="hidden" name="export" value="' . htmlspecialchars($forexport, ENT_QUOTES) . '" />
		            <label for="selectcsv"><img src="img/csv-icon.png" width="50" height="50" /> </label>
		            <input type="radio" name="filexport" value="csv" id="selectcsv" required />
		            <label for="selectxls"><img src="img/xls-icon.png" width="50" height="50" /> </label>
		            <input type="radio" name="filexport" value="xls" id="selectxls" />
		            <input type="submit" value="Download" />';
        echo $forexport;
    }
    #CASE AMAS!=NULL && YEAR=NULL
    else if (!is_null($amas) && is_null($year)) {
        $productionq = "SELECT $columns FROM vessel
		INNER JOIN production_ID
		ON vessel.AMAS=production_ID.AMAS AND vessel.AMAS = '$amas'
		INNER JOIN production
		ON production_ID.production_ID=production.production_ID";
        $result = mysqli_query($con, $productionq);
        echo mysqli_error($con);
        $columns = explode(',', $columns);
        $columnscounter = count($columns);
        $forexport = '<table id="results" class="tablesorter"><thead><tr>';
        for ($i = 0; $i < $columnscounter; $i++) {
            $forexport.='<th>' . $columns[$i] . '</th>';
        }
        $forexport.='</tr></thead><tbody>';
        if (explode('.', $columns[0])[0] == "vessel") {
            $columns = str_replace('vessel.', '', $columns);
        }
        while ($row = mysqli_fetch_array($result)) {
            $forexport.='<tr>';
            for ($i = 0; $i < $columnscounter; $i++) {
                $forexport.='<td>' . $row[$columns[$i]] . '</td>';
            }
            $forexport.='</tr>';
        }
        $forexport .= '</tbody></table>';
        echo '<form name="exportanalysis" method="post" action="exportanalysis.php">
		            <input type="hidden" name="export" value="' . htmlspecialchars($forexport, ENT_QUOTES) . '" />
		            <label for="selectcsv"><img src="img/csv-icon.png" width="50" height="50" /> </label>
		            <input type="radio" name="filexport" value="csv" id="selectcsv" required />
		            <label for="selectxls"><img src="img/xls-icon.png" width="50" height="50" /> </label>
		            <input type="radio" name="filexport" value="xls" id="selectxls" />
		            <input type="submit" value="Download" />';
        echo $forexport;
    }
    #CASE AMAS=NULL && YEAR!=NULL
    else if (is_null($amas) && !is_null($year)) {
        $productionq = "SELECT $columns FROM vessel
		INNER JOIN production_ID
		ON vessel.AMAS=production_ID.AMAS
		INNER JOIN production
		ON production_ID.production_ID=production.production_ID
		WHERE year='$year'";
        $result = mysqli_query($con, $productionq);
        echo mysqli_error($con);
        $columns = explode(',', $columns);
        $columnscounter = count($columns);
        $forexport = '<table id="results" class="tablesorter"><thead><tr>';
        for ($i = 0; $i < $columnscounter; $i++) {
            $forexport.='<th>' . $columns[$i] . '</th>';
        }
        $forexport.='</tr></thead><tbody>';
        if (explode('.', $columns[0])[0] == "vessel") {
            $columns = str_replace('vessel.', '', $columns);
        }
        while ($row = mysqli_fetch_array($result)) {
            $forexport.='<tr>';
            for ($i = 0; $i < $columnscounter; $i++) {
                $forexport.='<td>' . $row[$columns[$i]] . '</td>';
            }
            $forexport.='</tr>';
        }
        $forexport .= '</tbody></table>';
        echo '<form name="exportanalysis" method="post" action="exportanalysis.php">
		            <input type="hidden" name="export" value="' . htmlspecialchars($forexport, ENT_QUOTES) . '" />
		            <label for="selectcsv"><img src="img/csv-icon.png" width="50" height="50" /> </label>
		            <input type="radio" name="filexport" value="csv" id="selectcsv" required />
		            <label for="selectxls"><img src="img/xls-icon.png" width="50" height="50" /> </label>
		            <input type="radio" name="filexport" value="xls" id="selectxls" />
		            <input type="submit" value="Download" />';
        echo $forexport;
    }
    #CASE AMAS=NULL && YEAR=NULL
    else if (is_null($amas) && is_null($year)) {
        $productionq = "SELECT $columns FROM vessel
		INNER JOIN production_ID
		ON vessel.AMAS=production_ID.AMAS
		INNER JOIN production
		ON production_ID.production_ID=production.production_ID";
        $result = mysqli_query($con, $productionq);
        echo mysqli_error($con);
        $columns = explode(',', $columns);
        $columnscounter = count($columns);
        $forexport = '<table id="results" class="tablesorter"><thead><tr>';
        for ($i = 0; $i < $columnscounter; $i++) {
            $forexport.='<th>' . $columns[$i] . '</th>';
        }
        $forexport.='</tr></thead><tbody>';
        if (explode('.', $columns[0])[0] == "vessel") {
            $columns = str_replace('vessel.', '', $columns);
        }
        while ($row = mysqli_fetch_array($result)) {
            $forexport.='<tr>';
            for ($i = 0; $i < $columnscounter; $i++) {
                $forexport.='<td>' . $row[$columns[$i]] . '</td>';
            }
            $forexport.='</tr>';
        }
        $forexport .= '</tbody></table>';
        echo '<form name="exportanalysis" method="post" action="exportanalysis.php">
		            <input type="hidden" name="export" value="' . htmlspecialchars($forexport, ENT_QUOTES) . '" />
		            <label for="selectcsv"><img src="img/csv-icon.png" width="50" height="50" /> </label>
		            <input type="radio" name="filexport" value="csv" id="selectcsv" required />
		            <label for="selectxls"><img src="img/xls-icon.png" width="50" height="50" /> </label>
		            <input type="radio" name="filexport" value="xls" id="selectxls" />
		            <input type="submit" value="Download" />';
        echo $forexport;
    }
}

mysqli_close($con);
?>