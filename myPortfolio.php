<html>
    <head>
        <title>Crypto portfolio</title>
        <link rel="stylesheet" href="static/main.css">
        <script>

        </script>
    </head>
<?php 
if (!isset($_GET["focus"])){
include("header.php"); 
}else{
    session_start();
}
?>
    <body style="overflow:hidden;">
    <script src="scripts/explorer.js"></script>
    <div class="">
        <?php
            if (isset($_POST['sign_out'])){
                $_SESSION['user'] = null;
            }
            if (!isset($_SESSION['user'])){
                exit();
            }
            $user = $_SESSION["id"];
            $conn = mysqli_connect("localhost", "root","","cryptotracker") or die(mysql_error());
            if (isset($_GET["coin"])){
                $coin = $_GET["coin"];
                echo "<h1 class='h1-margin' > Your ".$_GET["coin"]." entries in detail</h1>";
                $sql = "SELECT crypto, price, purchase_date, amount, id FROM crypto WHERE user_id = '$user' AND crypto = '$coin'";
                }
                else{
            $sql = "SELECT crypto, price, purchase_date, amount, id FROM crypto WHERE user_id = '$user'";
                }
            $result = $conn->query($sql);
            if ($result){
                while($row = $result->fetch_assoc()) {
                    ?>
                    
                    <div class='crypto-portfolio-parent'>
                        <?php
                    $id = $row['id'];
                    $crypto = $row["crypto"];
                    echo "<div class='crypto-portfolio' id='".$id."'>";
                    echo $crypto;
                    echo " Purchase price: <p id='".$id."-priceOrig'>".$row["price"]."</p>";
                    echo "&nbsp&nbsp&nbspAmount bought:<p id='".$id."-amountOrig'>".$row["amount"]."</p>";?>
                    <button onclick="show_edit('<?php echo $id; ?>')">Edit purchase</button>
                    
                    </div>
                    <div class='crypto-portfolio-hidden' id='<?php echo $id; ?>-hidden'> 
                        <input type="hidden" value="<?php echo $id; ?>" id="<?php echo $id; ?>-id">
                        <p class="text-edit">Purchase price</p> 
                        <input type="text" class="input-edit" id="<?php echo $id; ?>-price" value="<?php echo $row['price']; ?>">
                        <p class="text-edit">Amount bought </p> 
                        <input type="text" class="input-edit" id="<?php echo $id; ?>-amount" value="<?php echo $row['amount']; ?>">
                        <button class="save-edit" onclick="updateEntry('<?php echo $id; ?>')">Save new details</button>
                        <button class="save-edit" onclick="updateEntry('<?php echo $id; ?>', true)">Delete</button>
                    </div>
                    </div>
                    <?php
                }
                
            }
            ?>
        </div>
    </body>
</html>


