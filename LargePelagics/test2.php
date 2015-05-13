<?php
//$species = $_POST['species'];
//print_r($species);
echo '<br />';
$speciesnumber =  $_POST['speciesnumber'];
echo '<b>' . $_POST['speciesnumber'][0] . '</b>';
print_r($speciesnumber);
echo '<br />';
settype($speciesnumber, 'float');
echo var_dump($speciesnumber);
//echo 'species[0]: '.$species[0];
echo '<br />';
echo var_export($speciesnumber);
//$speciescounter = $_POST['speciescounter'];
//echo $speciescounter;
?>