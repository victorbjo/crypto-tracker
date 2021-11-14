<?php 
session_start();
$_SESSION["user"] = null;
header("Location: http://localhost/crypto-Tracker/index.php");
?>