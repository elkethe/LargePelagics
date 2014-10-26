<?php
include ("dbcon.php");
session_start();
$searchv = $_POST['searchv'];
if(empty($searchv)) {
	$sql = "SELECT * FROM vessel";
    } else {
    //If there is text in the search field, this code is executed every time the input changes.
	$sql = "SELECT * FROM vessel WHERE AMAS LIKE '%$searchv%' OR vessel_name LIKE '%$searchv%'";
	}
$result = mysqli_query($con, $sql);
echo "<table id=\"results\">
<tr>
<th>AMAS</th>
<th>vessel_name</th>
<th>reg_no_state</th>
<th>port</th>
<th>port_area</th>
<th>grt</th>
<th>vl</th>
<th>vlc</th>
<th>vw</th>
<th>hp</th>
<th>Gears</th>
<th>navigation</th>
<th>communication</th>
<th colspan=\"2\">Edit</th>
</tr>";
while($row = mysqli_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>" . $row['AMAS'] . "</td>";
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
  echo "<td><a href=\"edit_gear.php?takeamas=" . $row['AMAS'] . "\">Edit gear</a></td>";
  echo "<td><a href=\"edit_production.php?takeamas=" . $row['AMAS'] . "\">Edit production</a></td>";
  echo "</tr>";
  }
echo "</table>";
?>
