<?php
include_once("backend/config.php");
session_start();
if(!isset($_SESSION["UserType"])){
   header("location:./login.php");
}
$action = 99;
if (isset($_GET['page_no']) && $_GET['page_no']!="") {
	$page_no = $_GET['page_no'];
} else {
	$page_no = 1;
}
    
$total_records_per_page = 20;
$offset = ($page_no-1) * $total_records_per_page;
$previous_page = $page_no - 1;
$next_page = $page_no + 1;
$adjacents = "2"; 
$query_1 = "SELECT COUNT(*) AS TOTAL_REC FROM Tbl_Data_Loading L 
            JOIN Tbl_Data_Schedule R
            ON L.NominalSize = R.NominalSize AND L.GradeName = R.GradeName
            WHERE R.Schedule = $action";
$result_count = sqlsrv_query($conn, $query_1);
$row_count = sqlsrv_fetch_array($result_count);
$total_records = $row_count['TOTAL_REC'];
$total_no_of_pages = ceil($total_records / $total_records_per_page);
$second_last = $total_no_of_pages - 1; // total page minus 1

$output = '';
if(isset($_POST["query"]))
{
	$search = sqlsrv_real_escape_string($connect, $_POST["query"]);
	$query = "SELECT L.ID, L.CoilID, format(L.ScanDate, 'dd/MM/yyyy') as OnlyDate, format(L.ScanDate, 'hh:mm:ss tt') as OnlyTime,
	L.FormerNo, L.NominalSize, L.GradeName, L.FormerWeight, L.Netweight, L.Grossweight, L.GI_No, A.ActionName
	FROM Tbl_Data_Loading L 
	JOIN Tbl_Data_Schedule R
	ON L.NominalSize = R.NominalSize AND L.GradeName = R.GradeName
	JOIN Tbl_Info_Action A
	ON R.Schedule = A.AtionID
	WHERE R.Schedule = $action AND L.Action=99 AND L.CoilID LIKE CONCAT('%','$search','%')
	ORDER BY L.ID OFFSET $offset ROWS FETCH NEXT $total_records_per_page ROWS ONLY";
}
else
{
	$query = "SELECT L.ID, L.CoilID, format(L.ScanDate, 'dd/MM/yyyy') as OnlyDate, format(L.ScanDate, 'hh:mm:ss tt') as OnlyTime,
            L.FormerNo, L.NominalSize, L.GradeName, L.FormerWeight, L.Netweight, L.Grossweight, L.GI_No, A.ActionName
            FROM Tbl_Data_Loading L 
            JOIN Tbl_Data_Schedule R
            ON L.NominalSize = R.NominalSize AND L.GradeName = R.GradeName
            JOIN Tbl_Info_Action A
            ON R.Schedule = A.AtionID
            WHERE R.Schedule = $action AND L.Action=99 ORDER BY L.ID OFFSET $offset ROWS FETCH NEXT $total_records_per_page ROWS ONLY";
}
$result = sqlsrv_query($conn, $query);
if(sqlsrv_num_rows($result) > 0)
{
	$output .="
				<thead>
					<tr>
						<th>SL NO</th>
						<th>DATE</th>
						<th>Time</th>
						<th>COIL ID</th>
						<th>FORMER NO</th>
						<th>GROSS WEIGHT</th>
						<th>TARE WEIGHT</th>
						<th>NET WEIGHT</th>
						<th>G.I. NO</th>
						<th>COIL SIZE</th>
						<th>GRADE</th>
						<th class="last">  </th>
					</tr>
				</thead>
				<tbody>";
			$i=1;
			while($row = sqlsrv_fetch_array($result)) {
			$output .="
				<tr id=".$row['ID'].">
					<td>".$i."</td>
					<td>".$row['OnlyDate']."</td>
					<td>".$row['OnlyTime']."</td>
					<td>".$row['CoilID']."</td>
					<td>".$row['FormerNo']."</td>
					<td>".$row['Grossweight']."</td>
					<td>".$row['FormerWeight']."</td>
					<td>".$row['Netweight']."</td>
					<td>".$row['GI_No']."</td>
					<td>".$row['NominalSize']."</td>
					<td>".$row['GradeName']."</td>
					<td>
						<span class="custom-checkbox">
							<input type="checkbox" class="user_checkbox" data-user-id=".$row['ID'].">
							<label for="checkbox2"></label>
						</span>
					</td>
				</tr>";
			$i++;
			}
		$output .="</tbody>"
		echo $output;
}
else
{
	echo 'Data Not Found';
}
?>