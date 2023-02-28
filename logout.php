<?php
session_start();
unset($_SESSION["id"]);
unset($_SESSION["Users"]);
unset($_SESSION["UserType"]);
header("Location:login.php");
?>