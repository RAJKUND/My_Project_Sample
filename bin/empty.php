<?php
include("./pages/header.php"); 
include_once("backend/config.php");
session_start();
if(!isset($_SESSION["UserType"])){
   header("location:./login.php");
}
$action = 8;
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
$query_1 = "SELECT COUNT(*) AS TOTAL_REC FROM Tbl_CoilInfo WHERE Action=$action";
$result_count = sqlsrv_query($conn, $query_1);
$row_count = sqlsrv_fetch_array($result_count);
$total_records = $row_count['TOTAL_REC'];
$total_no_of_pages = ceil($total_records / $total_records_per_page);
$second_last = $total_no_of_pages - 1; // total page minus 1
$query = "SELECT L.ID, L.CoilID, format(L.ScanDate, 'dd/MM/yyyy') as OnlyDate, format(L.ScanDate, 'hh:mm:ss tt') as OnlyTime,
L.FormerNo, L.NominalSize, L.GradeName, L.FormerWeight, L.Netweight, L.Grossweight, L.Action, L.GI_No, R.ActionName
FROM Tbl_CoilInfo L
LEFT JOIN Tbl_ActionInfo R
ON L.Action = R.AtionID
WHERE L.Action = $action ORDER BY L.ID OFFSET $offset ROWS FETCH NEXT $total_records_per_page ROWS ONLY";
$result = sqlsrv_query($conn, $query);
?>
<!-- Navigation Header -->
<header  class="topnav" id="myTopnav">
    <a class="logo" href="#">
        <picture style="max-width: 200px;">
            <img width="150" height="80" src="./img/nirmal_logo.png">
        </picture>
    </a>
    <a class="left" href="#">NIRMAL GROUP</a> 
    <a class="menu-3-dot" href="javascript:void(0);" style="font-size:15px;" onclick="myFunction()">&#9776;</a>
    <a class="end-right" href="./logout.php">
        <picture style="max-width: 50px;">
            <img width="40" height="40" src="./img/circle-user-solid.svg">
        </picture></a>
    <a class="right" href="./alarm.php">Alarm</a>    
    <a class="right" href="#">Report</a>
    <a class="right" href="#">Secdule</a>
    <a class='active'  href='./index.php'>Home</a>
</header>
<!-- Main -->
<div class="wrapper">
    <div class="container">
	<p id="success"></p>
        <div class="table-wrapper">
            <div class="table-title">
                <div class="dropdown">
                <button class="dropbtn">EMPTY</button>
                    <div class="dropdown-content">
                        <a href="index.php">NO ACTION</a>
                        <a href="cutting_station_one.php">CUTTING STATION ONE</a>
                        <a href="cutting_station_two.php">CUTTING STATION TWO</a>
                        <a href="cutting_station_three.php">CUTTING STATION THREE</a>
                        <a href="cutting_station_four.php"> CUTTING STATION FOUR</a>
                        <a href="spooling_station.php"> SPOOLING STATION</a>
                        <a href="jumbo_packing.php"> JUMBO PACKING</a>
                        <a href="hold.php"> HOLD</a>
                        <a href="reject.php"> REJECT</a>
                        <a href="empty.php"> EMPTY</a>
                        <a href="error.php"> SPARE</a>
                    </div>
                </div>
                <div class="drop_down">
                    <button onclick="Drop_Function()" class="drop_btn">UpDate</button>
                    <div id="myDropdown" class="dropdown_content">
                      <a href="JavaScript:void(0);" id="CUTTING_STATION_1">CUTTING STATION ONE</a>
                      <a href="JavaScript:void(0);" id="CUTTING_STATION_2">CUTTING STATION TWO</a>
                      <a href="JavaScript:void(0);" id="CUTTING_STATION_3">CUTTING STATION THREE</a>
                      <a href="JavaScript:void(0);" id="CUTTING_STATION_4">CUTTING STATION FOUR</a>
                      <a href="JavaScript:void(0);" id="SPOOLING_STATION">SPOOLING STATION</a>
                      <a href="JavaScript:void(0);" id="JUMBO_PACKING">JUMBO PACKING</a>
                      <a href="JavaScript:void(0);" id="HOLD">HOLD</a>
                      <a href="JavaScript:void(0);" id="REJECT">REJECT</a>
                      <a href="JavaScript:void(0);" id="EMPTY">EMPTY</a>
                    </div>
                    <input type="text" placeholder="Search..">
                </div>
            </div>
            <table class="table table-striped table-hover">
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
                        <th>ACTION</th>
                        <th class="last">  </th>
                    </tr>
                </thead>
				<tbody>
                   
				<?php
					$i=1;
					while($row = sqlsrv_fetch_array($result)) {
				?>
                    <tr id="<?php echo $row["ID"]; ?>">
                        <td><?php echo $i; ?></td>
                        <td><?php echo $row["OnlyDate"]; ?></td>
                        <td><?php echo $row["OnlyTime"]; ?></td>
                        <td><?php echo $row["CoilID"]; ?></td>
                        <td><?php echo $row["FormerNo"]; ?></td>
                        <td><?php echo $row["Grossweight"]; ?></td>
                        <td><?php echo $row["FormerWeight"]; ?></td>
                        <td><?php echo $row["Netweight"]; ?></td>
                        <td><?php echo $row["GI_No"]; ?></td>
				    	<td><?php echo $row["NominalSize"]; ?></td>
				    	<td><?php echo $row["GradeName"]; ?></td>
				    	<td><?php echo $row["ActionName"]; ?></td>
                        <td>
				    		<span class="custom-checkbox">
				    			<input type="checkbox" class="user_checkbox" data-user-id="<?php echo $row["ID"]; ?>">
				    			<label for="checkbox2"></label>
				    		</span>
				        </td>
			        </tr>
				<?php
				$i++;
				}
				?>
				</tbody>
			</table>
            <?php include('./pages/pagination.php');?>
        </div>
    </div>
</div>

<?php include('./pages/footer.php');?>
