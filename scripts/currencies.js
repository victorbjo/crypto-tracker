var currencies=null;
function getCurrencies() {
    //window.setTimeout(getCurrencies, 10000);
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        var prices = (this.responseText);
        currencies = JSON.parse(prices);
        getCurrency("bitcoin", true);
    };
    xhttp.open("GET", "https://api.coincap.io/v2/assets", true);
    xhttp.send();
}

function createCurrencyTicker(currency){
    let mainDiv = document.createElement("div");
    mainDiv.classList.add("ticker");
    const para = document.createElement("p");
    var price = currency.priceUsd;
    if (price>10){
        price = Math.round(currency.priceUsd * 100)/100;
    }
    else if (price>1){
        price = Math.round(currency.priceUsd * 1000)/1000;
    }
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