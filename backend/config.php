<?php

$uid = "sa";
$pwd = "sdepl";
$DB = "Vinar_Conveyor";
$serverName = "DESKTOP-C01Q83N\SQLEXPRESS";
$connectionInfo = array("UID" => $uid, "PWD" => $pwd, "Database"=> $DB, "ReturnDatesAsStrings" => true);
$conn = sqlsrv_connect( $serverName, $connectionInfo);

//if( $conn ) {
//     echo "Connection established.<br />";
//}else{

//     echo "Connection could not be established.<br />";
//     die( print_r( sqlsrv_errors(), true));
//}

?>



