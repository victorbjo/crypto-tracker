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
    
}