<html>
<head>
<title>Log in</title>
<link rel="stylesheet" href="static/main.css">
</head>
<body>
<?php include("header.php"); ?>
<form action="login.php" method="post">
            Username: <input type="text" name="username" required="required" /> <br/>
            Password: <input type="password" name="password" required="required" /> <br/>
           <input type="submit" value="Log in!"/>
</form>
</body>

</html>
<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $failure_msg = "No user with that username/password";
    $username_taken = true;
    include("credentials.php");
    $conn = mysqli_connect($sqlhost, $sqlUsername, $sqlpassword, $sqldb) or die(mysql_error());
    $sql = "SELECT password, id FROM users WHERE username = '$username'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
          if (password_verify($password, $row["password"])){
            $_SESSION['user'] = $username;
            $_SESSION['id'] = $row["id"];
            $conn->close();
            header("Location: http://localhost/crypto-Tracker/index.php");
            exit(); 
          }
          else{
            $conn->close();
            echo $failure_msg;
          }
        }
      }
      else{
        $conn->close();
          echo $failure_msg;
      }
}

?>