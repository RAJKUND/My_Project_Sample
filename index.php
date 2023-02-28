<?php
include("./pages/header.php"); 
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
$query = "SELECT L.ID, L.CoilID, format(L.ScanDate, 'dd/MM/yyyy') as OnlyDate, format(L.ScanDate, 'hh:mm:ss tt') as OnlyTime,
            L.FormerNo, L.NominalSize, L.GradeName, L.FormerWeight, L.Netweight, L.Grossweight, L.GI_No, A.ActionName
            FROM Tbl_Data_Loading L 
            JOIN Tbl_Data_Schedule R
            ON L.NominalSize = R.NominalSize AND L.GradeName = R.GradeName
            JOIN Tbl_Info_Action A
            ON R.Schedule = A.AtionID
            WHERE R.Schedule = $action AND L.Action=99 ORDER BY L.ID OFFSET $offset ROWS FETCH NEXT $total_records_per_page ROWS ONLY";
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
    <a class="right" href="./schedule.php">Schedule</a>
    <a class='active'  href='./index.php'>Home</a>
</header>
<!-- Main -->
<div class="wrapper">
    <div class="container-fluid">
	<p id="success"></p>
        <div class="table-wrapper">
            <div class="table-title">
                <div class="tbl-top">
                    <a href="/index.php" class="open"> UNASSIGNED </a>
                    <form name="theform_1" method="POST" action="/loading.php">
                        <input type="hidden" name="action" value="1">
                        <a href="javascript:document.theform_1.submit()">CUTTING STATION 1</a>
                    </form>
                    <form name="theform_2" method="POST" action="/loading.php">
                        <input type="hidden" name="action" value="2">
                        <a href="javascript:document.theform_2.submit()">CUTTING STATION 2</a>
                    </form>
                    <form name="theform_3" method="POST" action="/loading.php">
                        <input type="hidden" name="action" value="3">
                        <a href="javascript:document.theform_3.submit()">CUTTING STATION 3</a>
                    </form>
                    <form name="theform_4" method="POST" action="/loading.php">
                        <input type="hidden" name="action" value="4">
                        <a href="javascript:document.theform_4.submit()">CUTTING STATION 4</a>
                    </form>
                    <form name="theform_5" method="POST" action="/loading.php">
                        <input type="hidden" name="action" value="5">
                        <a href="javascript:document.theform_5.submit()">SPOOLING</a>
                    </form>
                    <form name="theform_6" method="POST" action="/loading.php">
                        <input type="hidden" name="action" value="9">
                        <a href="javascript:document.theform_6.submit()">HOLD</a>
                    </form>
                    <form name="theform_7" method="POST" action="/loading.php">
                        <input type="hidden" name="action" value="7">
                        <a href="javascript:document.theform_7.submit()">REJECT</a>
                    </form>
                </div>
                <div class="drop_down">
                    <button onclick="Drop_Function()" class="drop_btn">Update</button>
                    <div id="myDropdown" class="dropdown_content">
                      <a href="JavaScript:void(0);" id="CUTTING_STATION_1">CUTTING STATION - 1</a>
                      <a href="JavaScript:void(0);" id="CUTTING_STATION_2">CUTTING STATION - 2</a>
                      <a href="JavaScript:void(0);" id="CUTTING_STATION_3">CUTTING STATION - 3</a>
                      <a href="JavaScript:void(0);" id="CUTTING_STATION_4">CUTTING STATION - 4</a>
                      <a href="JavaScript:void(0);" id="SPOOLING_STATION">SPOOLING STATION</a>
                      <a href="JavaScript:void(0);" id="JUMBO_PACKING">JUMBO PACKING</a>
                      <a href="JavaScript:void(0);" id="HOLD">HOLD</a>
                      <a href="JavaScript:void(0);" id="REJECT">REJECT</a>
                      <a href="JavaScript:void(0);" id="EMPTY">EMPTY</a>
                    </div>
                    <input type="text" placeholder="Search.." id="search_text">
                </div>
            </div>
            <table class="table table-striped table-hover" id="Search_Result">
                <thead>
                    <tr>
                        <th>SL NO</th>
                        <th>DATE</th>
                        <th>Time</th>
                        <th>COIL ID</th>
                        <th>FORMER NO</th>
                        <th>GROSS WT</th>
                        <th>TARE WT</th>
                        <th>NET WT</th>
                        <th>G.I. NO</th>
						<th>COIL SIZE</th>
                        <th>GRADE</th>
                        <th class="last"> 
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                        <path d="M384 32C419.3 32 448 60.65 448 96V416C448 451.3 419.3 480 384 480H64C28.65 480 0 451.3 0 416V96C0 60.65 28.65 32 64 32H384zM384 80H64C55.16 80 48 87.16 48 96V416C48 424.8 55.16 432 64 432H384C392.8 432 400 424.8 400 416V96C400 87.16 392.8 80 384 80z"/></svg>
                        </th>
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
                    <td>
						<span class="custom-checkbox">
							<input type="checkbox" class="user_checkbox" data-user-id="<?php echo $row["ID"]; ?>">
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



