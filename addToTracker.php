<html>
    <body>
        <?php $coin = "doge";// $_GET["coin"];?>
        <form action="addToTracker.php?coin=<?php echo $coin?>" method="post">
            Coin : <?php echo $coin;?> </br>
            Quantity of coin:<input type="text" name="quantity" placeholder="Quantity, Eg. 0.62"/></br>
            Unit price:<input type="text" name="price" placeholder="Purchase price, Eg. 54153.84"/></br>
            <input type="hidden" name="coin" id="coin" value="bitcoin"/></br>
            <input type="submit" value="Add to portfolio" name="add_to_profile"/></br>
        </form>
        <?php
        if (isset($_POST['add_to_profile'])){ 
            session_start();
            $quantity = $_POST["quantity"];
            $coin = $_POST["coin"];
            $username = $_SESSION['user'];
            
            $price = $_POST["price"];
            include("credentials.php");
            $conn = mysqli_connect($sqlhost, $sqlUsername, $sqlpassword, $sqldb) or die(mysql_error());
            $sql = "SELECT id FROM users WHERE username='$username'";
            $result = $conn->query($sql);
            $id = $result->fetch_assoc()['id'];
            $sql = "INSERT INTO crypto (crypto, price, purchase_date, amount, user_id)
            VALUES ('$coin', '$price', '2021/10/31', '$quantity', '$id')";
            if ($conn->query($sql) === TRUE) {
                header("Location: http://localhost/crypto-Tracker/index.php");
                exit(); 
                ?>
                <script src="scripts/currencies.js"></script>
        <script>
            add();
            </script>
                <?php
            }
            else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            exit();
        }
        ?>
    </body>
    </html>