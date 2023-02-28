
<script src="https://code.jquery.com/jquery-2.1.1.min.js"
    type="text/javascript"></script>
<style>

.message-box {
    margin-bottom: 10px;
    border-top: #F0F0F0 2px solid;
    padding: 5px;
    background: #F4F1F1;
    border: #E4E4E5 1px solid;
    border-radius: 5px;
}

.comment-form-container {
    border: #0a0808 1px solid;
    padding: 10px 20px;
    border-radius: 4px;
}

.message-content {
    margin-top: 5px;
}

.message-content a{
    text-decoration: none;
    font-weight: bolder;
    color: #000;
}
.message-content a:hover{
    text-decoration: none;
    font-weight: bolder;
    color: #000;
}

.txtMessage {
    width: 100%;
    margin: 10px 0px;
}
</style>


<?php
include("./pages/header.php"); 
include_once("backend/config.php");
$query = "SELECT L.ID, format(L.Date, 'dd/MM/yyyy') as OnlyDate, format(L.Date, 'hh:mm:ss tt') as OnlyTime, L.AlarmID, R.AlarmText
FROM Tbl_Data_Alarm L
LEFT JOIN Tbl_Info_Alarm R
ON L.AlarmID = R.AlarmRef_ID
WHERE (format(L.Date, 'dd/MM/yyyy')) =(SELECT FORMAT(GETDATE(),  'dd/MM/yyyy'))";
$result = sqlsrv_query($conn, $query);
session_start();
if(!isset($_SESSION["UserType"])){
   header("location:./login.php");
}
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
        </picture>
    </a>
    <a class="active" href="#">Alarm</a> 
    <a class="right" href="#">Status</a>
    <a class="right" href="./viewtask.php">View Task</a>
    <a class='right' href='./index.php'>Assign Task</a>
</header>
<!-- Main -->
<div class="wrapper">
<div class="container">
<div class="table-wrapper">
    <div class="form_style">
        <div id="comment-list-box">
        <?php
			$i=1;
			while($row = sqlsrv_fetch_array($result)) {
		?>
            <div class="message-box" id="message_<?php echo $row["ID"];?>">
                <div class="message-content"> <a><b>Date:</b></a>  <?php echo $row["OnlyDate"];?> <a><b>Time:</b></a> <?php echo $row["OnlyTime"];?> <a><b>Text:</b></a>  <?php echo $row["AlarmText"]; ?></div>
            </div>
        <?php
           $i++;
           }
        ?>
        </div>
    </div>
</div>
</div>
</div>
<?php include('./pages/footer.php');?>    
</body>
</html>