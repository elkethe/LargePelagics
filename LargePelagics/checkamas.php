<?php

require_once 'dbcon.php';
if (isset($_POST['checkamas'])) {
    $amas = $_POST['checkamas'];
    $res = mysqli_query($con, "SELECT AMAS FROM vessel WHERE AMAS='$amas'");
    $amasexist = mysqli_num_rows($res);
    if ($amasexist) {
        echo ' <img src="img/tick.png" width = "15"/>';
    } else {
        echo ' <img src="img/xi.png" width = "15"/>';
    }
}
?>