var currencies;
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
    const node = document.createTextNode(currency.name + " Price USD: " + Math.round(currency.priceUsd,2));
    para.appendChild(node);
    let buy = document.createElement("button");
    buy.innerHTML = "Add to tracker";
    buy.addEventListener("click", changeCoin);
    buy.coin = currency.id;
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