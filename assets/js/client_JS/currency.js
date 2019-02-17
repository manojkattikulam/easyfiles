// CURRENCY CONVERTER

function convertCurrency() {

    let from = $('#from').val();
    let to = $('#to').val();



    $.ajax({
        url: 'http://data.fixer.io/api/latest?access_key=170dbd39618c9ad890c56d29e50cb5eb&symbols=' + from + ',' + to,

        dataType: 'jsonp',
        success: function(data) {

            let oneUnit = data.rates[to] / data.rates[from];
            let amt = $('#fromAmount').val();
            $('#toAmount').val((oneUnit * amt).toFixed(2));
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert("Error, Updating Data");
        }
    });


}