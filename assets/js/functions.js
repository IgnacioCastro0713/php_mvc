const swal = Swal.mixin({
    confirmButtonClass: 'btn btn-success',
    cancelButtonClass: 'btn btn-danger',
    buttonsStyling: false,
});

const Toast = Swal.mixin({
    toast: true,
    position: 'top',
    showConfirmButton: false,
    timer: 1700
});

function toast(type, message) {
    Toast.fire({
        type: type,
        title: message
    })
}

function sendData(data, controller) {
    $.ajax({
        data: data,
        type: 'post',
        url: `../../controllers/${controller}.php`,
        success: response => {
            $('#response').html(response);
        }
    });
}

function loadTable(controller) {
    sendData({
        "search" : $('#search').val(),
        "func" : `table`
    }, controller);
}

function sendDataDelete(id, message, controller) {
    $.ajax({
        data: {
            "id" : id,
            "func" : "destroy"
        },
        type: 'post',
        url: `../../controllers/${controller}.php`,
        success: response => {
            if (response === '1') {
                loadTable(controller);
                toast('success', message);
            }else
                toast('error', 'Error al eliminar este registro.')
        }
    });
}

function confirmDelete(name, id, controller) {
    swal.fire({
        title: '¿Desea eliminar a '+name,
        text: "Esta apunto de eliminar este registro.",
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Eliminar',
        cancelButtonText: 'Cancelar',
        reverseButtons: true
    }).then((result) => {
        if (result.value) {
            sendDataDelete(id, ' eliminado correctamente.', controller);
        }
    });
}

function emptyForm() {
    $("#response").html(
        '<div class="alert alert-danger alert-with-icon">' +
                '<button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">' +
                    '<i class="tim-icons icon-simple-remove"></i>' +
                '</button>' +
            '<span data-notify="icon" class="tim-icons icon-alert-circle-exc"></span>' +
            '<span><b> ¡Invalido! - </b>Favor de ingresar los datos correctamente.</span>'+
        '</div>'
        );
}

function setOrUnSetFavorite(id, controller, action, event) {
    event.preventDefault();
    let func = 'destroy';
    if (action)
        func = 'save';
    $.ajax({
        data: {
            "id": id,
            "func": func
        },
        type: 'post',
        url: `../../controllers/FavoriteController.php`,
        success: response => {
            if (response === "setted") {
                loadTable(controller);
                toast('info', 'Agregado a favoritos!');
            } else {
                toast('info', 'Eliminado de favoritos!');
                loadTable('GameController');
            }
        }
    });
}