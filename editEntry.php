<?php
    session_start();
    $quantity = $_POST["quantity"];
    $id = $_POST["id"];
    $price = $_POST["price"];
    $username = $_SESSION['user'];
    include("credentials.php");
    $conn = mysqli_connect($sqlhost, $sqlUsername, $sqlpassword, $sqldb) or die(mysql_error());
    if (isset($_POST["delete"])){
        $sql = "DELETE FROM crypto WHERE id='$id'";
    }
    else{
        $sql = "UPDATE crypto SET price = '$price', amount = '$quantity' WHERE id='$id'";
    }
    if ($conn->query($sql) === TRUE) {
        echo "success";
        exit(); 
    }
    else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    exit();


?>