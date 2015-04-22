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
		$("#analysis_results").hide("slow");
	}
	if (target.value === "expedition")
	{
		$("#measurements").hide("slow");
		$("#expeditiondata").show("slow");
		$("#analysis_results").hide("slow");
	}
	if (target.value === "")
	{
		$("#measurements").hide("slow");
		$("#expeditiondata").hide("slow");
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
					 if($privcheck == "admin" || $privcheck == "moderator" || $privcheck == "user" && $usercheck != "" && $usercheck != NULL) 
					 {
						 ?>
    <form name="analysis" id="analysis" action="">
      <h2>Query Search Criteria</h2>
       <table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <th scope="col">Vessel</th>
    <th scope="col">Species</th>
    <th scope="col">Dates</th>
  </tr>
  <tr>
    <td><select multiple name="vessel_info[]" id="vessel_info">
    <?php
    $vesselq="SELECT AMAS,vessel_name FROM vessel";
	$resultvq=mysqli_query($con, $vesselq);
	while($row=mysqli_fetch_array($resultvq)){
		echo '<option value="' . $row['AMAS'] . '"><strong>' . $row['AMAS'] . '</strong> ' . $row['vessel_name'] . '</option>';
	}
	?>
      </select><br />
      <em>for multiple selection hold down <b>Ctrl</b> key!</em></td>
    <td><select multiple name="species_info[]" id="species_info">
	<?php $speciesq = "SELECT common FROM species";
	$resultsq = mysqli_query($con, $speciesq);
	while($row = mysqli_fetch_array($resultsq))
	{
		echo "<option value=\"" . $row['common'] ."\">" . $row['common'] ."</option>";
		}
	?> 
    </select><br />
      <em>for multiple selection hold down <b>Ctrl</b> key!</em>
    </td>
    <td><label><b>From:</b> </label><input name="datefrom" type="date" class="date" /><label> <b>To:</b> </label><input name="dateto" type="date" class="date" /></td>
  </tr>
</table>
<h2>Query Results Criteria</h2>
<table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <th scope="col">Expedition</th>
    <th scope="col">Expedition Size</th>
    <th scope="col">Vessel</th>
    <th scope="col">Production</th>
    <th scope="col">Species Measurements</th>
  </tr>
  <tr>
    <td><table width="200">
      <tr>
        <td><label>
          <input type="checkbox" name="expeditioncols[]" value="all" id="expeditioncols_0" class="expeditionall" />
          All</label></td>
      </tr>
      <tr>
        <td><label>
          <input type="checkbox" name="expeditioncols[]" value="deployDate" id="expeditioncols_1" />
          Deploy Date</label></td>
      </tr>
      <tr>
        <td><label>
          <input type="checkbox" name="expeditioncols[]" value="returnDate" id="expeditioncols_2" />
          Return Date</label></td>
      </tr>
      <tr>
        <td><label>
          <input type="checkbox" name="expeditioncols[]" value="Hooks_day" id="expeditioncols_3" />
          Hooks/Day</label></td>
      </tr>
      <tr>
        <td><label>
          <input type="checkbox" name="expeditioncols[]" value="FishingDays" id="expeditioncols_4" />
          Fishing Days</label></td>
      </tr>
      <tr>
        <td><label>
          <input type="checkbox" name="expeditioncols[]" value="Effort" id="expeditioncols_5" />
          Effort</label></td>
      </tr>
      <tr>
        <td><label>
          <input type="checkbox" name="expeditioncols[]" value="Gear" id="expeditioncols_6" />
          Gear</label></td>
      </tr>
      <tr>
        <td><label>
          <input type="checkbox" name="expeditioncols[]" value="Detail_Area" id="expeditioncols_7" />
          Detail Area</label></td>
      </tr>
      <tr>
        <td><label>
          <input type="checkbox" name="expeditioncols[]" value="StartSettingTime" id="expeditioncols_8" />
          Start Setting Time</label></td>
      </tr>
      <tr>
        <td><label>
          <input type="checkbox" name="expeditioncols[]" value="StartLat" id="expeditioncols_9" />
          Start LAT</label></td>
      </tr>
      <tr>
        <td><label>
          <input type="checkbox" name="expeditioncols[]" value="StartLON" id="expeditioncols_10" />
          Start LON</label></td>
      </tr>
      <tr>
        <td><label>
          <input type="checkbox" name="expeditioncols[]" value="EndSetTime" id="expeditioncols_11" />
          End Set Time</label></td>
      </tr>
      <tr>
        <td><label>
          <input type="checkbox" name="expeditioncols[]" value="EndLAT" id="expeditioncols_12" />
          End LAT</label></td>
      </tr>
      <tr>
        <td><label>
          <input type="checkbox" name="expeditioncols[]" value="EndLON" id="expeditioncols_13" />
          End LON</label></td>
      </tr>
      <tr>
        <td><label>
          <input type="checkbox" name="expeditioncols[]" value="StartHaulTime" id="expeditioncols_14" />
          Start Haul Time</label></td>
      </tr>
      <tr>
        <td><label>
          <input type="checkbox" name="expeditioncols[]" value="StartLATHaul" id="expeditioncols_15" />
          Start LAT Haul</label></td>
      </tr>
      <tr>
        <td><label>
          <input type="checkbox" name="expeditioncols[]" value="StartLONHaul" id="expeditioncols_16" />
          Start LON Haul</label></td>
      </tr>
      <tr>
        <td><label>
          <input type="checkbox" name="expeditioncols[]" value="EndHaulTime" id="expeditioncols_17" />
          End Haul Time</label></td>
      </tr>
      <tr>
        <td><label>
          <input type="checkbox" name="expeditioncols[]" value="StartLATHaul" id="expeditioncols_18" />
          Start LAT Haul</label></td>
      </tr>
      <tr>
        <td><label>
          <input type="checkbox" name="expeditioncols[]" value="StartLONHaul" id="expeditioncols_19" />
          Start LON Haul</label></td>
      </tr>
      <tr>
        <td><label>
          <input type="checkbox" name="expeditioncols[]" value="EndHaulTime" id="expeditioncols_20" />
          End Haul Time</label></td>
      </tr>
      <tr>
        <td><label>
          <input type="checkbox" name="expeditioncols[]" value="EndLATHaul" id="expeditioncols_21" />
          End LAT Haul</label></td>
      </tr>
      <tr>
        <td><label>
          <input type="checkbox" name="expeditioncols[]" value="EndLONHaul" id="expeditioncols_22" />
          End LON Haul</label></td>
      </tr>
      <tr>
        <td><label>
          <input type="checkbox" name="expeditioncols[]" value="Lightsticks" id="expeditioncols_23" />
          Lightsticks</label></td>
      </tr>
      <tr>
        <td><label>
          <input type="checkbox" name="expeditioncols[]" value="InfoOrigin" id="expeditioncols_24" />
          Info Origin</label></td>
      </tr>
      <tr>
        <td><label>
          <input type="checkbox" name="expeditioncols[]" value="Comments" id="expeditioncols_25" />
          Comments</label></td>
      </tr>
    </table></td>
    <td><table width="200">
      <tr>
        <td><label>
          <input type="checkbox" name="expedition_sizecols[]" value="all" id="expedition_sizecols_0" />
          All</label></td>
      </tr>
      <tr>
        <td><label>
          <input type="checkbox" name="expedition_sizecols[]" value="weight" id="expedition_sizecols_1" />
          Weight</label></td>
      </tr>
      <tr>
        <td><label>
          <input type="checkbox" name="expedition_sizecols[]" value="num" id="expedition_sizecols_2" />
          Number</label></td>
      </tr>
      <tr>
        <td><label>
          <input type="checkbox" name="expedition_sizecols[]" value="species" id="expedition_sizecols_3" />
          Species</label></td>
      </tr>
      <tr>
        <td><label>
          <input type="checkbox" name="expedition_sizecols[]" value="commercial" id="expedition_sizecols_4" />
          Commercial</label></td>
      </tr>
    </table></td>
    <td><table width="200">
      <tr>
        <td><label>
          <input type="checkbox" name="vesselcols[]" value="all" id="vesselcols_0" />
          All</label></td>
      </tr>
      <tr>
        <td><label>
          <input type="checkbox" name="vesselcols[]" value="AMAS" id="vesselcols_1" />
          AMAS</label></td>
      </tr>
      <tr>
        <td><label>
          <input type="checkbox" name="vesselcols[]" value="vessel_name" id="vesselcols_2" />
          Vessel Name</label></td>
      </tr>
      <tr>
        <td><label>
          <input type="checkbox" name="vesselcols[]" value="reg_no_state" id="vesselcols_3" />
          Reg No. State</label></td>
      </tr>
      <tr>
        <td><label>
          <input type="checkbox" name="vesselcols[]" value="port" id="vesselcols_4" />
          Port</label></td>
      </tr>
      <tr>
        <td><label>
          <input type="checkbox" name="vesselcols[]" value="port_area" id="vesselcols_5" />
          Port Area</label></td>
      </tr>
      <tr>
        <td><label>
          <input type="checkbox" name="vesselcols[]" value="grt" id="vesselcols_6" />
          GRT</label></td>
      </tr>
      <tr>
        <td><label>
          <input type="checkbox" name="vesselcols[]" value="vl" id="vesselcols_7" />
          VL</label></td>
      </tr>
      <tr>
        <td><label>
          <input type="checkbox" name="vesselcols[]" value="vlc" id="vesselcols_8" />
          VLC</label></td>
      </tr>
      <tr>
        <td><label>
          <input type="checkbox" name="vesselcols[]" value="vw" id="vesselcols_9" />
          VW</label></td>
      </tr>
      <tr>
        <td><label>
          <input type="checkbox" name="vesselcols[]" value="hp" id="vesselcols_10" />
          HP</label></td>
      </tr>
      <tr>
        <td><label>
          <input type="checkbox" name="vesselcols[]" value="gears" id="vesselcols_11" />
          Gears</label></td>
      </tr>
      <tr>
        <td><label>
          <input type="checkbox" name="vesselcols[]" value="navigation" id="vesselcols_12" />
          Navigation</label></td>
      </tr>
      <tr>
        <td><label>
          <input type="checkbox" name="vesselcols[]" value="communication" id="vesselcols_13" />
          Communication</label></td>
      </tr>
    </table></td>
    <td><table width="200">
      <tr>
        <td><label>
          <input type="checkbox" name="productioncols[]" value="all" id="productioncols_0" />
          All</label></td>
      </tr>
      <tr>
        <td><label>
          <input type="checkbox" name="productioncols[]" value="year" id="productioncols_1" />
          Year</label></td>
      </tr>
      <tr>
        <td><label>
          <input type="checkbox" name="productioncols[]" value="SWOproduction" id="productioncols_2" />
          SWO Production</label></td>
      </tr>
      <tr>
        <td><label>
          <input type="checkbox" name="productioncols[]" value="ALBproduction" id="productioncols_3" />
          ALB Production</label></td>
      </tr>
      <tr>
        <td><label>
          <input type="checkbox" name="productioncols[]" value="BFTproduction" id="productioncols_4" />
          BFT Production</label></td>
      </tr>
      <tr>
        <td><label>
          <input type="checkbox" name="productioncols[]" value="RVTproduction" id="productioncols_5" />
          RVT Production</label></td>
      </tr>
      <tr>
        <td><label>
          <input type="checkbox" name="productioncols[]" value="fishing_days" id="productioncols_6" />
          Fishing Days</label></td>
      </tr>
      <tr>
        <td><label>
          <input type="checkbox" name="productioncols[]" value="wtc" id="productioncols_7" />
          WTC</label></td>
      </tr>
      <tr>
        <td><label>
          <input type="checkbox" name="productioncols[]" value="bait" id="productioncols_8" />
          Bait</label></td>
      </tr>
      <tr>
        <td><label>
          <input type="checkbox" name="productioncols[]" value="other_fisheries" id="productioncols_9" />
          Other Fisheries</label></td>
      </tr>
      <tr>
        <td><label>
          <input type="checkbox" name="productioncols[]" value="extras" id="productioncols_10" />
          Extras</label></td>
      </tr>
    </table></td>
    <td><input type="checkbox" name="speciesmeasumentscols" id="speciesmeasumentscols" value="all" />
      <label for="speciesmeasumentscols">All</label></td>
  </tr>
</table>
<br />
<center><input type="button" id="searchanalysis" value="Submit"/> <input type="reset" id="resetbutton" value="Reset" /></center>
                         </form>
                         <div id="analysis_results"></div>
    <script>
        $(function () {
            $("#searchanalysis").click(function () {
				$.post("queryhandler.php", $("#analysis").serialize(), function (data){
					$("#analysis_results").html(data);
					$("#analysis_results").show("slow");
				});
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
        var counter=1;
        $("#expeditioncols_0").click(function() {
            if ($("#expeditioncols_0").is(':checked')) {
                for(counter=1; counter<=25; counter++) {
                    $("#expeditioncols_"+counter).prop( "disabled", true);
                    $("#expeditioncols_"+counter).prop( "checked", false);
                }
            } else {
                for(counter=1; counter<=25; counter++) {
                    $("#expeditioncols_"+counter).prop( "disabled", false);
                    //$("#expeditioncols_"+counter).prop( "checked", false);
                }
            }
        });
        $("#expedition_sizecols_0").click(function() {
            if ($("#expedition_sizecols_0").is(':checked')) {
                for(counter=1; counter<=4; counter++) {
                    $("#expedition_sizecols_"+counter).prop( "disabled", true);
                    $("#expedition_sizecols_"+counter).prop( "checked", false);
                }
            } else {
                for(counter=1; counter<=4; counter++) {
                    $("#expedition_sizecols_"+counter).prop( "disabled", false);
                    //$("#expeditioncols_"+counter).prop( "checked", false);
                }
            }
        });
        $("#vesselcols_0").click(function() {
            if ($("#vesselcols_0").is(':checked')) {
                for(counter=1; counter<=13; counter++) {
                    $("#vesselcols_"+counter).prop( "disabled", true);
                    $("#vesselcols_"+counter).prop( "checked", false);
                }
            } else {
                for(counter=1; counter<=13; counter++) {
                    $("#vesselcols_"+counter).prop( "disabled", false);
                    //$("#expeditioncols_"+counter).prop( "checked", false);
                }
            }
        });
        $("#productioncols_0").click(function() {
            if ($("#productioncols_0").is(':checked')) {
                for(counter=1; counter<=10; counter++) {
                    $("#productioncols_"+counter).prop( "disabled", true);
                    $("#productioncols_"+counter).prop( "checked", false);
                }
            } else {
                for(counter=1; counter<=10; counter++) {
                    $("#productioncols_"+counter).prop( "disabled", false);
                    //$("#expeditioncols_"+counter).prop( "checked", false);
                }
            }
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