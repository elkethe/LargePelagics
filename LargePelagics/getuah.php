<?php
require_once('dbcon.php');
if(!empty($_POST['usersname'])){
    $user=$_POST['usersname'];
}else{
    $user="";
}
if(!empty($_POST['noactions'])){
    $resultsnumber=$_POST['noactions'];
    $recentactions="SELECT * FROM users_action_history WHERE action_username LIKE '%" . $user . "%' ORDER BY action_date DESC LIMIT ".$resultsnumber;
        if(!$result=mysqli_query($con,$recentactions)){
            die('Error: ' . mysqli_error($con));
        } else {
            $resultfields=mysqli_query($con, "SHOW COLUMNS FROM users_action_history");
            $colcounter=0;
            while ($rcol = mysqli_fetch_array($resultfields)){
                $colu[$colcounter] = $rcol['Field'];
                $colcounter++;
            }
            echo '<table id="results" class="tablesorter"><thead><tr>';
            for($i=0; $i<$colcounter; $i++){
                echo '<th>' . $colu[$i] . '</th>';
            }
            echo '</tr></thead><tbody>';
            while($row=mysqli_fetch_array($result)){
                echo  '<tr>';
                for($i=0; $i<$colcounter; $i++){
                    echo '<td>' . $row[$colu[$i]] . '</td>';
                }
                echo '</tr>';
            }
            echo '</tbody></table>';
        }

} else {
    $recentactions="SELECT * FROM users_action_history WHERE action_username LIKE '%" . $user . "%' ORDER BY action_date DESC";
    if(!$result=mysqli_query($con,$recentactions)){
        die('Error: ' . mysqli_error($con));
    } else {
        $resultfields=mysqli_query($con, "SHOW COLUMNS FROM users_action_history");
        $colcounter=0;
        while ($rcol = mysqli_fetch_array($resultfields)){
            $colu[$colcounter] = $rcol['Field'];
            $colcounter++;
        }
        echo '<table id="results" class="tablesorter"><thead><tr>';
        for($i=0; $i<$colcounter; $i++){
            echo '<th>' . $colu[$i] . '</th>';
        }
        echo '</tr></thead><tbody>';
        while($row=mysqli_fetch_array($result)){
            echo  '<tr>';
            for($i=0; $i<$colcounter; $i++){
                echo '<td>' . $row[$colu[$i]] . '</td>';
            }
            echo '</tr>';
        }
        echo '</tbody></table>';
    }
}
?>