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
            ?>
            <div class="table-container">
            <table>
                <tr>
                    <th>Currency</th>
                    <th>Current price</th>
                    <th>Current holdings(USD)</th>
                    <th>Current holdings(currency)</th>
                    <th>Avg purchasing price</th>
                    <th>Profit</th>
        </tr>
            <?php
            for ($i = 0; $i < count($combinedPurchasePrice); $i++){
                $avgPrice = $combinedPurchasePrice[$i]/$combinedAmount[$i];
                $totalValue = $avgPrice * $combinedAmount[$i];
                ?>
                                    <td id="currency<?php echo $i;?>"><?php echo $currenciesAnalyzed[$i];?></td>
                                    <td id="currentPrice<?php echo $i;?>"><?php echo $totalValue;?> $USD</td>
                                    <td id="currentHoldings<?php echo $i;?>"><?php echo $currenciesAnalyzed[$i];?></td>
                                    <td id="currentAmount<?php echo $i;?>"><?php echo $combinedAmount[$i]. " ".$currenciesAnalyzed[$i];?></td>
                                    <td id="avgPrice<?php echo $i;?>"><?php echo $avgPrice;?> $USD</td>
                                    <td id="profit<?php echo $i;?>"><?php echo $avgPrice;?></td>
                  </tr><?php
                
            }
            ?>
            </table>
        </div>
    </body>
</html>


