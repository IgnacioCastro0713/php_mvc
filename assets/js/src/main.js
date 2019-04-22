import $ from 'jquery';
import Swal from 'sweetalert2';

window.$ = window.jQuery = $;
window.Swal = Swal;

require('../blk-design-system');
require('../../../node_modules/sweetalert2/dist/sweetalert2');
require('../../../node_modules/jquery-validation/dist/jquery.validate');
require('../../../node_modules/jquery-validation/dist/additional-methods');
require('../../../node_modules/gijgo/js/gijgo');
require('../../../node_modules/bootstrap/dist/js/bootstrap');
require('../../../node_modules/perfect-scrollbar/dist/perfect-scrollbar');
require('../plugins/bootstrap-switch');
require('../../../node_modules/nouislider');
require('../../../node_modules/popper.js/dist/umd/popper');
require('../../../node_modules/moment/moment');

//vue configuration
import Vue from 'vue';
Vue.config.productionTip = false;
//application vue
const app = new Vue({
    el: '#app',
    mounted(){
        console.log('working...');
    },
    data: {
        title: 'PHP MVC•',
        subtitle: 'PROYECTO REALIZADO EN PHP POO CON EL PATRON DE DISEÑO MVC.',
        swal : Swal.mixin({
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            buttonsStyling: false
        }),
        Toast : Swal.mixin({
            toast: true,
            position: 'top',
            showConfirmButton: false,
            timer: 2000
        }),
    },
    methods: {
        toast(type, message){
            this.Toast.fire({
                type: type,
                title: message
            })
        },
        getData(object) {
            const formData = new FormData();
            Object.keys(object).forEach(key => formData.append(key, object[key]));
            return formData;
        },
        sendData(request, controller) {
            fetch(`../../controllers/${controller}`, {
                method: 'POST',
                body: this.getData(request)
            }).then(data => data.text())
                .then(response => $('#response').html(response));
        },
        loadTable(controller) {
            this.sendData({
                "search" : $('#search').val(),
                "func" : `table`
            }, controller)
        },
        sendDataDelete(id, message, controller) {
            fetch(`../../controllers/${controller}`,{
                method: 'POST',
                body: this.getData({
                    "id" : id,
                    "func" : "destroy"
                })
            }).then(data => data.text())
                .then(response => {
                    if (response === "1") {
                        this.loadTable(controller);
                        this.toast('success', message);
                    } else
                        this.toast('error', 'Error al eliminar este registro.');
                });
        },
        emptyForm() {
            $("#response").html(
                `<div class="alert alert-danger alert-with-icon"> 
                    <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
                        <i class="tim-icons icon-simple-remove"></i>
                    </button>
                    <span data-notify="icon" class="tim-icons icon-alert-circle-exc"></span>
                    <span><b> ¡Error! - </b>Favor de ingresar los datos correctamente.</span>
                </div>`);
        },
        confirmDelete(name, id, controller) {
            this.swal.fire({
                title: '¿Desea eliminar a '+name,
                text: "Esta apunto de eliminar este registro.",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Eliminar',
                cancelButtonText: 'Cancelar',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    this.sendDataDelete(id, ' eliminado correctamente.', controller);
                }
            });
        },
        confirmDeleteFavorite(id, name, controller, event) {
            this.swal.fire({
                title: '¿Desea eliminar a '+name,
                text: "Está apunto de eliminar este registro de favoritos.",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Eliminar',
                cancelButtonText: 'Cancelar',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    this.setOrUnSetFavorite(id, controller, false, event);
                }
            });
        },
        setOrUnSetFavorite(id, controller, action, event) {
            event.preventDefault();
            let func = action ? 'save' : 'destroy';
            fetch(`../../controllers/FavoriteController`,{
                method: 'POST',
                body: this.getData({
                    "id" : id,
                    "func" : func
                })
            }).then(data => data.text())
                .then(response => {
                    if (response === "setted") {
                        this.loadTable(controller);
                        this.toast('info', 'Agregado a favoritos!');
                    } else if (response === "unsetted") {
                        this.loadTable(controller);
                        this.toast('info', 'Eliminado de favoritos!');
                    } else {
                        this.toast('error', "error al eliminar o al agregar!")
                    }
                });
        },
        detailFavorite(id) {
            fetch(`../../controllers/FavoriteController`, {
                method: 'POST',
                body: this.getData({
                    "id": id,
                    "func": 'details'
                })
            }).then(data => data.text())
                .then(response => $('#detail').html(response));
        },
        logout() {
            this.sendData({
                'func' : 'logout'
            }, 'LoginController');
        }
    },
});
window.appVue = app;