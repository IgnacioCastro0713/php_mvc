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

function emptyForm() {
    $("#response").html(
        '<div class="alert alert-danger alert-with-icon">' +
                '<button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">' +
                    '<i class="tim-icons icon-simple-remove"></i>' +
                '</button>' +
            '<span data-notify="icon" class="tim-icons icon-alert-circle-exc"></span>' +
            '<span><b> ¡Invalido! - </b>Favor de ingresar los datos correctamente.</span>'+
        '</div>');
}