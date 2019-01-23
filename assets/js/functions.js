function sendData(data, url) {
    $.ajax({
        data: data,
        type: 'post',
        url: '../../controllers/'+url,
        success: function (response) {
            $('#response').html(response);
        }
    });
}

function table(url) {
    sendData({"search" : $('#search').val(),"function" : "table"}, url);
}
