<?php
 
//MySQLi Procedural
$uid = "sa";
$pwd = "sdepl";
$DB = "Vinar_Conveyor";
$serverName = "DESKTOP-C01Q83N\SQLEXPRESS";
$connectionInfo = array("UID" => $uid, "PWD" => $pwd, "Database"=> $DB, "ReturnDatesAsStrings" => true);
$conn = sqlsrv_connect( $serverName, $connectionInfo);
 
?>