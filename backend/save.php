<?php
include 'config.php';

//session_start();
//$user= $_SESSION['user_name'];

if(count($_POST)>0){
	if($_POST['type']==100){
		$id=$_POST['id'];
		$action=$_POST['action'];
		$query = "UPDATE Tbl_Data_Loading SET Action='$action' WHERE ID=$id";
		//$sql = "UPDATE Tbl_Data_Loading SET Action='$action', `task_created_by`= '$user', `task_create_date`=CURRENT_TIMESTAMP() WHERE id=$id";
		if (sqlsrv_query($conn, $query)) {
			echo json_encode(array("statusCode">=200));
		} 
		else {
			echo "Error: " . $query . "<br>" . sqlsrv_error($conn);
		}
		sqlsrv_close($conn);
	}
}
if(count($_POST)>0){
	if($_POST['type']==1){
		$id=$_POST['id'];
		$sql = "UPDATE Tbl_Data_Loading SET Action='1' WHERE ID in ($id)";
		if (sqlsrv_query($conn, $sql)) {
			echo json_encode(array("statusCode"=>200));
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		sqlsrv_close($conn);
	}
}
if(count($_POST)>0){
	if($_POST['type']==2){
		$id=$_POST['id'];
		$sql = "UPDATE Tbl_Data_Loading SET Action='2' WHERE ID in ($id)";
		if (sqlsrv_query($conn, $sql)) {
			echo json_encode(array("statusCode"=>200));
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		sqlsrv_close($conn);
	}
}
if(count($_POST)>0){
	if($_POST['type']==3){
		$id=$_POST['id'];
		$sql = "UPDATE Tbl_Data_Loading SET Action='3' WHERE ID in ($id)";
		if (sqlsrv_query($conn, $sql)) {
			echo json_encode(array("statusCode"=>200));
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		sqlsrv_close($conn);
	}
}
if(count($_POST)>0){
	if($_POST['type']==4){
		$id=$_POST['id'];
		$sql = "UPDATE Tbl_Data_Loading SET Action='4' WHERE ID in ($id)";
		if (sqlsrv_query($conn, $sql)) {
			echo json_encode(array("statusCode">=200));
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		sqlsrv_close($conn);
	}
}
if(count($_POST)>0){
	if($_POST['type']==5){
		$id=$_POST['id'];
		$sql = "UPDATE Tbl_Data_Loading SET Action='5' WHERE ID in ($id)";
		if (sqlsrv_query($conn, $sql)) {
			echo json_encode(array("statusCode"=>200));
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		sqlsrv_close($conn);
	}
}
if(count($_POST)>0){
	if($_POST['type']==6){
		$id=$_POST['id'];
		$sql = "UPDATE Tbl_Data_Loading SET Action='6' WHERE ID in ($id)";
		if (sqlsrv_query($conn, $sql)) {
			echo json_encode(array("statusCode"=>200));
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		sqlsrv_close($conn);
	}
}
if(count($_POST)>0){
	if($_POST['type']==7){
		$id=$_POST['id'];
		$sql = "UPDATE Tbl_Data_Loading SET Action='7' WHERE ID in ($id)";
		if (sqlsrv_query($conn, $sql)) {
			echo json_encode(array("statusCode"=>200));
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		sqlsrv_close($conn);
	}
}
if(count($_POST)>0){
	if($_POST['type']==8){
		$id=$_POST['id'];
		$sql = "UPDATE Tbl_Data_Loading SET Action='8' WHERE ID in ($id)";
		if (sqlsrv_query($conn, $sql)) {
			echo json_encode(array("statusCode"=>200));
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		sqlsrv_close($conn);
	}
}
if(count($_POST)>0){
	if($_POST['type']==9){
		$id=$_POST['id'];
		$sql = "UPDATE Tbl_Data_Loading SET Action='9' WHERE ID in ($id)";
		if (sqlsrv_query($conn, $sql)) {
			echo json_encode(array("statusCode"=>200));
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		sqlsrv_close($conn);
	}
}
if(count($_POST)>0){
	if($_POST['type']==10){
		$id=$_POST['id'];
		$sql = "UPDATE Tbl_Data_Loading SET Action='10' WHERE ID in ($id)";
		if (sqlsrv_query($conn, $sql)) {
			echo json_encode(array("statusCode"=>200));
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		sqlsrv_close($conn);
	}
}
?>