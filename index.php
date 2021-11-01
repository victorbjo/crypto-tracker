<html>
    <head>
        <title>Crypto portfolio</title>
        <link rel="stylesheet" href="static/main.css">
        <script src="scripts/currencies.js"></script>
        <script>
        function addToTracker(){
            alert(document.getElementById("embed").attributes[].value);    
        }
        </script>
    </head>

        <?php
            session_start();
            if (isset($_POST['sign_out'])){
                $_SESSION['user'] = null;
            }
            if (isset($_SESSION['user'])){
                echo "You are logged in as ".$_SESSION['user'];
                ?>
                <body onload="getCurrencies()">
                <form action="index.php" method="post">
                    <input type="submit" value="Sign out!" id="sign_out" name="sign_out"/>
                    </form>
                    <h2 onload="getCurrencies()">Hello <?php echo$_SESSION['user'];?></h2>
                    <input type="hidden" id="loggedin" value="true"/>
                <?php
            }
            else{
                echo '<body>';
                echo'<a href="/crypto-Tracker/login.php"> Log in </a></br>';
                echo'<a href="/crypto-Tracker/signup.php"> Create user </a></br>';
            }
            ?>
        <button onclick="addToTracker()">Heyo</button>
        <!--<embed id="embed" src="http://localhost/crypto-Tracker/addToTracker.php?coin=ethereum" 
               style="border:1px solid #111111;"/>!-->
        <div id="tickers" class="ticker-container">
            
        </div>
<div class="div-track-coin div-track-coin-invisible" id="div-track-coin">
    <form action="addToTracker.php" method="post">
        Coin : <p id="coinParagraph"></p></br>
        Quantity of coin:<input type="text" name="quantity" placeholder="Quantity, Eg. 0.62"/></br>
        Unit price:<input type="text" name="price" placeholder="Purchase price, Eg. 54153.84"/></br>
        <input type="hidden" name="coin" id="coin" value="bitcoin"/></br>
        <input type="submit" value="Add to portfolio" name="add_to_profile"/></br>
    </form>
</div>
    </body>
</html>


