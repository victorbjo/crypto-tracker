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
                exit();
            }
            $currenciesAnalyzed = [];
            $combinedPurchasePrice = [];
            $combinedAmount = [];
            $user = $_SESSION["id"];
            $conn = mysqli_connect("localhost", "root","","cryptotracker") or die(mysql_error());
            $sql = "SELECT crypto, price, purchase_date, amount, id FROM crypto WHERE user_id = '$user'";
            $result = $conn->query($sql);
            if ($result){
                while($row = $result->fetch_assoc()) {
                    if (!in_array($row["crypto"], $currenciesAnalyzed)){
                        array_push($currenciesAnalyzed, $row["crypto"]);
                        array_push($combinedPurchasePrice, floatval($row["price"]*$row["amount"]));
                        array_push($combinedAmount, floatval($row["amount"]));
                    }
                    else{
                        $combinedAmount[array_search($row["crypto"], $currenciesAnalyzed)] += floatval($row["amount"]);
                        $combinedPurchasePrice[array_search($row["crypto"], $currenciesAnalyzed)] += $row["price"]*$row["amount"];
                        //echo array_search($row["crypto"], $currenciesAnalyzed);
                    }
                }
            }
            for ($i = 0; $i < count($combinedPurchasePrice); $i++){
                $avgPrice = $combinedPurchasePrice[$i]/$combinedAmount[$i];
                $totalValue = $avgPrice * $combinedAmount[$i];
                echo $currenciesAnalyzed[$i] . ". Avg purchase price: " . $avgPrice . "USD. Amount owned: " . $combinedAmount[$i] . ". Total value: ".$totalValue. "USD</br></br>";
                
            }
            ?>

    </body>
</html>


