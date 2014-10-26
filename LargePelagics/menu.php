<?php
if ($privcheck === 0)
echo "";
else {
	if($privcheck == "user" || $privcheck == "moderator" || $privcheck == "admin")
	{
		echo '<ul id="nav">
		<li><a href="inserted.php">Insert Expedition Data</a></li>
		<li><a href="insertv.php">Insert Vessel</a></li>
		<li><a href="edit_vessel.php">Insert production/gear per year</a></li>
		<li><a href="editd.php">Edit Data</a></li>';
	}
	if ($privcheck == "moderator" || $privcheck == "admin")
	{
		echo '<li><a href="newuser.php">Create New User</a></li>
		<li><a href="editsd.php">Static Data</a></li>
		<li><a href="userhistory.php">User History</a></li>
		<li><a href="analysis.php">View Analysis</a></li>';
	}
	if ($privcheck == "admin")
	{
		echo '<li><a href="createmod.php">Create New Moderator</a></li>
		<li><a href="backup/index.php">Back up</a></li>
                <li><a href="edituser.php">Edit Users</a></li>';
	}
	echo '</ul>';
}
?>