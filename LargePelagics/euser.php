<?php
require_once('dbcon.php');
if(!is_null($_POST['username'])){
    $newuname=$_POST['username'];
    $olduname=$_POST['olduname'];
    $newpass=$_POST['newpass'];
    if(empty($_POST['privileges'])){
        echo "to privileges einai empty";
    $sql="UPDATE users SET username ='$newuname', password ='$newpass' WHERE username='$olduname'";
    }
    else{
        $privileges=$_POST['privileges'];
        $sql="UPDATE users SET username = '$newuname', password='$newpass', privileges='$privileges' WHERE username='$olduname'";
    }
    $result=mysqli_query($con, $sql);
    if(mysqli_error($con)){
        echo mysqli_error($con);
        header("refresh:1;url=edituser.php");
    } else {
        echo "<h1>Success!</h1>";
        header("refresh:1;url=edituser.php");
    }
}
mysqli_close($con);
?>
