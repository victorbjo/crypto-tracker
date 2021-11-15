<?php
    session_start();
    $quantity = $_POST["quantity"];
    echo $quantity;
    $coin = $_POST["coin"];
    $username = $_SESSION['user'];
    $price = $_POST["price"];
    include("credentials.php");
    $conn = mysqli_connect($sqlhost, $sqlUsername, $sqlpassword, $sqldb) or die(mysql_error());
    $sql = "SELECT id FROM users WHERE username='$username'";
    $result = $conn->query($sql);
    $id = $result->fetch_assoc()['id'];
    $sql = "INSERT INTO crypto (crypto, price, purchase_date, amount, user_id)
    VALUES ('$coin', '$price', '2021/10/31', '$quantity', '$id')";
    if ($conn->query($sql) === TRUE) {
        echo "succes";
        $conn->close();
        exit(); 
    }
    else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
    exit();
?>