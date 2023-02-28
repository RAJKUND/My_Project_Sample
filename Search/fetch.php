<?php
include("backend/config.php");
$output = '';
if(isset($_POST["query"]))
{
	$search = $_POST["query"];
	$stmt=$conn->prepare("SELECT L.ID, L.CoilID, format(L.ScanDate, 'dd/MM/yyyy') as OnlyDate, format(L.ScanDate, 'hh:mm:ss tt') as OnlyTime,
	L.FormerNo, L.NominalSize, L.GradeName, L.FormerWeight, L.Netweight, L.Grossweight, L.GI_No, A.ActionName
	FROM Tbl_Data_Loading L 
	JOIN Tbl_Data_Schedule R
	ON L.NominalSize = R.NominalSize AND L.GradeName = R.GradeName
	JOIN Tbl_Info_Action A
	ON R.Schedule = A.AtionID
	WHERE R.Schedule = $action AND L.Action=99 AND L.CoilID LIKE CONCAT('%','?','%') OR L.GradeName LIKE CONCAT('%','?','%')
	ORDER BY L.ID OFFSET $offset ROWS FETCH NEXT $total_records_per_page ROWS ONLY");
	$stmt->bind_param("ss",$search,$search);
}
else
{
	$stmt=$conn->prepare("SELECT L.ID, L.CoilID, format(L.ScanDate, 'dd/MM/yyyy') as OnlyDate, format(L.ScanDate, 'hh:mm:ss tt') as OnlyTime,
	L.FormerNo, L.NominalSize, L.GradeName, L.FormerWeight, L.Netweight, L.Grossweight, L.GI_No, A.ActionName
	FROM Tbl_Data_Loading L 
	JOIN Tbl_Data_Schedule R
	ON L.NominalSize = R.NominalSize AND L.GradeName = R.GradeName
	JOIN Tbl_Info_Action A
	ON R.Schedule = A.AtionID
	WHERE R.Schedule = $action AND L.Action=99
	ORDER BY L.ID OFFSET $offset ROWS FETCH NEXT $total_records_per_page ROWS ONLY");
	
}
$stmt->execute();
$result=$stmt->get_result();

if($result->num_rows>0){
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
			while($row=$result->fetch_assoc()) {
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