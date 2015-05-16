<?php
include("dbcon.php");
$sql = mysqli_query ($con, "SELECT common FROM species");
$result = array();
while ($row = mysqli_fetch_array($sql)){
	$result[] = array(
	'value' => addslashes($row['common']),
	);
}
echo json_encode($result);
?>