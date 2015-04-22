<?php
require_once('dbcon.php');
//CHECK DATE FROM
if(strlen($_POST['datefrom'])==4){
    $datefrom=$_POST['datefrom'] . '-00-00';
} else if(strlen($_POST['datefrom'])==7){
    $datefrom=$_POST['datefrom'] . '-00';
} else if(strlen($_POST['datefrom'])==0){
    $datefrom='0000-00-00';
} else {
    $datefrom=$_POST['datefrom'];
}

//CHECK DATE TO
if(strlen($_POST['dateto'])==4){
    $dateto=$_POST['dateto'] . '-99-99';
} else if(strlen($_POST['dateto'])==7){
    $dateto=$_POST['dateto'] . '-99';
} else if(strlen($_POST['dateto'])==0){
    $dateto='9999-99-99';
} else {
    $dateto=$_POST['dateto'];
}

$yearfrom=substr($datefrom, 0, 4);
$yearto=substr($dateto, 0, 4);
//
// Taking $columns for the results!
//
if(count($_POST['expeditioncols'])>0){
    $expeditioncols=implode(',', $_POST['expeditioncols']);
    if($expeditioncols=="all"){
        $expeditioncols="deployDate,returnDate,Hooks_day,FishingDays,Effort,Gear,Detail_Area,StartSettingTime,StartLat,StartLON,EndSetTime,EndLAT,EndLON,StartHaulTime,StartLATHaul,StartLONHaul,EndHaulTime,StartLATHaul,StartLONHaul,EndHaulTime,EndLATHaul,EndLONHaul,Lightsticks,InfoOrigin,Comments";
    }
    $columns=$expeditioncols;
}
if(count($_POST['expedition_sizecols'])>0){
    $expedition_sizecols=implode(',', $_POST['expedition_sizecols']);
    if($expedition_sizecols=="all"){
        $expedition_sizecols="weight,num,species,commercial";
    }
    if(strlen($columns)>0){
        $columns.=',' . $expedition_sizecols;
    } else {
        $columns=$expedition_sizecols;
    }
}
if(count($_POST['vesselcols'])>0){
    $vesselcols=implode(',', $_POST['vesselcols']);
    if($vesselcols=="all"){
        $vesselcols="AMAS,vessel_name,reg_no_state,port,port_area,grt,vl,vlc,vw,hp,gears,navigation,communication";
    }
    if(strlen($columns)>0){
        $columns.=',' . $vesselcols;
    }
        else {
            $columns=$vesselcols;
        }
}
if(count($_POST['productioncols'])>0){
    $productioncols=implode(',', $_POST['productioncols']);
    if($productioncols=="all"){
        $productioncols="year,SWOproduction,ALBproduction,BFTproduction,RVTproduction,fishing_days,wtc,bait,other_fisheries,extras";
    }
    if(strlen($columns)>0){
        $columns.=',' . $productioncols;
    }
    else {
        $columns=$productioncols;
    }
}
if($_POST['speciesmeasumentscols']=="all"){
    $speciesmeasumentscols=" FL,LJFL,TL,PFFL,GG,DW,RW,SEX,PFL,Matur_Stage,GON_wei,Head_Length,parasites,Life_Status,Bait_Type,Commercial";
    if(strlen($columns)>0){
        $columns.=',' . $speciesmeasumentscols;
    }
    else {
        $columns=$speciesmeasumentscols;
    }
}
if(count($_POST['vessel_info'])==1){
    if(count($_POST['species_info'])==0){
        $amas=$_POST['vessel_info'][0];
        $query_1="CREATE TEMPORARY TABLE IF NOT EXISTS tmptable AS
            (SELECT * FROM vessel
            INNER JOIN vessel_expeditions
            ON vessel.AMAS=vessel_expeditions.vexpedition_AMAS AND vessel.AMAS= '$amas'
            INNER JOIN expedition_size
            ON vessel_expeditions.veexpedition_ID=expedition_size.size_expedition_ID
            INNER JOIN expedition
            ON vessel_expeditions.veexpedition_ID=expedition.expedition_ID
            WHERE expedition.deployDate >= '$datefrom' AND expedition.deployDate <= '$dateto')";
        $query_11="CREATE TEMPORARY TABLE IF NOT EXISTS tmptable2 AS
        (SELECT production_ID, AMAS AS productionAMAS FROM production_ID
        INNER JOIN tmptable
        ON production_ID.productionAMAS=tmptable.AMAS
        INNER JOIN production
        ON production_ID.production_ID=production.production_ID
        WHERE production.year>='$yearfrom' AND production.year<='$yearto')";
        $resultq_1=mysqli_query($con, $query_1);
        $resultq_11=mysqli_query($con, $query_11);
        if($resultq_1 && $resultq_11){
            $quer_11="SELECT * FROM tmptable2";
            $fresultq_1=mysqli_query($con, $quer_11);
            $colnames=explode(',', $columns);
            $colcounter=count($colnames);
            $forexport = '<table id="results" class="tablesorter"><thead><tr>';
            for($i=0; $i<$colcounter; $i++){
                $forexport .= '<th>' . $colnames[$i] . '</th>';
            }
            $forexport .= '</tr></thead><tbody>';
            while($row=mysqli_fetch_array($fresultq_1)){
                $forexport .= '<tr>';
                for($i=0; $i<$colcounter; $i++){
                    $forexport .= '<td>' . $row[$colnames[$i]] . '</td>';
                }
                $forexport .= '</tr>';
            }
            $forexport .= '</tbody></table>';
            echo $forexport;
        }
    }
}
echo mysqli_error($con);
mysqli_close($con);
?>