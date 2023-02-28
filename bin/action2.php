<?php
$action = 2;
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
    L.FormerNo, L.NominalSize, L.GradeName, L.FormerWeight, L.Netweight, L.Grossweight, L.Action, R.ActionName
	FROM Tbl_CoilInfo L
	LEFT JOIN Tbl_ActionInfo R
	ON L.Action = R.AtionID
	WHERE L.Action = $action ORDER BY L.ID OFFSET $offset ROWS FETCH NEXT $total_records_per_page ROWS ONLY";
    $result = sqlsrv_query($conn, $query);
?>