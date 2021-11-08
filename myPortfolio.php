<html>
    <head>
        <title>Crypto portfolio</title>
        <link rel="stylesheet" href="static/main.css">
        <script>

        </script>
    </head>
<?php include("header.php"); ?>
    <body>
    <script src="scripts/explorer.js"></script>
        <?php
            if (isset($_POST['sign_out'])){
                $_SESSION['user'] = null;
            }
            if (!isset($_SESSION['user'])){
                exit();
            }
            $user = $_SESSION["id"];
            $conn = mysqli_connect("localhost", "root","","cryptotracker") or die(mysql_error());
            $sql = "SELECT crypto, price, purchase_date, amount, id FROM crypto WHERE user_id = '$user'";
            $result = $conn->query($sql);
            if ($result){
                while($row = $result->fetch_assoc()) {
                    ?>
                    <div class='crypto-portfolio-parent'>
                        <?php
                    $id = $row['id'];
                    $crypto = $row["crypto"];
                    echo "<div class='crypto-portfolio' id='".$crypto."'>";
                    echo $crypto;
                    echo " Purchase price: <p id='".$crypto."-priceOrig'>".$row["price"]."</p>";
                    echo "&nbsp&nbsp&nbspAmount bought:<p id='".$crypto."-amountOrig'>".$row["amount"]."</p>";
                    echo "<button onclick=".'"'."show_edit('".$crypto."')".'"'.">Edit purchase</button> ";
                    ?>
                    </div>
                    <div class='crypto-portfolio-hidden' id='<?php echo $crypto; ?>-hidden'> 
                        <input type="hidden" value="<?php echo $row['id']; ?>" id="<?php echo $crypto; ?>-id">
                        <p class="text-edit">Purchase price</p> 
                        <input type="text" class="input-edit" id="<?php echo $crypto; ?>-price" value="<?php echo $row['price']; ?>">
                        <p class="text-edit">Amount bought </p> 
                        <input type="text" class="input-edit" id="<?php echo $crypto; ?>-amount" value="<?php echo $row['amount']; ?>">
                        <button class="save-edit" onclick="updateEntry('<?php echo $crypto; ?>')">Save new details</button>
                        <button class="save-edit" onclick="updateEntry('<?php echo $crypto; ?>', true)">Delete</button>
                    </div>
                    </div>
                    <?php
                }
                
            }
            ?>
    </body>
</html>


