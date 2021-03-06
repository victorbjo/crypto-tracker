<?php include("header.php"); ?>
<html>
    <head>
        <title>Crypto portfolio</title>
        <link rel="stylesheet" href="static/main.css">
        <script src="scripts/currencies.js"></script>
        <script>

        </script>
    </head>
    <body onload="updateTracker()">
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
                ?>
                <div class="table-container">
                    <h1 class="h1-margin">Welcome to Crypto Tracker V0.1</h1>
                    <p class="h1-margin">Please feel free to play around with it! In advance, sorry about ugly UI. Will be fixed as soon as I get some feedback from someone who is not me :)
                    </br>
                    A test user is made with username "AwesomeGuest", and password "test123". Please feel free to add and or delete crypto entries to test user :)
                    </p>
                </div>
                <?php
                exit();
            }
            $currenciesAnalyzed = [];
            $combinedPurchasePrice = [];
            $combinedAmount = [];
            $user = $_SESSION["id"];
            include("credentials.php");
            $conn = mysqli_connect($sqlhost, $sqlUsername, $sqlpassword, $sqldb) or die(mysql_error());
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
            $conn->close();
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
                ?>                  <tr>
                                    <td id="currency<?php echo $currenciesAnalyzed[$i];?>"><?php echo $currenciesAnalyzed[$i];?></td>
                                    <td id="<?php echo $currenciesAnalyzed[$i];?>" class="currentPrice"><?php echo $totalValue;?> $USD</td>
                                    <td id="currentHoldings<?php echo $currenciesAnalyzed[$i];?>" class="currentHoldings"><?php echo $currenciesAnalyzed[$i];?></td>
                                    <td id="<?php echo $combinedAmount[$i];?>" class="currentAmount"><?php echo $combinedAmount[$i]. " ".$currenciesAnalyzed[$i];?></td>
                                    <td id="avgPrice<?php echo $currenciesAnalyzed[$i];?>"class="avgPrice"><?php echo $avgPrice;?> 
                                        $USD <a href="myportfolio.php?coin=<?php echo$currenciesAnalyzed[$i]?>"> <img src="static/info.png" style="height:1.2rem;"></a> </td>
                                    <td id="profit<?php echo $currenciesAnalyzed[$i];?>"class="profit"><?php echo $avgPrice;?></td>

                  </tr><?php
                
            }
            ?>
            </table>
        </div>
    </body>
</html>


