<?php include("./pages/header.php"); ?>
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
    <div class="dropdown text-end end-right">
      <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
        <img src="./img/circle-user-solid.svg" alt="mdo" width="32" height="32" class="rounded-circle">
      </a>
      <ul class="dropdown-menu text-small">
        <li><a class="dropdown-item" href="#">New project...</a></li>
        <li><a class="dropdown-item" href="#">Settings</a></li>
        <li><a class="dropdown-item" href="#">Profile</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item" href="#">Sign out</a></li>
      </ul>
    </div>  
    <!-- Example single danger button -->
<div class="btn-group end-right dropdown">
  <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
    Action
  </button>
  <ul class="dropdown-menu">
    <li><a class="dropdown-item" href="#">Action</a></li>
    <li><a class="dropdown-item" href="#">Another action</a></li>
    <li><a class="dropdown-item" href="#">Something else here</a></li>
    <li><hr class="dropdown-divider"></li>
    <li><a class="dropdown-item" href="#">Separated link</a></li>
  </ul>
</div>  
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
            <table class="table table-striped table-hover" id="search_result">
                
				
			</table>
            <?php include('./pages/pagination.php');?>
        </div>
    </div>
</div>

<?php include('./pages/footer.php');?>



