function saveInput() {
    var coin = document.getElementById("coin").value;
    var quantity = document.getElementById("quantity").value;
    var price = document.getElementById("price").value;
    var proceed = true;
    /*if (quantity != Number){
        alert("Please enter a quantity in numerics");
        proceed = false;
    }
    if (price != Number){
        alert("Please enter a price in numerics");
        proceed = false;
    }*/
    if (proceed){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (xhttp.status == "200"){
            var prices = (this.responseText);
            document.getElementById("test").innerText = "The fuck";
        }
    };
    xhttp.open("POST", "http://localhost/crypto-Tracker/addToQueue.php", true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.send("quantity="+String(quantity)+"&coin="+String(coin)+"&price="+String(price));
}
}
function show_edit(id){
    parentDiv = document.getElementById(id).parentElement;
    parentDiv.classList.toggle("high");
    hiddenDiv = document.getElementById(id+"-hidden");
    hiddenDiv.classList.toggle("crypto-portfolio-hidden-not");
}
function updateEntry(crypto, deleteEntry = false){
    var entryId = document.getElementById(crypto +"-id");
    var entryPrice = document.getElementById(crypto +"-price");
    var entryAmount = document.getElementById(crypto +"-amount");
    var origPrice = document.getElementById(crypto +"-priceOrig");
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (xhttp.status == "200"){
            var prices = (this.responseText);
            if (prices == "success"){
                origPrice.innerText = entryPrice.value;
            }
        }
    };

    xhttp.open("POST", "http://localhost/crypto-Tracker/editEntry.php", true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    if (deleteEntry == true){
        xhttp.send("quantity="+String(entryAmount.value)+"&id="+String(entryId.value)+"&price="+String(entryPrice.value)+"&delete=true");  
    }
    else{
        xhttp.send("quantity="+String(entryAmount.value)+"&id="+String(entryId.value)+"&price="+String(entryPrice.value));
    }
}
