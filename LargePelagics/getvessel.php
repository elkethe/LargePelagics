<script type="text/javascript" src="jquery.js"></script>
<?php
session_start();
header('Content-Type: text/html; charset=UTF-8');
include ("dbcon.php");
mysqli_set_charset($con, "utf8");
$searchv = $_POST['searchv'];
if(empty($searchv)) {
	$sql = "SELECT * FROM vessel";
    } else {
    //If there is text in the search field, this code is executed every time the input changes.
	$sql = "SELECT * FROM vessel WHERE AMAS LIKE '%$searchv%' OR vessel_name LIKE '%$searchv%'";
	}
$result = mysqli_query($con, $sql);
echo "<table id=\"results\">
<tr id=\"results\">
<th>AMAS</th>
<th>Vessel Name</th>
<th>Reg No State</th>
<th>Port</th>
<th>Port Area</th>
<th>GRT</th>
<th>VL</th>
<th>VLC</th>
<th>VW</th>
<th>HP</th>
<th>Gears</th>
<th>Navigation</th>
<th>Communication</th>
</tr>";
while($row = mysqli_fetch_array($result))
  {
  echo "<tr>";
  echo '<td>' . $row['AMAS'] . '</td>';
  echo "<td>" . $row['vessel_name'] . "</td>";
  echo "<td>" . $row['reg_no_state'] . "</td>";
  
  echo "<td>" . $row['port'] . "</td>";
  echo "<td>" . $row['port_area'] . "</td>";
  echo "<td>" . $row['grt'] . "</td>";
  echo "<td>" . $row['vl'] . "</td>";
  echo "<td>" . $row['vlc'] . "</td>";
  echo "<td>" . $row['vw'] . "</td>";
  echo "<td>" . $row['hp'] . "</td>";
  echo "<td>" . $row['gears'] . "</td>";  
  echo "<td>" . $row['navigation'] . "</td>";
  echo "<td>" . $row['communication'] . "</td>";
  echo "</tr>";
  }
echo "</table>";

?>
