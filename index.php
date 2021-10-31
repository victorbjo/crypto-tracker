<html>
    <head>
        <title>Crypto portfolio</title>
    </head>
    <body>
        <?php
            session_start();
            if (isset($_POST['sign_out'])){
                $_SESSION['user'] = null;
            }
            else if (isset($_SESSION['user'])){
                echo "You are logged in as ".$_SESSION['user'];
                ?>
                <form action="index.php" method="post">
                    <input type="submit" value="Sign out!" id="sign_out" name="sign_out"/>
                    </form>
                <?php
            }
            else{
                ?>
                        <a href="/cryptoTracker/login.php"> Log in </a></br>
        <a href="/cryptoTracker/signup.php"> Create user </a></br>
        <?php
            }
            ?>
        <h2>Hello <?php echo$_SESSION['user'];?></h2>
    </body>
</html>


