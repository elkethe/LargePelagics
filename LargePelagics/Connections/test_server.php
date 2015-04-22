<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_test_server = "localhost";
$database_test_server = "ELKETHE_DB";
$username_test_server = "root";
$password_test_server = "wtMGqJaF7DWgY";
$test_server = mysql_pconnect($hostname_test_server, $username_test_server, $password_test_server) or trigger_error(mysql_error(),E_USER_ERROR); 
?>
