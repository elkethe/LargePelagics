<?php
session_start();
$usercheck = $_SESSION['sess_username'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Large Pelagic Database</title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php
$exportdata=$_POST['export'];
if($_POST['filexport'] =="xls")
{
	$filename = $usercheck . "_exportdata_" .date('d-m-Y_Hi').".xls" ;
	header("Content-type: application/msexcel");
	header("Content-Disposition: attachment; filename=$filename");	// the filename must end in .xls
	header("Pragma: no-cache");
	header("Expires: 0");
	print "$exportdata";
}
else
{
	$filename = $usercheck . "_exportdata_".date('d-m-Y_Hi').".csv" ;
	header("Content-type: application/msworks");
	header("Content-Disposition: attachment; filename=$filename");
	header("Pragma: no-cache");
	header("Expires: 0");
	print "$exportdata";
}
?>
</body>
</html>