<?php
    session_start();
    $user_name=$_POST['user_name'];
    $password=$_POST['password'];
    $message="";

    if(count($_POST)>0) {
        $uid = "sa";
        $pwd = "sdepl";
        $DB = "Vinar_Conveyor";
        $serverName = "DESKTOP-C01Q83N\SQLEXPRESS";
        $connectionInfo = array("UID" => $uid, "PWD" => $pwd, "Database"=> $DB, "ReturnDatesAsStrings" => true);
        $conn = sqlsrv_connect( $serverName, $connectionInfo);
        $query = "SELECT * FROM Tbl_UserData WHERE UserName='$user_name' AND Password= '$password'";
        $result = sqlsrv_query($conn, $query);
        $row  = sqlsrv_fetch_array($result);
        if(is_array($row)) {
        $_SESSION["id"] = $row['id'];
        $_SESSION["Users"] = $row['UserName'];
        $_SESSION["UserType"] = $row['UserTypeID'];
        header("Location:http:index.php");
        } else {
         $message = "Invalid Username or Password!";
        }
    } else {$message = "";}  
?>
<!DOCTYPE html>
<html lang="en">
<!--HEAD-->
<head>
	<title>Nirmal Wire</title>
  <link rel="icon" href="./img/nirmal_logo.png">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./login/css/all.css">
	<link rel="stylesheet" type="text/css" href="./login/css/main.css">
</head>

<!--BODY-->
<body>
<div class="wrapper">
  <div class="title">
    <p class="logo" href="#">
    <picture style="max-width: 200px;">
        <img width="150" height="100" src="./login/img/nirmal_logo.png">
    </picture>
    </p>
  </div>
  <form  name="frmUser" method="post" action="">
 
    <div class="field">
      <input type="text" name="user_name" required>
      <label>User Id</label>
    </div>
    <div class="field">
      <input type="password"  name="password" required>
      <label>Password</label>
    </div>
    <div class="pass-link"><a href="#">Forgot Password?</a></div>
    <div class="message"><p><?php if($message!="") { echo $message; } ?></p></div>
    <div class="button">
      <input type="submit"  name="submit" value="LOG IN">
    </div>
    <div class="Or"><p>OR</p></div>
		<div class="R_icon">
    <a href="#"><img class="img2" src="./login/img/icons8-facebook-96.png"></a>
    <a href="#"><img class="img3" src="./login/img/google-plus.png"></a>
    <a href="#"><img class="img2" src="./login/img/icons8-twitter-circled-96.png"></a>
  </div>
  </form>
</div>

</body>
</html>
