<?php session_start(); 
if(isset($_SESSION['sess_username']) && isset($_SESSION['sess_privileges']))
{
$usercheck = $_SESSION['sess_username'];
$privcheck = $_SESSION['sess_privileges'];
}
else {
	$privcheck=1;
	$usercheck=0;
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Large Pelagic Database</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href='css/redmond/jquery-ui-1.10.3.custom.min.css' rel="stylesheet" type="text/css" />
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="js/jquery-ui.js"></script>
<script type="text/javascript" src="js/jquery-ui-timepicker.js"></script>
<script type="text/javascript">
//Show/hide depending on Selected Query
function select_Query(target){
	if (target.value === "measurements")
	{
		$("#measurements").show("slow");
		$("#expeditiondata").hide("slow");
                $("#production").hide("slow");
		$("#analysis_results").hide("slow");
	}
	if (target.value === "expedition")
	{
		$("#measurements").hide("slow");
		$("#expeditiondata").show("slow");
                $("#production").hide("slow");
		$("#analysis_results").hide("slow");
	}
	if (target.value === "")
	{
		$("#measurements").hide("slow");
		$("#expeditiondata").hide("slow");
                $("#production").hide("slow");
		$("#analysis_results").hide("slow");
	}
        if (target.value === "production")
	{
		$("#measurements").hide("slow");
		$("#expeditiondata").hide("slow");
                $("#production").show("slow");
		$("#analysis_results").hide("slow");
	}
}
//Datepicker
$(function(){
	var elem = document.createElement('input');
	elem.setAttribute('type', 'date');
	if (elem.type === 'text') {
		$('.date').each(function(){
			$(this).datepicker({
				dateFormat: 'yy-mm-dd'
				});  
		});
	}
});
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
       <?php require_once("loginform.php");
	   ?>
    </div>
    <div id="main"></div>
    	<div id="menu">
     <?php
	 require_once("menu.php");
	  ?></div>
  <div id="content">
				<?php
					 include("dbcon.php");
					 if($privcheck == "admin" || $privcheck == "moderator" && $usercheck != "" && $usercheck != NULL) 
					 {
						 ?>
    <form name="analysis" id="analysis" action="">
        <select name="selectquery" onchange="select_Query(this);">
                <option value="">Select Query</option>
                <option value="measurements">Species Measurements</option>
                <option value="expedition">Expedition Data</option>
                <option value="production">Production</option>
        </select>
        <div id="measurements" style="display:none;">
                            <h2>Measurements Data</h2>
                            <p>
                            	<select name="measurements_species_search">
                                <option value="">Select Species</option>
                                <option value="ALB">Albacore</option>
                                <option value="BFT">Bluefin Tuna</option>
                                <option value="RVT">Oilfish | Ruvettus pretiosus</option>
                                <option value="SWO">Swordfish</option>
                                </select> 
                                <label for="measurements_year">Year:</label>
                                <input name="measurements_year" type="text" id="measurements_year" size="4" maxlength="4" />
                                <br />
                            </p> <br />
                            Additional fields you want to show:
            <table width="410"><tr><td>
                            <table width="200">
                            <tr><th style="text-align: center;">Vessel</th></tr>
                                <tr>
                                    <td>
                                        <label>
                                            <input type="checkbox" name="smvesselcols[]" value="all" id="smvesselcols_0" />
                                            ALL</label>
                                    </td>
                                </tr>
                              <tr>
                                <td><label>
                                  <input type="checkbox" name="smvesselcols[]" value="AMAS" id="smvesselcols_1" />
                                  AMAS</label></td>
                              </tr>
                              <tr>
                                <td><label>
                                  <input type="checkbox" name="smvesselcols[]" value="vessel_name" id="smvesselcols_2" />
                                  Vessel Name</label></td>
                              </tr>
                              <tr>
                                <td><label>
                                  <input type="checkbox" name="smvesselcols[]" value="reg_no_state" id="smvesselcols_3" />
                                  Reg No. State</label></td>
                              </tr>
                              <tr>
                                <td><label>
                                  <input type="checkbox" name="smvesselcols[]" value="port" id="smvesselcols_4" />
                                  Port</label></td>
                              </tr>
                              <tr>
                                <td><label>
                                  <input type="checkbox" name="smvesselcols[]" value="port_area" id="smvesselcols_5" />
                                  Port Area</label></td>
                              </tr>
                              <tr>
                                <td><label>
                                  <input type="checkbox" name="smvesselcols[]" value="grt" id="smvesselcols_6" />
                                  GRT</label></td>
                              </tr>
                              <tr>
                                <td><label>
                                  <input type="checkbox" name="smvesselcols[]" value="vl" id="smvesselcols_7" />
                                  VL</label></td>
                              </tr>
                              <tr>
                                <td><label>
                                  <input type="checkbox" name="smvesselcols[]" value="vlc" id="smvesselcols_8" />
                                  VLC</label></td>
                              </tr>
                              <tr>
                                <td><label>
                                  <input type="checkbox" name="smvesselcols[]" value="vw" id="smvesselcols_9" />
                                  VW</label></td>
                              </tr>
                              <tr>
                                <td><label>
                                  <input type="checkbox" name="smvesselcols[]" value="hp" id="smvesselcols_10" />
                                  HP</label></td>
                              </tr>
                              <tr>
                                <td><label>
                                  <input type="checkbox" name="smvesselcols[]" value="gears" id="smvesselcols_11" />
                                  Gears</label></td>
                              </tr>
                              <tr>
                                <td><label>
                                  <input type="checkbox" name="smvesselcols[]" value="navigation" id="smvesselcols_12" />
                                  Navigation</label></td>
                              </tr>
                              <tr>
                                <td><label>
                                  <input type="checkbox" name="smvesselcols[]" value="communication" id="smvesselcols_13" />
                                  Communication</label></td>
                              </tr>
                            </table></td>
                <td>
            <table width="200">
                <tr><th style="text-align: center;">Expedition</th></tr>
                <tr>
                    <td>
                        <label>
                            <input type="checkbox" name="smexpeditioncols[]" value="all" id="smexpeditioncols_0" />
                            ALL</label>
                    </td>
                </tr>
                <tr>
                    <td><label>
                            <input type="checkbox" name="smexpeditioncols[]" value="deployDate" id="smexpeditioncols_1" />
                            Deploy Date</label></td>
                </tr>
                <tr>
                    <td><label>
                            <input type="checkbox" name="smexpeditioncols[]" value="returnDate" id="smexpeditioncols_2" />
                            Return Date</label></td>
                </tr>
                <tr>
                    <td><label>
                            <input type="checkbox" name="smexpeditioncols[]" value="Hooks_day" id="smexpeditioncols_3" />
                            Hooks/day</label></td>
                </tr>
                <tr>
                    <td><label>
                            <input type="checkbox" name="smexpeditioncols[]" value="FishingDays" id="smexpeditioncols_4" />
                            Fishing Days</label></td>
                </tr>
                <tr>
                    <td><label>
                            <input type="checkbox" name="smexpeditioncols[]" value="Effort" id="smexpeditioncols_5" />
                            Effort</label></td>
                </tr>
                <tr>
                    <td><label>
                            <input type="checkbox" name="smexpeditioncols[]" value="Gear" id="smexpeditioncols_6" />
                            Gear</label></td>
                </tr>
                <tr>
                    <td><label>
                            <input type="checkbox" name="smexpeditioncols[]" value="Detail_Area" id="smexpeditioncols_7" />
                            Detail Area</label></td>
                </tr>
                <tr>
                    <td><label>
                            <input type="checkbox" name="smexpeditioncols[]" value="StartSettingTime" id="smexpeditioncols_8" />
                            Start Setting Time</label></td>
                </tr>
                <tr>
                    <td><label>
                            <input type="checkbox" name="smexpeditioncols[]" value="StartLat" id="smexpeditioncols_9" />
                            Start LAT</label></td>
                </tr>
                <tr>
                    <td><label>
                            <input type="checkbox" name="smexpeditioncols[]" value="StartLON" id="smexpeditioncols_10" />
                            Start LON</label></td>
                </tr>
                <tr>
                    <td><label>
                            <input type="checkbox" name="smexpeditioncols[]" value="EndSetTime" id="smexpeditioncols_11" />
                            End Set Time</label></td>
                </tr>
                <tr>
                    <td><label>
                            <input type="checkbox" name="smexpeditioncols[]" value="EndLAT" id="smexpeditioncols_12" />
                            EndLAT</label></td>
                </tr>
                <tr>
                    <td><label>
                            <input type="checkbox" name="smexpeditioncols[]" value="EndLON" id="smexpeditioncols_13" />
                            End LON</label></td>
                </tr>
                <tr>
                    <td><label>
                            <input type="checkbox" name="smexpeditioncols[]" value="StartHaulTime" id="smexpeditioncols_14" />
                            Start Haul Time</label></td>
                </tr>
                <tr>
                    <td><label>
                            <input type="checkbox" name="smexpeditioncols[]" value="StartLATHaul" id="smexpeditioncols_15" />
                            Start LAT Haul</label></td>
                </tr>
                <tr>
                    <td><label>
                            <input type="checkbox" name="smexpeditioncols[]" value="StartLONHaul" id="smexpeditioncols_16" />
                            Start LON Haul</label></td>
                </tr>
                <tr>
                    <td><label>
                            <input type="checkbox" name="smexpeditioncols[]" value="EndHaulTime" id="smexpeditioncols_17" />
                            End Haul Time</label></td>
                </tr>
                <tr>
                    <td><label>
                            <input type="checkbox" name="smexpeditioncols[]" value="EndLATHaul" id="smexpeditioncols_18" />
                            End LAT Haul</label></td>
                </tr>
                <tr>
                    <td><label>
                            <input type="checkbox" name="smexpeditioncols[]" value="EndLONHaul" id="smexpeditioncols_19" />
                            End LON Haul</label></td>
                </tr>
                <tr>
                    <td><label>
                            <input type="checkbox" name="smexpeditioncols[]" value="Lightsticks" id="smexpeditioncols_20" />
                            Lightsticks</label></td>
                </tr>
                <tr>
                    <td><label>
                            <input type="checkbox" name="smexpeditioncols[]" value="InfoOrigin" id="smexpeditioncols_21" />
                            Info Origin</label></td>
                </tr>
                <tr>
                    <td><label>
                            <input type="checkbox" name="smexpeditioncols[]" value="Comments" id="smexpeditioncols_22" />
                            Comments</label></td>
                </tr>

            </table></td></tr></table>
                            <script>
                                var counter=0;
                                $("#smvesselcols_0").click(function() {
                                    if ($("#smvesselcols_0").is(':checked')) {
                                        for(counter=1; counter<=13; counter++) {
                                            $("#smvesselcols_"+counter).prop( "disabled", true);
                                            $("#smvesselcols_"+counter).prop( "checked", false);
                                        }
                                    } else {
                                        for(counter=1; counter<=13; counter++) {
                                            $("#smvesselcols_"+counter).prop( "disabled", false);
                                        }
                                    }
                                });
                                $("#smexpeditioncols_0").click(function() {
                                    if ($("#smexpeditioncols_0").is(':checked')) {
                                        for(counter=1; counter<=22; counter++) {
                                            $("#smexpeditioncols_"+counter).prop( "disabled", true);
                                            $("#smexpeditioncols_"+counter).prop( "checked", false);
                                        }
                                    } else {
                                        for(counter=1; counter<=22; counter++) {
                                            $("#smexpeditioncols_"+counter).prop( "disabled", false);
                                        }
                                    }
                                });
                            </script>
                            <p>&nbsp; </p>
                            </div><br />
                            <div id="expeditiondata" style="display:none;">
                            <h2>Expedition Data</h2>
                            <p>
                            	<label for="searchbox">Vessel AMAS: </label>
                                <input type="text" id="searchbox" autocomplete="off" id="searchbox" name="searchv" />
                                <sup style="color:#f00;"><em>(Τype in the whole number.)</em></sup>
 <label for="deploydatefrom">Deploy Date from:</label><input type="date" name="deploydatefrom" id="deploydatefrom" class="date" /> <label for="deploydateto">Deploy Date to:</label><input type="date" id="deploydateto" name="deploydateto"  class="date" /><br />
 <div id="showamas"></div><br />
 Choose the fields you want to show:<br />
 <table width="40%"><tr>
         <th><b>Vessel:</b></th><th><b>Expedition:</b></th><th><b>Catch Info</b></th></tr>
  <tr><td><label>
              <input type="checkbox" name="vesselcolumns[]" value="all" id="vesselcolumns_01" />
              All</label>
          <br />
          <label>
                             <input type="checkbox" name="vesselcolumns[]" value="AMAS" id="vesselcolumns_0" />
                             AMAS</label>
                           <br />
                           <label>
                             <input type="checkbox" name="vesselcolumns[]" value="vessel_name" id="vesselcolumns_1" />
                             Vessel Name</label>
                           <br />
                           <label>
                             <input type="checkbox" name="vesselcolumns[]" value="reg_no_state" id="vesselcolumns_2" />
                             Reg No State</label>
                           <br />
                           <label>
                             <input type="checkbox" name="vesselcolumns[]" value="port" id="vesselcolumns_3" />
                             Port</label>
                           <br />
                           <label>
                             <input type="checkbox" name="vesselcolumns[]" value="port_area" id="vesselcolumns_4" />
                             Port Area</label>
                           <br />
                           <label>
                             <input type="checkbox" name="vesselcolumns[]" value="grt" id="vesselcolumns_5" />
                             GRT</label>
                           <br />
                           <label>
                             <input type="checkbox" name="vesselcolumns[]" value="vl" id="vesselcolumns_6" />
                             VL</label>
                           <br />
                           <label>
                             <input type="checkbox" name="vesselcolumns[]" value="vlc" id="vesselcolumns_7" />
                             VLC</label>
                           <br />
                           <label>
                             <input type="checkbox" name="vesselcolumns[]" value="vw" id="vesselcolumns_8" />
                             VW</label>
                           <br />
                           <label>
                             <input type="checkbox" name="vesselcolumns[]" value="hp" id="vesselcolumns_9" />
                             HP</label>
                           <br />
                           <label>
                             <input type="checkbox" name="vesselcolumns[]" value="gears" id="vesselcolumns_10" />
                             Gears</label>
                           <br />
                           <label>
                             <input type="checkbox" name="vesselcolumns[]" value="navigation" id="vesselcolumns_11" />
                             Navigation</label>
                           <br />
                           <label>
                             <input type="checkbox" name="vesselcolumns[]" value="communication" id="vesselcolumns_12" />
                             Communication</label>
                            <br />
                           <label>
                             <input type="checkbox" name="vesselcolumns[]" value="vessel_num" id="vesselcolumns_13" />
                           Number of vessels deployed</label>
                           <br />
                           </td>
                             <td><p>
                                     <label>
                                         <input type="checkbox" name="expeditioncolumns[]" value="all" id="expeditioncolumns_0" />
                                         All</label>
                                     <br />
                               <label>
                                 <input type="checkbox" name="expeditioncolumns[]" value="deployDate" id="expeditioncolumns_1" />
                                 Deploy Date</label>
                               <br />
                               <label>
                                 <input type="checkbox" name="expeditioncolumns[]" value="returnDate" id="expeditioncolumns_2" />
                                 Return Date</label>
                               <br />
                               <label>
                                 <input type="checkbox" name="expeditioncolumns[]" value="Hooks_day" id="expeditioncolumns_3" />
                                 Hooks/Day</label>
                               <br />
                               <label>
                                 <input type="checkbox" name="expeditioncolumns[]" value="FishingDays" id="expeditioncolumns_4" />
                                 Fishing Days</label>
                               <br />
                               <label>
                                 <input type="checkbox" name="expeditioncolumns[]" value="Effort" id="expeditioncolumns_5" />
                                 Effort</label>
                               <br />
                               <label>
                                 <input type="checkbox" name="expeditioncolumns[]" value="gear" id="expeditioncolumns_6" />
                                 Gear</label>
                               <br />
                               <label>
                                 <input type="checkbox" name="expeditioncolumns[]" value="Detail_Area" id="expeditioncolumns_7" />
                                 Detail Area</label>
                               <br />
                               <label>
                                 <input type="checkbox" name="expeditioncolumns[]" value="StartSettingTime" id="expeditioncolumns_8" />
                                 Start Setting Time</label>
                               <br />
                               <label>
                                 <input type="checkbox" name="expeditioncolumns[]" value="StartLat" id="expeditioncolumns_9" />
                                 Start LAT</label>
                               <br />
                               <label>
                                 <input type="checkbox" name="expeditioncolumns[]" value="StartLon" id="expeditioncolumns_10" />
                                 Start LON</label>
                               <br />
                               <label>
                                 <input type="checkbox" name="expeditioncolumns[]" value="EndSetTime" id="expeditioncolumns_11" />
                                 End Setting Time</label>
                               <br />
                               <label>
                                 <input type="checkbox" name="expeditioncolumns[]" value="EndLAT" id="expeditioncolumns_12" />
                                 End LAT</label>
                               <br />
                               <label>
                                 <input type="checkbox" name="expeditioncolumns[]" value="EndLON" id="expeditioncolumns_13" />
                                 End LON</label>
                               <br />
                               <label>
                                 <input type="checkbox" name="expeditioncolumns[]" value="StartHaulTime" id="expeditioncolumns_14" />
                                 Start Haul Time</label>
                               <br />
                               <label>
                                 <input type="checkbox" name="expeditioncolumns[]" value="StartLATHaul" id="expeditioncolumns_15" />
                                 Start Haul LAT</label>
                               <br />
                               <label>
                                 <input type="checkbox" name="expeditioncolumns[]" value="StartLONHaul" id="expeditioncolumns_16" />
                                 Start Haul LON</label>
                               <br />
                               <label>
                                 <input type="checkbox" name="expeditioncolumns[]" value="EndHaulTime" id="expeditioncolumns_17" />
                                 End Haul Time</label>
                               <br />
                               <label>
                                 <input type="checkbox" name="expeditioncolumns[]" value="EndLATHaul" id="expeditioncolumns_18" />
                                 End Haul LAT</label>
                               <br />
                               <label>
                                 <input type="checkbox" name="expeditioncolumns[]" value="EndLONHaul" id="expeditioncolumns_19" />
                                 End Haul LON</label>
                               <br />
                               <label>
                                 <input type="checkbox" name="expeditioncolumns[]" value="Lightsticks" id="expeditioncolumns_20" />
                                 Lightsticks</label>
                               <br />
                               <label>
                                 <input type="checkbox" name="expeditioncolumns[]" value="InfoOrigin" id="expeditioncolumns_21" />
                                 Info Origin</label>
                               <br />
                               <label>
                                 <input type="checkbox" name="expeditioncolumns[]" value="Comments" id="expeditioncolumns_22" />
                                 Comments</label>
                               <br />
                             </p></td>
      <td>
          <label><input type="checkbox" name="catch" value="catch" /> Show Catch Information </label>
      </td>
          </tr>
                             </table>
                           </div>
                            <div id="production" style="display:none;">
                                <h2>Production</h2>
                                <label for="searchbox">Vessel AMAS: </label>
                                <input type="text" id="searchbox" autocomplete="off" name="pvessel" />
                                <sup style="color:#f00;"><em>(Τype in the whole number.)</em></sup> <label for="pyear">Year: </label><input type="text" name="pyear" id="pyear" /> 
                                <table>
                                    <tr>
                                        <th><b>Vessel</b></th>
                                        <th><b>Production</b></th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="pvcols[]" value="all" id="pvcols_0" /> All
                                            </label>
                                            <br />
                                            <label>
                                                <input type="checkbox" name="pvcols[]" value="vessel_name" id="pvcols_1" />
                                                Vessel Name
                                            </label>
                                            <br />
                                            <label>
                                                <input type="checkbox" name="pvcols[]" value="reg_no_state" id="pvcols_2" />
                                                Reg No State</label>
                                            <br />
                                            <label>
                                                <input type="checkbox" name="pvcols[]" value="port" id="pvcols_3" />
                             Port</label>
                           <br />
                           <label>
                             <input type="checkbox" name="pvcols[]" value="port_area" id="pvcols_4" />
                             Port Area</label>
                           <br />
                           <label>
                             <input type="checkbox" name="pvcols[]" value="grt" id="pvcols_5" />
                             GRT</label>
                           <br />
                           <label>
                             <input type="checkbox" name="pvcols[]" value="vl" id="pvcols_6" />
                             VL</label>
                           <br />
                           <label>
                             <input type="checkbox" name="pvcols[]" value="vlc" id="pvcols_7" />
                             VLC</label>
                           <br />
                           <label>
                             <input type="checkbox" name="pvcols[]" value="vw" id="pvcols_8" />
                             VW</label>
                           <br />
                           <label>
                             <input type="checkbox" name="pvcols[]" value="hp" id="pvcols_9" />
                             HP</label>
                           <br />
                           <label>
                             <input type="checkbox" name="pvcols[]" value="gears" id="pvcols_10" />
                             Gears</label>
                           <br />
                           <label>
                             <input type="checkbox" name="pvcols[]" value="navigation" id="pvcols_11" />
                             Navigation</label>
                           <br />
                           <label>
                             <input type="checkbox" name="pvcols[]" value="communication" id="pvcols_12" />
                             Communication</label>
                            <br />
                                        </td>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="pcols[]" value="all" id="pcols_0" /> All
                                            </label>
                                            <br />
                                            <label>
                                                <input type="checkbox" name="pcols[]" value="year" id="pcols_1" /> Year
                                            </label>
                                            <br />
                                            <label>
                                                <input type="checkbox" name="pcols[]" value="SWOproduction" id="pcols_2" /> Swordfish Production
                                            </label>
                                            <br />
                                            <label>
                                                <input type="checkbox" name="pcols[]" value="ALBproduction" id="pcols_3" /> Albacore Production
                                            </label>
                                            <br />
                                            <label>
                                                <input type="checkbox" name="pcols[]" value="BFTproduction" id="pcols_4" /> Bluefin Tuna Production
                                            </label>
                                            <br />
                                            <label>
                                                <input type="checkbox" name="pcols[]" value="RVTproduction" id="pcols_5" /> Ruvettus pretiosus Production
                                            </label>
                                            <br />
                                            <label>
                                                <input type="checkbox" name="pcols[]" value="fishing_days" id="pcols_6" /> Fishing Days
                                            </label>
                                            <br />
                                            <label>
                                                <input type="checkbox" name="pcols[]" value="wtc" id="pcols_7" /> WTC
                                            </label>
                                            <br />
                                            <label>
                                                <input type="checkbox" name="pcols[]" value="bait" id="pcols_8" /> Bait
                                            </label>
                                            
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <input type="button" id="searchanalysis" value="Submit"/>
                         </form>
                         <div id="analysis_results"></div>
    <script>
        $("#vesselcolumns_01").click(function() {
            if ($("#vesselcolumns_01").is(':checked')) {
                for(counter=0; counter<=13; counter++) {
                    $("#vesselcolumns_"+counter).prop( "disabled", true);
                    $("#vesselcolumns_"+counter).prop( "checked", false);
                }
            } else {
                for(counter=0; counter<=13; counter++) {
                    $("#vesselcolumns_"+counter).prop( "disabled", false);
                }
            }
        });
        $("#pvcols_0").click(function() {
            if ($("#pvcols_0").is(':checked')) {
                for(counter=1; counter<=13; counter++) {
                    $("#pvcols_"+counter).prop( "disabled", true);
                    $("#pvcols_"+counter).prop( "checked", false);
                }
            } else {
                for(counter=1; counter<=13; counter++) {
                    $("#pvcols_"+counter).prop( "disabled", false);
                }
            }
        });
        $("#pcols_0").click(function() {
            if ($("#pcols_0").is(':checked')) {
                for(counter=1; counter<=8; counter++) {
                    $("#pcols_"+counter).prop( "disabled", true);
                    $("#pcols_"+counter).prop( "checked", false);
                }
            } else {
                for(counter=1; counter<=8; counter++) {
                    $("#pcols_"+counter).prop( "disabled", false);
                }
            }
        });
        $("#expeditioncolumns_0").click(function() {
            if ($("#expeditioncolumns_0").is(':checked')) {
                for(counter=1; counter<=22; counter++) {
                    $("#expeditioncolumns_"+counter).prop( "disabled", true);
                    $("#expeditioncolumns_"+counter).prop( "checked", false);
                }
            } else {
                for(counter=1; counter<=22; counter++) {
                    $("#expeditioncolumns_"+counter).prop( "disabled", false);
                }
            }
        });
        $(function () {
            $("#searchanalysis").click(function () {
                var selectval=document.forms["analysis"]["selectquery"].value;
                if(selectval === "measurements"){
                $.post("analysisdata.php", $("#analysis").serialize(), function (data) {
                    $("#analysis_results").html(data);
                    $("#analysis_results").show("slow");
                });
                }else if(selectval === "expedition"){
                    var amas=document.forms["analysis"]["searchv"].value;
                    if(amas == null || amas == ""){
                        var conf=confirm("No AMAS selected, do you want to see all Vessel and Expedition data?");
                        if (conf==true){
                            $.post("analysisdata.php", $("#analysis").serialize(), function (data) {
                                $("#analysis_results").html(data);
                                $("#analysis_results").show("slow");
                            });
                        } else{
                            $("#analysis_results").hide("slow");
                        }
                    }else{
                        $.post("analysisdata.php", $("#analysis").serialize(), function (data) {
                            $("#analysis_results").html(data);
                            $("#analysis_results").show("slow");
                        });
                    }
                } else if(selectval === "production"){
                    $.post("analysisdata.php", $("#analysis").serialize(), function (data) {
                        $("#analysis_results").html(data);
                        $("#analysis_results").show("slow");
                    });
                }

            });
        });
        				$('#searchbox').keyup(function(){
                            var metritis=0;
							$.post('getvessel.php', $("#searchbox").serialize(), function(data){
								$('#showamas').html(data);
                                if(metritis == 0){
                                    $('#showamas').show("slow");
                                    metritis ++;
                                }
							});
						});
						$(document).click(function(){
							$('#showamas').hide("slow");
						});


    </script>
                            
                   <?php
					 }
					 else
					 {
						 echo "You have to login to see this page!";
					 }
						 ?>
          </div>
  </div>
    <div id="footer"><a href="help/index.html" target="_blank">HELP</a></div>
</div>
</body>
</html>