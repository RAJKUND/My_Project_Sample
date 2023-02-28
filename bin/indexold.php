<?php
include("./pages/header.php"); 
include_once("backend/config.php");

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
	$query_1 = "SELECT COUNT(*) AS TOTAL_REC FROM Tbl_CoilInfo WHERE Action=0";
	$result_count = sqlsrv_query($conn, $query_1);
	$row_count = sqlsrv_fetch_array($result_count);
	$total_records = $row_count['TOTAL_REC'];
    $total_no_of_pages = ceil($total_records / $total_records_per_page);
	$second_last = $total_no_of_pages - 1; // total page minus 1
	$query = "SELECT L.ID, L.CoilID, format(L.ScanDate, 'dd/MM/yyyy') as OnlyDate, format(L.ScanDate, 'hh:mm:ss tt') as OnlyTime,
    L.FormerNo, L.NominalSize, L.GradeName, L.FormerWeight, L.Netweight, L.Grossweight, L.Action, R.ActionName
	FROM Tbl_CoilInfo L
	LEFT JOIN Tbl_ActionInfo R
	ON L.Action = R.AtionID
	WHERE L.Action =0 ORDER BY L.ID OFFSET $offset ROWS FETCH NEXT $total_records_per_page ROWS ONLY";
    $result = sqlsrv_query($conn, $query);
session_start();
if(!isset($_SESSION["UserType"])){
   header("location:./login.php");
}
?>
<!-- Navigation Header START -->
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
            </picture>
        </a>
        <a class="right" href="./alarm.php">Alarm</a> 
        <a class="right" href="#">Status</a>
        <a class="right" href="./viewtask.php">View Task</a>
        <a class='active' href='./index.php'>Assign Task</a>
    </header>
<!-- Navigation Header END -->
<!-- Main -->
<div class="wrapper">
    <div class="container"><p id="success"></p>
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
						<h2><b>Assign Task</b></h2>
					</div>
                    <div class="dropdown">
                        <button class="dropbtn">Edit</button>
                        <div class="dropdown-content">
                            <a href="JavaScript:void(0);" id="CUTTING_STATION_1">CUTTING STATION ONE</a>
                            <a href="JavaScript:void(0);" id="CUTTING_STATION_2">CUTTING STATION TWO</a>
                            <a href="JavaScript:void(0);" id="CUTTING_STATION_3">CUTTING STATION THREE</a>
                            <a href="JavaScript:void(0);" id="CUTTING_STATION_4">CUTTING STATION FOUR</a>
                            <a href="JavaScript:void(0);" id="SPOOLING_STATION">SPOOLING STATION</a>
                            <a href="JavaScript:void(0);" id="JUMBO_PACKING">JUMBO PACKING</a>
                            <a href="JavaScript:void(0);" id="HOLD">HOLD</a>
                            <a href="JavaScript:void(0);" id="REJECT">REJECT</a>
                            <a href="JavaScript:void(0);" id="EMPTY">EMPTY</a>
                            <a href="JavaScript:void(0);" id="SPARE">SPARE</a>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th></th>
                        <th>SL NO</th>
                        <th>DATE</th>
                        <th>Time</th>
                        <th>COIL ID</th>
                        <th>FORMER NO</th>
                        <th>GROSS WEIGHT</th>
                        <th>TARE WEIGHT</th>
                        <th>NET WEIGHT</th>
						<th>COIL SIZE</th>
                        <th>GRADE</th>
                        <th>ACTION</th>
                        <th class="last">  </th>
                    </tr>
                </thead>
				<tbody>
				    <?php $i=1; while($row = sqlsrv_fetch_array($result)) { ?>
                    <tr id="<?php echo $row["ID"]; ?>">
                        <td>
							<span class="custom-checkbox">
								<input type="checkbox" class="user_checkbox" data-user-id="<?php echo $row["ID"]; ?>">
								<label for="checkbox2"></label>
							</span>
				    	</td>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $row["OnlyDate"]; ?></td>
                        <td><?php echo $row["OnlyTime"]; ?></td>
                        <td><?php echo $row["CoilID"]; ?></td>
                        <td><?php echo $row["FormerNo"]; ?></td>
                        <td><?php echo $row["Grossweight"]; ?></td>
                        <td><?php echo $row["FormerWeight"]; ?></td>
                        <td><?php echo $row["Netweight"]; ?></td>
				    	<td><?php echo $row["NominalSize"]; ?></td>
				    	<td><?php echo $row["GradeName"]; ?></td>
				    	<td><?php echo $row["ActionName"]; ?></td>
				        <td class="last">
				    	    <a href="#editEmployeeModal" class="edit" data-toggle="modal">
				    	    	<i class="material-icons update" data-toggle="tooltip" 
				    	    	data-id="<?php echo $row["ID"]; ?>"
                                data-coilid="<?php echo $row["CoilID"]; ?>"
                                data-action= "<?php echo $row["Action"]; ?>"
				    	    	title="Edit">&#xE254;</i>
				    	    </a>
				        </td>
			        </tr>
				    <?php $i++; } ?>
				</tbody>
			</table>
            <?php include('./pages/pagination.php');?>
        </div>
    </div>
</div>
<!-- Edit Modal HTML START-->
		<div id="editEmployeeModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="update_form">
                        <div class="modal-header">						
                            <h4 class="modal-title">Assign Task</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                                <input type="hidden" id="id_u" name="id" class="form-control" required>				
                            <div class="form-group">
                                <label></label>
                                <input type="hidden" id="coilid_u" name="coilid" class="form-control" required>
                                <label><b>ACTION</b></label>
                                       <select type="action" id="action_u" name="action" class="form-control" required >
                                            <option value="1">CUTTING STATION ONE</option>
                                            <option value="2">CUTTING STATION TWO</option>
                                            <option value="3">CUTTING STATION THREE</option>
                                            <option value="4">CUTTING STATION FOUR</option>
                                            <option value="5">SPOOLING STATION</option>
                                            <option value="6">JUMBO PACKING</option>
                                            <option value="9">HOLD</option>
                                            <option value="7">REJECT</option>
                                            <option value="8">EMPTY</option>
                                            <option value="10">SPARE</option>
                                        </select>
                            </div>					
                        </div>
                        <div class="modal-footer">
                        <input type="hidden" value="100" name="type">
                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                            <button type="button" class="btn btn-info" id="update">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
<!-- Edit Modal HTML END-->   
<?php include('./pages/footer.php');?>


