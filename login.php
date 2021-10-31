<html>
<head>
<title>Log in</title>
</head>
<body>
<form action="login.php" method="post">
            Username: <input type="text" name="username" required="required" /> <br/>
            Password: <input type="password" name="password" required="required" /> <br/>
           <input type="submit" value="Log in!"/>
</body>

</html>
<?php
session_start(); 
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $failure_msg = "No user with that username/password";
    $username_taken = true;
    $conn = mysqli_connect("localhost", "root","","cryptotracker") or die(mysql_error());
    $sql = "SELECT password FROM users WHERE username = '$username'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
          if (password_verify($password, $row["password"])){
            $_SESSION['user'] = $username;
            header("Location: http://localhost/cryptoTracker/index.php");
            exit(); 
          }
          else{
            echo $failure_msg;
          }
        }
      }
      else{
          echo $failure_msg;
      }
}

?>