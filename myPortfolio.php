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
                        <div class="crypto-portfolio-hidden"><p>Price</p><div>
                        <?php
                    $id = $row['id'];
                    $crypto = $row["crypto"];
                    echo "<div class='crypto-portfolio' id='".$crypto."'/>";
                    echo $crypto;
                    echo " Purchase price: ".$row["price"];
                    echo " Purchase date: ".$row["purchase_date"];
                    echo " Amount bought:".$row["amount"];
                    echo "<button onclick=".'"'."show_edit('".$crypto."')".'"'.">FUCK</button> ";
                    echo "</div>";
                    echo "</div>";
                    
                }
                
            }
            ?>
            <button onclick="show_edit('asd')">FUCK</button>
    </body>
</html>


