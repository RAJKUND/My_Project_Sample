<?php
	include('config.php');
	
	$GradeName=$_POST['GradeName'];
	$NominalSize=$_POST['NominalSize'];
	$operation=$_POST['operation'];
	$Total_Weight=$_POST['Total_Weight'];
	$schedule=$_POST['schedule'];
	
	sqlsrv_query($conn,"update Tbl_Data_Schedule set EditDate=getdate(), Options='$operation', Total_Weight='$Total_Weight', Schedule='$schedule' where NominalSize='$NominalSize' AND GradeName='$GradeName'");
	header('location: http://www.nirmalwire.com/schedule.php');

?>