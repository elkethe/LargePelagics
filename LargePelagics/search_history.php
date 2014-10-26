<?php
include ("dbcon.php");
session_start();
$searchv = $_POST['searchv'];
if(empty($searchv)) {
	$sql = "SELECT action_username, action_AMAS, action_vproduction_ID, action_pproduction_ID, action_eexpedition_ID, 
										action_size_expedition_ID, action_ALBmeasure, action_BFTmeasure, action_RVTmeasure, action_SWOmeasure, 
										action_OTHERmeasure, action_date FROM users_action_history ORDER BY action_date DESC";
    } else {
    //If there is text in the search field, this code is executed every time the input changes.
	$sql = "SELECT action_username, action_AMAS, action_vproduction_ID, action_pproduction_ID, action_eexpedition_ID, 
										action_size_expedition_ID, action_ALBmeasure, action_BFTmeasure, action_RVTmeasure, action_SWOmeasure, 
										action_OTHERmeasure, action_date FROM users_action_history WHERE action_username LIKE '%$searchv%' OR 
										action_date LIKE '%$searchv%' ORDER BY action_date DESC";
	}
$result = mysqli_query($con, $sql);
echo "<table id=\"results\">
<tr>
<th>Username</th>
<th>AMAS</th>
<th>Production ID</th>
<th>Expedition ID</th>
<th>Catch Size</th>
<th>ALB Measure</th>
<th>BFT Measure</th>
<th>RVT Measure</th>
<th>SWO Measure</th>
<th>OTHER Measure</th>
<th>Date</th>
</tr>";
while($row = mysqli_fetch_array($result))
{
	echo "<tr>";
	echo "<td>" . $row['action_username'] . "</td>";
	echo "<td><a href=\"edit_vessel.php\">" . $row['action_AMAS'] . "</a></td>";
        if(!empty($row['action_pproduction_ID'])){
        echo '<td>'. $row['action_pproduction_ID'] .'-[<a href="edit_production.php?id=' . $row['action_pproduction_ID'] . '">Edit</a>] [<a href="production.php?action=delete&id=' . $row['action_pproduction_ID'] . '">Delete</a>]</td>';
        } else {
            echo '<td></td>';
        }
        if(!empty($row['action_eexpedition_ID'])){
            echo '<td>' . $row['action_eexpedition_ID'] . '-[<a href="edit_exp.php?id=' . $row['action_eexpedition_ID'] . '">Edit</a>] [<a href="change_exp.php?action=delete&id=' . $row['action_eexpedition_ID'] . '">Delete</a>]</td>';
        } else {
            echo '<td></td>';
        }        
	echo '<td><a href="edit_expsize.php?id=' . $row['action_eexpedition_ID'] . '">' . $row['action_eexpedition_ID'] . '</td>';
	if(!empty($row['action_ALBmeasure'])){
        echo '<td>' . $row['action_ALBmeasure'] . ' [<a href="edit_alb.php?id=' . $row['action_ALBmeasure'] . '">Edit</a>] [<a href="deletemeasurement.php?id=' . $row['action_ALBmeasure'] . '&species=ALB">Delete</a>]</td>';
        } else {
            echo '<td></td>';
        }
	if(!empty($row['action_BFTmeasure'])){
        echo '<td>' . $row['action_BFTmeasure'] . ' [<a href="edit_bft.php?id=' . $row['action_BFTmeasure'] . '">Edit</a>] [<a href="deletemeasurement.php?id=' . $row['action_BFTmeasure'] . '&species=BFT">Delete</a>]</td>';
        } else {
            echo '<td></td>';
        }
	if(!empty($row['action_RVTmeasure'])){
        echo '<td>' . $row['action_RVTmeasure'] . ' [<a href="edit_rvt.php?id=' . $row['action_RVTmeasure'] . '">Edit</a>] [<a href="deletemeasurement.php?id=' . $row['action_RVTmeasure'] . '&species=RVT">Delete</a>]</td>';
        } else {
            echo '<td></td>';
        }
	if(!empty($row['action_SWOmeasure'])){
        echo '<td>' . $row['action_SWOmeasure'] . ' [<a href="edit_swo.php?id=' . $row['action_SWOmeasure'] . '">Edit</a>] [<a href="deletemeasurement.php?id=' . $row['action_SWOmeasure'] . '&species=SWO">Delete</a>]</td>';
        } else {
            echo '<td></td>';
        }
	if(!empty($row['action_OTHERmeasure'])){
        echo '<td>' . $row['action_OTHERmeasure'] . ' [<a href="edit_other.php?id=' . $row['action_OTHERmeasure'] . '">Edit</a>] [<a href="deletemeasurement.php?id=' . $row['action_OTHERmeasure'] . '&species=OTHER">Delete</a>]</td>';
        } else {
            echo '<td></td>';
        }
	
	echo "<td>" . $row['action_date'] . "</td>";
	echo "</tr>";
}
echo "</table>";

