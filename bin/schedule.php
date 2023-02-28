<?php
include("./pages/header.php"); 
include_once("backend/config.php");
session_start();
if(!isset($_SESSION["UserType"])){
   header("location:./login.php");
}

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
$query_1 = "SELECT COUNT(*) AS TOTAL_REC FROM Tbl_Schedule";
$result_count = sqlsrv_query($conn, $query_1);
$row_count = sqlsrv_fetch_array($result_count);
$total_records = $row_count['TOTAL_REC'];
$total_no_of_pages = ceil($total_records / $total_records_per_page);
$second_last = $total_no_of_pages - 1; // total page minus 1
$query = "SELECT L.ID, format(L.CreateDate, 'dd/MM/yyyy') as OnlyDate, format(L.CreateDate, 'hh:mm:ss tt') as OnlyTime,
L.NominalSize, L.GradeName, L.Total_Weight, L.Executed_Weight, L.Pending_Weight, L.Schedule,
R.ActionName, A.Ops_Name
FROM Tbl_Schedule L
JOIN Tbl_ActionInfo R
ON L.Schedule = R.AtionID
JOIN Tbl_OperationInfo A
ON L.Ops_Unload = A.Ops_id
ORDER BY L.ID OFFSET $offset ROWS FETCH NEXT $total_records_per_page ROWS ONLY";
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
    <a class="active" href="./schedule.php">Schedule</a>
    <a class='right'  href='./index.php'>Home</a>
</header>
<!-- Main -->
<div class="wrapper">
<div class="container">
	<p id="success"></p>
        <div class="table-wrapper">
            <div class="table-title">
				<h2>Schedule</h2>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
						<th>SL</th>
                        <th>DATE</th>
                        <th>GRADE</th>
						<th>COIL SIZE</th>
                        <th>UNLOADING OPERATION</th>
                        <th>ASSIGNED WEIGHT</th>
                        <th>EXECUTED WEIGHT</th>
                        <th>PENDING WEIGHT</th>
                        <th>SCHEDULE</th>
                        <th class="last"> </th>
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
                        <td><?php echo $row["GradeName"]; ?></td>
                        <td ><?php echo $row["NominalSize"]; ?></td>
                        <td><?php echo $row["Ops_Name"]; ?></td>
                        <td><?php echo $row["Total_Weight"]; ?></td>
                        <td><?php echo $row["Executed_Weight"]; ?></td>
                        <td><?php echo $row["Pending_Weight"]; ?></td>
                        <td><?php echo $row["ActionName"]; ?></td>
                        <td>
					        <a href="#editEmployeeModal" class="edit" data-toggle="modal">
					        	<i class="material-icons update" data-toggle="tooltip" 
					        	data-id=""
                                data-name= ""
                                data-email=""
                                data-phone=""
                                data-city= ""
					        	title="Edit">&#xE254;</i>
					        </a>
			        	</td>
			        </tr>
				<?php
				$i++;
				}
				?>
				
				</tbody>
			</table>
			
        </div>
    </div>
<!-- Edit Modal HTML -->
		<div id="editEmployeeModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="update_form">
                        <div class="modal-header">						
                            <h4 class="modal-title">Edit User</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="id_u" name="id" class="form-control" required>					
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" id="name_u" name="name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" id="email_u" name="email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>PHONE</label>
                                <input type="phone" id="phone_u" name="phone" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>City</label>
                                <input type="city" id="city_u" name="city" class="form-control" required>
                            </div>					
                        </div>
                        <div class="modal-footer">
                        <input type="hidden" value="2" name="type">
                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                            <button type="button" class="btn btn-info" id="update">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</div>
<?php include('footer.php');?>