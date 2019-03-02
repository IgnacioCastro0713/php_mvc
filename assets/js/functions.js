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

function getData(object) {
    const formData = new FormData();
    Object.keys(object).forEach(key => formData.append(key, object[key]));
    return formData;
}

function sendData(request, controller) {
    fetch(`../../controllers/${controller}.php`, {
        method: 'POST',
        body: getData(request)
    }).then(data => data.text())
        .then(response => $('#response').html(response));
}

function loadTable(controller) {
    sendData({
        "search" : $('#search').val(),
        "func" : `table`
    }, controller);
}

function sendDataDelete(id, message, controller) {
    fetch(`../../controllers/${controller}.php`,{
       method: 'POST',
       body: getData({
           "id" : id,
           "func" : "destroy"
       })
    }).then(data => data.text())
        .then(response => {
            if (response === "1") {
                loadTable(controller);
                toast('success', message);
            } else
                toast('error', 'Error al eliminar este registro.');
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
            '<span><b> ¡Error! - </b>Favor de ingresar los datos correctamente.</span>'+
        '</div>'
        );
}

function confirmDeleteFavorite(id, name, controller, event) {
    swal.fire({
        title: '¿Desea eliminar a '+name,
        text: "Está apunto de eliminar este registro de favoritos.",
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Eliminar',
        cancelButtonText: 'Cancelar',
        reverseButtons: true
    }).then((result) => {
        if (result.value) {
            setOrUnSetFavorite(id, controller, false, event);
        }
    });
}

function setOrUnSetFavorite(id, controller, action, event) {
    event.preventDefault();
    let func = action ? 'save' : 'destroy';
    fetch(`../../controllers/FavoriteController.php`,{
        method: 'POST',
        body: getData({
            "id" : id,
            "func" : func
        })
    }).then(data => data.text())
        .then(response => {
            if (response === "setted") {
                loadTable(controller);
                toast('info', 'Agregado a favoritos!');
            } else if (response === "unsetted") {
                loadTable(controller);
                toast('info', 'Eliminado de favoritos!');
            } else {
                toast('error', "error al eliminar o al agregar!")
            }
        });
}

function detailFavorite(id) {
    fetch(`../../controllers/FavoriteController.php`, {
        method: 'POST',
        body: getData({
            "id": id,
            "func": 'details'
        })
    }).then(data => data.text())
        .then(response => $('#detail').html(response));
}
