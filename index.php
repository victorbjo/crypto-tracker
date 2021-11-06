<html>
    <head>
        <title>Crypto portfolio</title>
        <link rel="stylesheet" href="static/main.css">
        <script src="scripts/currencies.js"></script>
        <script>

        </script>
    </head>
<?php include("header.php"); ?>
    <body>
        <?php
            if (isset($_POST['sign_out'])){
                $_SESSION['user'] = null;
            }
            if (isset($_SESSION['user'])){
                ?>
                <form action="index.php" method="post">
                    <input type="submit" value="Sign out!" id="sign_out" name="sign_out"/>
                    </form>
                    <input type="hidden" id="loggedin" value="true"/>
                <?php
            }
            else{
                echo'<a href="/crypto-Tracker/login.php"> Log in </a></br>';
                echo'<a href="/crypto-Tracker/signup.php"> Create user </a></br>';
            }
            ?>
        <!--<embed id="embed" src="http://localhost/crypto-Tracker/addToTracker.php?coin=ethereum" 
               style="border:1px solid #111111;"/>!-->


    </body>
</html>


