<!DOCTYPE html>
<html>
<head>
	<title>Schedule</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
	<div style="height:50px;"></div>
	<div class="well" style="margin:auto; padding:auto; width:80%;">
	<span style="font-size:25px; color:blue"><center><strong>Schedule</strong></center></span>	
		<span class="pull-left"><a href="#addnew" data-toggle="modal" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Add New</a></span>
		<div style="height:50px;"></div>
		<table class="table table-striped table-bordered table-hover">
			<thead>
				<th>SL NO</th>
				<th>GRADE</th>
				<th>COIL SIZE</th>
				<th>ACTION</th>
			</thead>
			<tbody>
			<?php
				include('conn.php');
				$query=	"SELECT TOP (20) L.ID, format(L.CreateDate, 'dd/MM/yyyy') as OnlyDate, L.NominalSize, L.GradeName, L.Action, R.ActionName
				FROM Tbl_Schedule L
				LEFT JOIN Tbl_ActionInfo R
				ON L.Action = R.AtionID
				ORDER BY L.ID DESC";
				$result=sqlsrv_query($conn, $query);
				while($row=sqlsrv_fetch_array($result)){
					?>
					<tr id="<?php echo $row["ID"]; ?>">
                    <td><?php echo $i; ?></td>
                    <td><?php echo $row["OnlyDate"]; ?></td>
					<td><?php echo $row["NominalSize"]; ?></td>
					<td><?php echo $row["GradeName"]; ?></td>
					<td><?php echo $row["ActionName"]; ?></td>
							<a href="#edit<?php echo $row['ID']; ?>" data-toggle="modal" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span> Edit</a> || 
							<a href="#del<?php echo $row['ID']; ?>" data-toggle="modal" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Delete</a>
							<?php include('button.php'); ?>
						</td>
					</tr>
					<?php
				}
			
			?>
			</tbody>
		</table>
	</div>
	<?php include('add_modal.php'); ?>
</div>
</body>
</html>