<html>
    <head>
        <title>My first PHP Website</title>
        <link rel="stylesheet" href="static/main.css">
    </head>
    <body>
        <h2>Create user</h2>
        <form action="index.php" method="post">
            Email: <input type="text" name="email" required="required" /> <br/>
            Username: <input type="text" name="username" required="required" /> <br/>
            Password: <input type="password" name="password" required="required" /> <br/>
           <input type="submit" value="Sign up!" id="sign_in"/>
        </form>
    </body>
</html>


<?php
session_start();
if (isset($_POST['sign_out'])){
    $_SESSION['user'] = null;
}else{
    echo "Did not sign out";
}
if (isset($_SESSION['user'])){
    echo "You are logged in as ".$_SESSION['user'];
    ?>
    <form action="index.php" method="post">
           <input type="submit" value="Sign out!" id="sign_out" name="sign_out"/>
           </form>
    <?php
}
else{
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $username_taken = false;
    $conn = mysqli_connect("localhost", "root","","cryptotracker") or die(mysql_error());
    $sql = "SELECT id, username, password FROM users";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
          if ($row["username"] == $username){
              echo "Username already taken";
              $username_taken = true;
              break;
          }
        }
      }
    if (!$username_taken){
        $sql = "INSERT INTO users (username, password)
        VALUES ('$username', '$password')";
        if ($conn->query($sql) === TRUE) {
            echo "User created succesfully!";
        }
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
}

?>