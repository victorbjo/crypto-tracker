<html>
    <head>
        <title>Crypto portfolio</title>
        <link rel="stylesheet" href="static/main.css">
        <script src="scripts/currencies.js"></script>
        <script src="scripts/explorer.js"></script>
        <script>
        function addToTracker(){
            alert(document.getElementById("embed").attributes[].value);    
        }
        </script>
    </head>

        <?php 
        include("header.php");
            if (isset($_POST['sign_out'])){
                $_SESSION['user'] = null;
            }
            if (isset($_SESSION['user'])){
                ?>
                <body onload="getCurrencies(), setTimeout(checkCurrencies, 500);">
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
        <div class="main-explorer">
        <div id="tickers" class="ticker-container">
            
        </div>

        </div>
<div class="div-track-coin div-track-coin-invisible" id="div-track-coin">
        Coin : <span id="coinParagraph"></span></br>
        Quantity of coin:<input type="text" name="quantity" id="quantity" placeholder="Quantity, Eg. 0.62"/></br>
        Unit price:<input type="text" name="price" id="price" placeholder="Purchase price, Eg. 54153.84"/></br>
        <input type="hidden" name="coin" id="coin" value="bitcoin"/></br>
        <button class="button-add-to-portfolio" onclick="saveInput()">Add to portfolio</button>
</div>

    </body>
</html>


