<!-- Delete -->
    <div class="modal" id="del<?php echo $row['ID']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
				<form method="POST" action="./backend/reset.php?id=<?php echo $drow['ID']; ?>">
            	    <div class="modal-header">
						<center><h4 class="modal-title" id="myModalLabel">Reset</h4></center>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            	    </div>
            	    <div class="modal-body">
						<?php
							$del=sqlsrv_query($conn,"select * from Tbl_Data_Schedule where ID='".$row['ID']."'");
							$drow=sqlsrv_fetch_array($del);
						?>
						<div class="container">
							<h5><center>Are you sure to reset <strong><?php echo ucwords($drow['GradeName'].' & '.$drow['NominalSize']); ?></strong> from the list? </br>This method cannot be undone.</center></h5> 
							<div class="form-group row">
    							<div style="top:-20px;" class="col-sm-12">
    							  <input  type="hidden" name="GradeName" class="form-control" value="<?php echo $drow['GradeName']; ?>">
    							</div>
  							</div>
							<div class="form-group row">
    							<div style="top:-20px;" class="col-sm-12">
    							  <input  type="hidden" name="NominalSize" class="form-control" value="<?php echo $drow['NominalSize']; ?>">
    							</div>
  							</div>
						</div> 
					</div>
            	    <div class="modal-footer">
						<button type="button" class="btn btn-info" data-bs-dismiss="modal">Close</button>
                    	<button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Reset</button>
            	    </div>
				</form>	
            </div>
        </div>
    </div>
<!-- /.modal -->

<!-- Edit -->
<div class="modal" id="edit<?php echo $row['ID']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
        <div class="modal-content">
			<form method="POST" action="./backend/edit.php?id=<?php echo $erow['ID']; ?>">
            	<div class="modal-header">
            	    <center><h4 class="modal-title" id="myModalLabel">Update Schedule</h4></center>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            	</div>
            	<div class="modal-body">
					<?php
						$edit=sqlsrv_query($conn,"select * from Tbl_Data_Schedule where ID='".$row['ID']."'");
						$erow=sqlsrv_fetch_array($edit);
					?>
					<div class="container">
						<div class="form-group row">
    						<label style="top:2px; left:-25px" class="col-sm-4 col-form-label">Grade Name:</label>
    						<input  type="text" name="GradeName" class="form-control" value="<?php echo $erow['GradeName']; ?>">
  						</div>
						<div class="form-group row">
    						<label style="top:2px; left:-25px" class="col-sm-4 col-form-label">Nominal Size:</label>
    						<input  type="text" name="NominalSize" class="form-control" value="<?php echo $erow['NominalSize']; ?>">
  						</div>
						<div class="form-group">
							<label style="top:2px; left:-40px" class="col-sm-4 col-form-label">Operation:</label>
    						<select style='width:45em;  margin-left:-10px' class="form-control" name="operation" id="operation">
    						  <option value="1">ALL</option>
    						  <option value="2">TONNAGE</option>
    						</select>
  						</div>
						<div class="form-group row">
    						<label style="top:2px; left:-25px" class="col-sm-4 col-form-label">Total Weight:</label>
    						<input type="text" name="Total_Weight" class="form-control" value="<?php echo $erow['Total_Weight']; ?>">
  						</div>
						<div class="form-group">
							<label style="top:2px; left:-50px" class="col-sm-4 col-form-label">Station:</label>
    						<select style='width:45em;  margin-left:-10px' type="text" class="form-control" name="schedule" id="schedule">
								<option value="1">CUTTING STATION 1</option>
                        	    <option value="2">CUTTING STATION 2</option>
                        	    <option value="3">CUTTING STATION 3</option>
                        	    <option value="4">CUTTING STATION 4</option>
                        	    <option value="5">SPOOLING</option>
                        	    <option value="6">JUMBO PACKING</option>
                        	    <option value="9">HOLD</option>
                        	    <option value="7">REJECT</option>
    						</select>
  						</div>
            		</div> 
				</div>
            	<div class="modal-footer">
					<button type="button" class="btn btn-info" data-bs-dismiss="modal">Close</button>
            	    <button type="submit" class="btn btn-warning"><span class="glyphicon glyphicon-check"></span> Save</button>
            	</div>
			</form>
        </div>
    </div>
</div>

	
<!-- /.modal -->
