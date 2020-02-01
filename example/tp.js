//https://api.worldtradingdata.com/api/v1/stock?symbol=SNAP,TWTR,VOD.L&api_token=KbzMvegVlq6PGIszedPEvD4R73NrKnhdlVur1JuLzxA2yrza9KKe8tzxGyUd
// const url = new URL(
//     "https://api.worldtradingdata.com/api/v1/stock"
// );

// let params = {
//     "symbol": "SNAP,TWTR,VOD.L",
//     "api_token": "ItUyZsdrPdMoBzkPVujqiQXgFDrCBubbCVXiA8jTCQ5LRZyR9cuRltxZBEiA",
// };
// Object.keys(params)
//     .forEach(key => url.searchParams.append(key, params[key]));

// setInterval(function(){ fetch(url, {
//     method: "GET",
// })
//     .then(response => response.json())
//     .then(json => console.log(json.data)); }, 1000);
$("#button").on("click", function() {
    //    setInterval(function(){
        $.ajax({
            url: "https://api.worldtradingdata.com/api/v1/stock?symbol=AAPL&api_token=KbzMvegVlq6PGIszedPEvD4R73NrKnhdlVur1JuLzxA2yrza9KKe8tzxGyUd",
            method: "GET",
            dataType: "json",
            success: function(data) {
                console.log(data);
            $("#para").html(JSON.stringify(data));
            },
            error: function(error) {
              console.log(error);
            }
          });
        
        // ,15000); 
});
        