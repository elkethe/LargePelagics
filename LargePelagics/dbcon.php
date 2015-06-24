<?php
$mysql_hostname = "localhost";
$mysql_user = "root";
// $mysql_password = "smyrgeorge";
$mysql_password = "wtMGqJaF7DWgY";
$mysql_database = "ELKETHE_DB";
$con = mysqli_connect($mysql_hostname, $mysql_user, $mysql_password, $mysql_database)
or die("Opps something went wrong while connecting with the database!");
mysqli_set_charset($con, "utf8");
?>
