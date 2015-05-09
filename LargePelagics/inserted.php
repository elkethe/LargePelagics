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
        <link href='css/redmond/jquery-ui-1.10.3.custom.min.css' rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="jquery.js"></script>
        <script type="text/javascript" src="js/jquery-ui.js"></script>
        <script src="js/jquery-ui-timepicker.js"></script>
        <script>
            //Species Measurements fields to show and hide depending on the selected species each field. By default ALL available fields appear
            function changeFields(target) {
                if (target.value === "Albacore")
                {
                    var x = target.parentNode.id;
                    var splitx = x.split("_");
                    var rowNumber = splitx[1];
                    //Fields to hide:
                    $("label[for='measureljfl_" + rowNumber + "'],#measureljfl_" + rowNumber).hide("slow");
                    $("label[for='measuretl_" + rowNumber + "'],#measuretl_" + rowNumber).hide("slow");
                    $("label[for='measurepffl_" + rowNumber + "'],#measurepffl_" + rowNumber).hide("slow");
                    $("label[for='measurepfl_" + rowNumber + "'],#measurepfl_" + rowNumber).hide("slow");
                    $("label[for='measurehead_length_" + rowNumber + "'],#measurehead_length_" + rowNumber).hide("slow");
                    $("label[for='measureparasites_" + rowNumber + "'],#measureparasites_" + rowNumber).hide("slow");
                    //fields to show:
                    $("label[for='measurefl_" + rowNumber + "'],#measurefl_" + rowNumber).show("slow");
                    $("label[for='measuregg_" + rowNumber + "'],#measuregg_" + rowNumber).show("slow");
                    $("label[for='measuredw_" + rowNumber + "'],#measuredw_" + rowNumber).show("slow");
                    $("label[for='measurerw_" + rowNumber + "'],#measurerw_" + rowNumber).show("slow");
                    $("label[for='measuresex_" + rowNumber + "'],#measuresex_" + rowNumber).show("slow");
                    $("label[for='measurematur_stage_" + rowNumber + "'],#measurematur_stage_" + rowNumber).show("slow");
                    $("label[for='measuregon_wei_" + rowNumber + "'],#measuregon_wei_" + rowNumber).show("slow");
                    $("label[for='measurelife_status_" + rowNumber + "'],#measurelife_status_" + rowNumber).show("slow");
                    $("label[for='measurebait_type_" + rowNumber + "'],#measurebait_type_" + rowNumber).show("slow");
                    $("label[for='measurecommercial_" + rowNumber + "'],#measurecommercial_" + rowNumber).show("slow");
                }
                else if (target.value === "Bluefin tuna")
                {
                    var x = target.parentNode.id;
                    var splitx = x.split("_");
                    var rowNumber = splitx[1];
                    //Fields to hide:
                    $("label[for='measureljfl_" + rowNumber + "'],#measureljfl_" + rowNumber).hide("slow");
                    $("label[for='measuretl_" + rowNumber + "'],#measuretl_" + rowNumber).hide("slow");
                    $("label[for='measurepffl_" + rowNumber + "'],#measurepffl_" + rowNumber).hide("slow");
                    $("label[for='measurehead_length_" + rowNumber + "'],#measurehead_length_" + rowNumber).hide("slow");
                    $("label[for='measureparasites_" + rowNumber + "'],#measureparasites_" + rowNumber).hide("slow");
                    //fields to show:
                    $("label[for='measurefl_" + rowNumber + "'],#measurefl_" + rowNumber).show("slow");
                    $("label[for='measuregg_" + rowNumber + "'],#measuregg_" + rowNumber).show("slow");
                    $("label[for='measuredw_" + rowNumber + "'],#measuredw_" + rowNumber).show("slow");
                    $("label[for='measurerw_" + rowNumber + "'],#measurerw_" + rowNumber).show("slow");
                    $("label[for='measuresex_" + rowNumber + "'],#measuresex_" + rowNumber).show("slow");
                    $("label[for='measurematur_stage_" + rowNumber + "'],#measurematur_stage_" + rowNumber).show("slow");
                    $("label[for='measuregon_wei_" + rowNumber + "'],#measuregon_wei_" + rowNumber).show("slow");
                    $("label[for='measurelife_status_" + rowNumber + "'],#measurelife_status_" + rowNumber).show("slow");
                    $("label[for='measurebait_type_" + rowNumber + "'],#measurebait_type_" + rowNumber).show("slow");
                    $("label[for='measurecommercial_" + rowNumber + "'],#measurecommercial_" + rowNumber).show("slow");
                    $("label[for='measurepfl_" + rowNumber + "'],#measurepfl_" + rowNumber).hide("slow");
                }
                else if (target.value === "Oilfish")
                {
                    var x = target.parentNode.id;
                    var splitx = x.split("_");
                    var rowNumber = splitx[1];
                    //Fields to hide:
                    $("label[for='measureljfl_" + rowNumber + "'],#measureljfl_" + rowNumber).hide("slow");
                    $("label[for='measurepfl_" + rowNumber + "'],#measurepfl_" + rowNumber).hide("slow");
                    $("label[for='measurehead_length_" + rowNumber + "'],#measurehead_length_" + rowNumber).hide("slow");
                    $("label[for='measureparasites_" + rowNumber + "'],#measureparasites_" + rowNumber).hide("slow");
                    $("label[for='measurematur_stage_" + rowNumber + "'],#measurematur_stage_" + rowNumber).hide("slow");
                    $("label[for='measuregon_wei_" + rowNumber + "'],#measuregon_wei_" + rowNumber).hide("slow");
                    //fields to show:
                    $("label[for='measurefl_" + rowNumber + "'],#measurefl_" + rowNumber).show("slow");
                    $("label[for='measuretl_" + rowNumber + "'],#measuretl_" + rowNumber).show("slow");
                    $("label[for='measuregg_" + rowNumber + "'],#measuregg_" + rowNumber).show("slow");
                    $("label[for='measuredw_" + rowNumber + "'],#measuredw_" + rowNumber).show("slow");
                    $("label[for='measurerw_" + rowNumber + "'],#measurerw_" + rowNumber).show("slow");
                    $("label[for='measuresex_" + rowNumber + "'],#measuresex_" + rowNumber).show("slow");
                    $("label[for='measurepffl_" + rowNumber + "'],#measurepffl_" + rowNumber).show("slow");
                    $("label[for='measurelife_status_" + rowNumber + "'],#measurelife_status_" + rowNumber).show("slow");
                    $("label[for='measurebait_type_" + rowNumber + "'],#measurebait_type_" + rowNumber).show("slow");
                    $("label[for='measurecommercial_" + rowNumber + "'],#measurecommercial_" + rowNumber).show("slow");
                }
                else if (target.value === "Swordfish")
                {
                    var x = target.parentNode.id;
                    var splitx = x.split("_");
                    var rowNumber = splitx[1];
                    //Fields to hide:
                    $("label[for='measurefl_" + rowNumber + "'],#measurefl_" + rowNumber).hide("slow");
                    $("label[for='measurepffl_" + rowNumber + "'],#measurepffl_" + rowNumber).hide("slow");
                    $("label[for='measuretl_" + rowNumber + "'],#measuretl_" + rowNumber).hide("slow");
                    //fields to show:
                    $("label[for='measureljfl_" + rowNumber + "'],#measureljfl_" + rowNumber).show("slow");
                    $("label[for='measurepfl_" + rowNumber + "'],#measurepfl_" + rowNumber).show("slow");
                    $("label[for='measurehead_length_" + rowNumber + "'],#measurehead_length_" + rowNumber).show("slow");
                    $("label[for='measureparasites_" + rowNumber + "'],#measureparasites_" + rowNumber).show("slow");
                    $("label[for='measurematur_stage_" + rowNumber + "'],#measurematur_stage_" + rowNumber).show("slow");
                    $("label[for='measuregon_wei_" + rowNumber + "'],#measuregon_wei_" + rowNumber).show("slow");
                    $("label[for='measuregg_" + rowNumber + "'],#measuregg_" + rowNumber).show("slow");
                    $("label[for='measuredw_" + rowNumber + "'],#measuredw_" + rowNumber).show("slow");
                    $("label[for='measurerw_" + rowNumber + "'],#measurerw_" + rowNumber).show("slow");
                    $("label[for='measuresex_" + rowNumber + "'],#measuresex_" + rowNumber).show("slow");
                    $("label[for='measurelife_status_" + rowNumber + "'],#measurelife_status_" + rowNumber).show("slow");
                    $("label[for='measurebait_type_" + rowNumber + "'],#measurebait_type_" + rowNumber).show("slow");
                    $("label[for='measurecommercial_" + rowNumber + "'],#measurecommercial_" + rowNumber).show("slow");
                }
                else
                {
                    var x = target.parentNode.id;
                    var splitx = x.split("_");
                    var rowNumber = splitx[1];
                    //Fields to hide:
                    $("label[for='measurepfl_" + rowNumber + "'],#measurepfl_" + rowNumber).hide("slow");
                    $("label[for='measurehead_length_" + rowNumber + "'],#measurehead_length_" + rowNumber).hide("slow");
                    $("label[for='measureparasites_" + rowNumber + "'],#measureparasites_" + rowNumber).hide("slow");
                    $("label[for='measurematur_stage_" + rowNumber + "'],#measurematur_stage_" + rowNumber).hide("slow");
                    $("label[for='measuregon_wei_" + rowNumber + "'],#measuregon_wei_" + rowNumber).hide("slow");
                    $("label[for='measureljfl_" + rowNumber + "'],#measureljfl_" + rowNumber).hide("slow");
                    $("label[for='measurepffl_" + rowNumber + "'],#measurepffl_" + rowNumber).hide("slow");
                    //fields to show:
                    $("label[for='measurefl_" + rowNumber + "'],#measurefl_" + rowNumber).show("slow");
                    $("label[for='measuretl_" + rowNumber + "'],#measuretl_" + rowNumber).show("slow");
                    $("label[for='measuregg_" + rowNumber + "'],#measuregg_" + rowNumber).show("slow");
                    $("label[for='measuredw_" + rowNumber + "'],#measuredw_" + rowNumber).show("slow");
                    $("label[for='measurerw_" + rowNumber + "'],#measurerw_" + rowNumber).show("slow");
                    $("label[for='measuresex_" + rowNumber + "'],#measuresex_" + rowNumber).show("slow");
                    $("label[for='measurelife_status_" + rowNumber + "'],#measurelife_status_" + rowNumber).show("slow");
                    $("label[for='measurebait_type_" + rowNumber + "'],#measurebait_type_" + rowNumber).show("slow");
                    $("label[for='measurecommercial_" + rowNumber + "'],#measurecommercial_" + rowNumber).show("slow");
                }
            }
            //DatePicker:
            $(function() {
                var elem = document.createElement('input');
                elem.setAttribute('type', 'date');
                if (elem.type === 'text') {
                    $('.date').each(function() {
                        $(this).datepicker({
                            dateFormat: 'yy-mm-dd'
                        });
                    });
                }
            });
            //TimePicker:
            $(function() {
                var elem = document.createElement('input');
                elem.setAttribute('type', 'time');
                if (elem.type === 'text') {
                    $('.time').each(function() {
                        $(this).timepicker({
                            timeFormat: 'HH:mm:ss'
                        });
                    });
                }
            });
        </script>
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
            function checkamas() {
                var amasnumber = document.forms["insertform"]["amascounter"].value;
                var fcounter = 1;
                for (fcounter = 1; fcounter <= amasnumber; fcounter++) {
                    var amasvalue = document.forms["insertform"]["AMAS" + fcounter].value;
                    alert("To value tou " + AMAS + fcounter + " einai" + amasvalue);
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
                <?php
                require_once("loginform.php");
                require_once("dbcon.php");
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
                if ($privcheck == "admin" || $privcheck == "moderator" || $privcheck == "user" && $usercheck != "" && $usercheck != NULL) {
                    echo '<h2 class="vesselheading">Vessel Information</h2>';

                    echo '<form action="expedition.php" method="post" id="insertform" name="insertform">';
                    ?>
                    <div id="amassearch"><label for="searchbox">Search AMAS: </label>
                        <input type="text" id="searchbox" autocomplete="off" id="searchbox" name="searchv" /><sup style="color:#f00;"><em>This field is only for searching vessels! You should input the AMAS in the above fields!</em></sup></div>
                    <div id="showamas"></div>
                    <div id="AMASRows">
                        <p id="rowAMASNum1"> AMAS(1): <input type="text" name="AMAS1" size="5" id="amas"/> <input onClick="addAMASRow(this.form);" type="button" style="float:right;" value="+" />
                            <label for="amascounter" style="float:right;" class="lblamascounter">Vessel </label><input id="amascounter" size="2" name="amascounter" type="text" value="1" readonly style="float:right;"/></p>

                    </div>
                    <script type="text/javascript">
                        var i = 0;
                        var rowAMASNum = 2;
                        var frm = document.getElementById('insertform');
                        function addAMASRow(frm) {
                            var AMASrow = '<p id="rowAMASNum' + rowAMASNum + '">AMAS(' + rowAMASNum + '): <input class="amas" type="text" name="AMAS' + rowAMASNum + '" size="5" /></p>';
                            jQuery('#AMASRows').append(AMASrow);
                            document.getElementsByName("amascounter")[0].value = rowAMASNum;
                            rowAMASNum++;
                            $(".vesselheading").html("Vessels Information");
                            $(".lblamascounter").html("Vessels ");
                        }
                        $('#searchbox').keyup(function() {
                            $.post('getvessel.php', $("#searchbox").serialize(), function(data) {
                                $('#showamas').html(data);
                                if (i == 0) {
                                    $('#showamas').show("slow");
                                    i++;
                                }
                            });
                        });
                        $(document).click(function(e) {
                            var cont = $('#showamas');
                            if(!cont.is(e.target) && cont.has(e.target).length === 0){
                            $('#showamas').hide("slow");
                            i = 0;
                        }
                        });
                    </script>

                    <?php
                    echo'<h2>Expedition Data</h2>
					 <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="25%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td>Departure Date:</td>
            <td><input name="deploydate" type="date" class="date" /></td>
          </tr>
          <tr>
            <td>Return Date:</td>
            <td><input name="returndate" type="date" class="date" /></td>
          </tr>
          <tr>
            <td>Hooks/day:</td>
            <td><input name="hooksday" type="text" /></td>
          </tr>
          <tr>
            <td>Fishing days:</td>
            <td><input name="fishingdays" type="number" /></td>
          </tr>
          <tr>
            <td>Effort:</td>
            <td><input name="effort" type="text" /></td>
          </tr>
          <tr>
            <td>Detail Area:</td>
            <td><input name="detailarea" type="text" /></td>
          </tr>
          <tr>
            <td>Gear:</td>
            <td><select name="gear"><option value="">Select...</option>';
                    $gearq = "SELECT * FROM gears";
                    $result = mysqli_query($con, $gearq);
                    while ($row = mysqli_fetch_array($result)) {
                        echo '<option value="' . $row['name'] . '">' . $row['code'] . ' - ' . $row['name'] . '</option>';
                    }
                    echo ' </select></td>
          </tr>
          <tr>
            <td>Light sticks:</td>
            <td>
				<select name="lightsticks">
  					<option value="">Select...</option>
  					<option value="1">YES</option>
 					 <option value="0">NO</option>
				</select>
			</td>
          </tr>
          <tr>
            <td>Info Origin:</td>
            <td>
				<select name="infoorigin">
  					<option value="">Select...</option>
  					<option value="OBS">OBS</option>
 					<option value="LAN">LAN</option>
				</select>
			</td>
          </tr>
        </table></td>
        <td width="25%" valign="top"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <caption><b>Gear setting details</b></caption>
          <tr>
            <td>Start setting time:</td>
            <td><input name="startsettingtime" type="time" class="time" /></td>
          </tr>
          <tr>
            <td>Start LAT: </td>
            <td><input name="startlatd" type="text" size="2" />&deg; <input name="startlatm" type="text" size="2" />&acute; <input name="startlats" type="text" size="2" />&acute;&acute; <select name="startlatdir"><option value="N">N</option><option value="S">S</option></select></td>
          </tr>
          <tr>
            <td>Start LON:</td>
            <td><input name="startlond" type="text" size="2" />&deg; <input name="startlonm" type="text" size="2" />&acute; <input name="startlons" type="text" size="2" />&acute;&acute; <select name="startlondir"><option value="E">E</option><option value="W">W</option></select></td>
          </tr>
          <tr>
            <td>End set time: </td>
            <td><input name="endsettime" type="time" class="time"  /></td>
          </tr>
          <tr>
            <td>End LAT:</td>
            <td><input name="endlatd" type="text" size="2" />&deg; <input name="endlatm" type="text" size="2" />&acute; <input name="endlats" type="text" size="2" />&acute;&acute;<select name="endlatdir"><option value="N">N</option><option value="S">S</option></select> </td>
          </tr>
          <tr>
            <td>End LON:</td>
            <td><input name="endlond" type="text" size="2" />&deg; <input name="endlonm" type="text" size="2" />&acute; <input name="endlons" type="text" size="2" />&acute;&acute;<select name="endlondir"><option value="E">E</option><option value="W">W</option></select> </td>
          </tr>
        </table></td>
        <td width="25%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <caption>
            <b>Gear hauling details</b>
            </caption>
          <tr>
            <td>Start haul time: </td>
            <td><input name="starthaultime" type="time" class="time" /></td>
          </tr>
          <tr>
            <td>Start LAT haul:</td>
            <td><input name="startlathauld" type="text" size="2" />&deg; <input name="startlathaulm" type="text" size="2" />&acute; <input name="startlathauls" type="text" size="2" />&acute;&acute; <select name="startlathauldir"><option value="N">N</option><option value="S">S</option></select></td>
          </tr>
          <tr>
            <td>Start LON haul:</td>
            <td><input name="startlonhauld" type="text" size="2" />&deg; <input name="startlonhaulm" type="text" size="2" />&acute; <input name="startlonhauls" type="text" size="2" />&acute;&acute; <select name="startlonhauldir"><option value="E">E</option><option value="W">W</option></select></td>
          </tr>
          <tr>
            <td>End haul time: </td>
            <td><input name="endhaultime" type="time" class="time" /></td>
          </tr>
          <tr>
            <td>End LAT haul: </td>
            <td><input name="endlathauld" type="text" size="2" />&deg; <input name="endlathaulm" type="text" size="2" />&acute; <input name="endlathauls" type="text" size="2" />&acute;&acute; <select name="endlathauldir"><option value="N">N</option><option value="S">S</option></select></td>
          </tr>
          <tr>
            <td>End LON haul:</td>
            <td><input name="endlonhauld" type="text" size="2" />&deg; <input name="endlonhaulm" type="text" size="2" />&acute; <input name="endlonhauls" type="text" size="2" />&acute;&acute; <select name="endlonhauldir"><option value="E">E</option><option value="W">W</option></select></td>
          </tr>
        </table></td>
        <td width="25%" valign="top">';
                    ?>

                    <p style="text-align:center;"><b>Catch</b></p>
                    <div id="itemRows">
                        <select name="species">
                            <option value="">Select Species</option>';
                            <?php
                            $sql = "SELECT common FROM species";
                            $speciesq = mysqli_query($con, $sql);

                            while ($row = mysqli_fetch_array($speciesq)) {
                                echo "<option value=\"" . $row['common'] . "\">" . $row['common'] . "</option>";
                            }
                            ?> 
                        </select> <br />
                        Number: <input type="text" name="speciesnumber" size="4" /><br />
                        Weight: <input type="text" name="speciesweight" size="4" /><br />
                        Commercial: <select name="ccommercial"> 
                            <option value="y">Yes</option>
                            <option value="n">No</option>
                        </select>
                        <input onClick="addRow(this.form);" type="button" style="float:right;" value="+" /> 
                        <input name="speciescounter" type="hidden" value="0"/>
                    </div>
                    <script type="text/javascript">
                        var rowNum = 0;
                        var ddselc = '</select>';
                        var frm = document.getElementById('insertform');

                        function addRow(frm) {
                            $.post("getlist.php", function(data) {
                                var ddopt = '<option value="">Select Species</option>';
                                var ddsel = '<select name="species' + rowNum + '">';
                                for (var i = 0; i < data.length; i++) {
                                    ddopt += '<option value="' + data[i].value + '">' + data[i].value + '</option>';
                                }
                                var row = '<p id="rowNum' + rowNum + '">' + ddsel + ddopt + ddselc + '<br />Number: <input type="text" name="speciesnumber' + rowNum + '" size="4" value=""><br /> Weight: <input type="text" name="speciesweight' + rowNum + '" value="" size="4"><br />Commercial: <select name="ccommercial'+rowNum+'"><option value="y">Yes</option><option value="n">No</option></select> <input type="button" style="float:right;" value="-" onclick="removeRow(' + rowNum + ');"></p>';
                                jQuery('#itemRows').append(row);
                                //frm.speciesnumber.value = "";
                                //frm.speciesweight.value = "";
                                rowNum++;
                                ddopt.length = 0;
                                document.getElementsByName("speciescounter")[0].value = rowNum;
                            }, "json");
                        }
                        function removeRow(rnum) {
                            jQuery('#rowNum' + rnum).remove();
                        }
                        $("#itemRows").keyup(function(event) {
                            if (event.keyCode == 17) {
                                addRow(this.form);
                            }
                        });
                    </script>

                    <?php echo '</td>
       </tr>
</table>
                     <textarea name="comments" cols="30" rows="4" placeholder="comments"></textarea>'; ?>
                    <br />
                    <h2>Catch Measurements</h2>

                    <div id="specMeasure">
                        <p id="rowMeasureNum_0"><select name="speciesmeasure_0" onchange="changeFields(this);">
                                <option value="">Select Species</option>';
                                <?php
                                $sql = "SELECT common FROM species";
                                $speciesq = mysqli_query($con, $sql);

                                while ($row = mysqli_fetch_array($speciesq)) {
                                    echo "<option value=\"" . $row['common'] . "\">" . $row['common'] . "</option>";
                                }
                                ?> 
                            </select>
                            <label for="measurefl_0">FL:</label>
                            <input type="text" name="measurefl_0" id="measurefl_0" size="4"/>
                            <label for="measureljfl_0">LJFL:</label>
                            <input type="text" name="measureljfl_0" size="4" id="measureljfl_0" />
                            <label for="measuretl_0">TL:</label>
                            <input type="text" name="measuretl_0" size="4" id="measuretl_0"/>
                            <label for="measurepffl_0">PFFL:</label>
                            <input type="text" name="measurepffl_0" size="4" id="measurepffl_0" /> 
                            <label for="measuregg_0">GG:</label>
                            <input type="text" name="measuregg_0" size="4" id="measuregg_0" /> 
                            <label for="measuredw_0">DW:</label>
                            <input type="text" name="measuredw_0" size="4" id="measuredw_0" /> 
                            <label for="measurerw_0">RW:</label>
                            <input type="text" name="measurerw_0" size="4" id="measurerw_0" /> 
                            <label for="measuresex_0">SEX:</label>
                            <select name="measuresex_0" id="measuresex_0">
                                <option value="Unknown">Unknown</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select> 
                            <label for="measurepfl_0">PFL:</label>
                            <input type="text" name="measurepfl_0" size="4" id="measurepfl_0" />
                            <label for="measurematur_stage_0">Mature Stage:</label>
                            <input type="text" name="measurematur_stage_0" size="4" id="measurematur_stage_0" />
                            <label for="measuregon_wei_0">GON weight:</label>
                            <input type="text" name="measuregon_wei_0" size="4" id="measuregon_wei_0" />
                            <label for="measurehead_length_0">Head Length:</label>
                            <input type="text" name="measurehead_length_0" size="4" id="measurehead_length_0" />
                            <label for="measureparasites_0">Parasites:</label>
                            <input type="text" name="measureparasites_0" size="4" id="measureparasites_0" />
                            <label for="measurelife_status_0">Life Status:</label>
                            <input type="text" name="measurelife_status_0" size="4" id="measurelife_status_0" />
                            <label for="measurebait_type_0">Bait Type:</label>
                            <input type="text" name="measurebait_type_0" size="4" id="measurebait_type_0" />
                            <label for="measurecommercial_0">Commercial:</label>
                            <input type="text" name="measurecommercial_0" size="4" id="measurecommercial_0" />
                            <input onClick="addMeasureRow(this.form);" type="button" style="float:right;" value="+" />
                            <input name="speciesmeasurecounter" type="hidden" value="0"/></p><br />
                    </div>
                    <script type="text/javascript">
                        var rowMeasureNum = 1;
                        var ddselc = '</select>';
                        var frm = document.getElementById('insertform');
                        function addMeasureRow(frm) {
                            $.post("getlist.php", function(data) {
                                var ddopt = '<option value="">Select Species</option>';
                                var ddsel = '<select name="speciesmeasure_' + rowMeasureNum + '" onchange="changeFields(this);">';
                                for (var i = 0; i < data.length; i++) {
                                    ddopt += '<option value="' + data[i].value + '">' + data[i].value + '</option>';
                                }
                                var row = '<p id="rowMeasureNum_' + rowMeasureNum + '">' + ddsel + ddopt + ddselc + '<label for="measurefl_' + rowMeasureNum + '">FL:</label>\
                        <input type="text" name="measurefl_' + rowMeasureNum + '" id="measurefl_' + rowMeasureNum + '" size="4"/>\
                 <label for="measureljfl_' + rowMeasureNum + '">LJFL:</label>\
                        <input type="text" name="measureljfl_' + rowMeasureNum + '" size="4" id="measureljfl_' + rowMeasureNum + '" />\
                 <label for="measuretl_' + rowMeasureNum + '">TL:</label>\
                        <input type="text" name="measuretl_' + rowMeasureNum + '" size="4" id="measuretl_' + rowMeasureNum + '"/>\
                 <label for="measurepffl_' + rowMeasureNum + '">PFFL:</label>\
                        <input type="text" name="measurepffl_' + rowMeasureNum + '" size="4" id="measurepffl_' + rowMeasureNum + '" /> \
                 <label for="measuregg_' + rowMeasureNum + '">GG:</label>\
                        <input type="text" name="measuregg_' + rowMeasureNum + '" size="4" id="measuregg_' + rowMeasureNum + '" /> \
                 <label for="measuredw_' + rowMeasureNum + '">DW:</label>\
                        <input type="text" name="measuredw_' + rowMeasureNum + '" size="4" id="measuredw_' + rowMeasureNum + '" /> \
                 <label for="measurerw_' + rowMeasureNum + '">RW:</label>\
                        <input type="text" name="measurerw_' + rowMeasureNum + '" size="4" id="measurerw_' + rowMeasureNum + '" /> \
                 <label for="measuresex_' + rowMeasureNum + '">SEX:</label>\
                 <select name="measuresex_' + rowMeasureNum + '" id="measuresex_' + rowMeasureNum + '">\
                        <option value="Unknown">Unknown</option>\
                        <option value="Male">Male</option>\
                        <option value="Female">Female</option>\
                 </select> \
                 <label for="measurepfl_' + rowMeasureNum + '">PFL:</label>\
                        <input type="text" name="measurepfl_' + rowMeasureNum + '" size="4" id="measurepfl_' + rowMeasureNum + '" />\
                 <label for="measurematur_stage_' + rowMeasureNum + '">Mature Stage:</label>\
                        <input type="text" name="measurematur_stage_' + rowMeasureNum + '" size="4" id="measurematur_stage_' + rowMeasureNum + '" />\
                 <label for="measuregon_wei_' + rowMeasureNum + '">GON weight:</label>\
                        <input type="text" name="measuregon_wei_' + rowMeasureNum + '" size="4" id="measuregon_wei_' + rowMeasureNum + '" />\
                 <label for="measurehead_length_' + rowMeasureNum + '">Head Length:</label>\
                        <input type="text" name="measurehead_length_' + rowMeasureNum + '" size="4" id="measurehead_length_' + rowMeasureNum + '" />\
                 <label for="measureparasites_' + rowMeasureNum + '">Parasites:</label>\
                        <input type="text" name="measureparasites_' + rowMeasureNum + '" size="4" id="measureparasites_' + rowMeasureNum + '" />\
                 <label for="measurelife_status_' + rowMeasureNum + '">Life Status:</label>\
                        <input type="text" name="measurelife_status_' + rowMeasureNum + '" size="4" id="measurelife_status_' + rowMeasureNum + '" />\
                 <label for="measurebait_type_' + rowMeasureNum + '">Bait Type:</label>\
                        <input type="text" name="measurebait_type_' + rowMeasureNum + '" size="4" id="measurebait_type_' + rowMeasureNum + '" />\
                 <label for="measurecommercial_' + rowMeasureNum + '">Commercial:</label>\
                        <input type="text" name="measurecommercial_' + rowMeasureNum + '" size="4" id="measurecommercial_' + rowMeasureNum + '" /> <input type="button" style="float:right;" value="-" onclick="removeMeasureRow(' + rowMeasureNum + ');"></p><br />';
                                jQuery('#specMeasure').append(row);
                                //frm.speciesnumber.value = '';
                                //frm.speciesweight.value = '';
                                rowMeasureNum++;
                                ddopt.length = 0;
                                document.getElementsByName("speciesmeasurecounter")[0].value = rowMeasureNum;
                            }, "json");
                        }
                        function removeMeasureRow(rnum) {
                            jQuery('#rowMeasureNum_' + rnum).remove();
                        }
                        $("#specMeasure").keyup(function(event) {
                            if (event.keyCode == 17) {
                                addMeasureRow(this.form);
                            }
                        });
                    </script>

                    <br />
                    <br />
                    <?php
                    echo' <div class="ifbutton"><input name="submit" type="submit" id="button" value="Submit" onclick="return checkamas()" /> <input name="reset" type="reset" id="button" value="Reset" /></div>

                  </form>';
                } else {
                    echo "You have to login to see this page!";
                }
                ?>
                <script>
                    function checkamas() {
                        var amasnumber = document.forms["insertform"]["amascounter"].value;
                        var fcounter = 1;
                        for (fcounter = 1; fcounter <= amasnumber; fcounter++) {
                            var amasvalue = document.forms["insertform"]["AMAS" + fcounter].value;
                            if (amasvalue == "") {
                                alert("Value of AMAS(" + fcounter + ") is empty! \n You must fill all AMAS inputs!");
                                return false;
                            } else {
                                return true;
                            }
                        }
                    }
                </script>

            </div>
        </div>
        <div id="footer"><a href="help/index.html" target="_blank">HELP</a></div>
        </div>
    </body>
</html>