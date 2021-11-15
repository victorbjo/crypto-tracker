<?php 
session_start();
$_SESSION["user"] = null;
include("credentials.php");
header("Location: ".$url."/index.php");
?>