var currencies=null;
function getCurrencies(create = true) {
    //window.setTimeout(getCurrencies, 10000);
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        var prices = (this.responseText);
        currencies = JSON.parse(prices);
        if (create){
            getCurrency("bitcoin", true);
        }
    };
    xhttp.open("GET", "https://api.coincap.io/v2/assets", true);
    xhttp.send();
}

function createCurrencyTicker(currency){
    let mainDiv = document.createElement("div");
    mainDiv.classList.add("ticker");
    const para = document.createElement("p");
    var price = currency.priceUsd;
    price = roundPrice(price);
    const node = document.createTextNode(currency.name + " Price USD: " + price);
    para.appendChild(node);
    let buy = document.createElement("button");
    buy.innerHTML = "Add to tracker";
    buy.id = "button_add_to_tracker"
    buy.addEventListener("click", changeCoin);
    buy.coin = currency.name;
    const element = document.getElementById("tickers");
    mainDiv.appendChild(para);
    mainDiv.appendChild(buy);
    element.appendChild(mainDiv);
}

function changeCoin(evt){
    coin = evt.currentTarget.coin
    var coinParagraph = document.getElementById("coinParagraph");
    var coinHidden = document.getElementById("coin");
    document.getElementById("div-track-coin").classList.remove("div-track-coin-invisible");
    coinParagraph.innerText = coin;
    coinHidden.value=coin;
    window.addEventListener("click", checkClick);
}


function getCurrency(id, all = false){
    if (all){
        for (var i = 0; i < 50; i++){
            createCurrencyTicker(currencies.data[i]);
    }
    }
    else{
    for (var i = 0; i < 50; i++){
        if (id === currencies.data[i].id){
            return currencies.data[i]
        }
    }
}
}

function checkClick(evt){
    var container = document.getElementById("div-track-coin");
    if (evt.target.id != "div-track-coin" && evt.target.id != "button_add_to_tracker" && !container.contains(evt.target)){
        document.getElementById("div-track-coin").classList.add("div-track-coin-invisible");
    }
}
function checkCurrencies(){
    if(currencies==null){
        setTimeout(checkCurrencies, 500);
        getCurrencies();
    }
}
function updateTracker(){
    getCurrencies(false);
    if (currencies == null){
        setTimeout(updateTracker, 500);
        var a = 0;
    }
    else{
    var currenciesToTrack = document.getElementsByClassName("currentPrice");
    var holdings = document.getElementsByClassName("currentHoldings");
    var amount = document.getElementsByClassName("currentAmount");
    var avgPrices = document.getElementsByClassName("avgPrice");
    var profit = document.getElementsByClassName("profit");
    for (var i = 0; i < currenciesToTrack.length; i++){
        var tempPrice;
        for (var j = 0; j < currencies.data.length; j++){
            if (currencies.data[j].name == currenciesToTrack[i].id){
                currenciesToTrack[i].innerHTML = roundPrice(currencies.data[j].priceUsd) + " $USD";
                tempPrice = currencies.data[j].priceUsd;
                break;
            }
        }
        var tempAmount = amount[i].innerHTML.slice(0,amount[i].innerHTML.indexOf(" "));
        var tempAvg = avgPrices[i].innerHTML.slice(0,avgPrices[i].innerHTML.indexOf(" "));
        holdings[i].innerHTML=roundPrice(tempAmount*tempPrice)+" $USD";
        profit[i].innerHTML = roundPrice(tempAmount*tempPrice - tempAvg * tempAmount) + " $USD";
    }
}
    setTimeout(updateTracker, 10000);
}
function roundPrice(price){
    if (price>10){
        price = Math.round(price * 100)/100;
    }
    else if (price>1){
        price = Math.round(price * 1000)/1000;
    }
    else if (price>0.1){
        price = Math.round(price * 10000)/10000;
    }
    else if (price>0.01){
        price = Math.round(price * 100000)/100000;
    }
    return price;
}