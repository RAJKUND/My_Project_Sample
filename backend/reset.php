<?php
	include('config.php');
	
	$GradeName=$_POST['GradeName'];
	$NominalSize=$_POST['NominalSize'];
	
	sqlsrv_query($conn,"update Tbl_Data_Schedule set EditDate=getdate(), Options='', Total_Weight='', Schedule='99' where NominalSize='$NominalSize' AND GradeName='$GradeName'");
	header('location: http://www.nirmalwire.com/schedule.php');

?>