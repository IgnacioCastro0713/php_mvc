<?php
require '../../config/Connection.php';
require '../../config/core/Utilities.php';
use Utilities\Utilities;
require_once '../layouts/head.php';
require_once '../layouts/navbar.php';
require_once '../home/auth.php';
?>
<body class="landing-page">
    <div class="wrapper">
        <div class="page-header">
            <img src="../../assets/img/blob.png" class="path">
            <img src="../../assets/img/path2.png" class="path2">
            <img src="../../assets/img/triunghiuri.png" class="shapes triangle">
            <img src="../../assets/img/waves.png" class="shapes wave">
            <img src="../../assets/img/patrat.png" class="shapes squares">
            <img src="../../assets/img/cercuri.png" class="shapes circle">
            <div class="content-center">
                <div class="row row-grid justify-content-center align-items-center text-left">
                    <div id="response"></div>
                    <div class="col-lg-12 col-md-12 border-primary" style="border-radius: 10px; background-color: #1e1e26;">
                        <h1 class="category-absolute text-info">Agregar videojuego.</h1>
                        <form method="post" id="form" action="">
                            <div class="form-row">
                                <div class="col-md-6 form-group">
                                    <label for="nombre">Nombre</label>
                                    <div class="form-group">
                                        <input id="nombre" name="nombre" type="text" class="form-control" placeholder="Nombre" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="genero">Genero</label>
                                    <div class="form-group">
                                        <input id="genero" name="genero" type="text" class="form-control" placeholder="Genero" required>
                                    </div>
                                </div>
                                <div class="col-md-12 form-group">
                                    <label for="descripcion">Descripción</label>
                                    <div class="form-group">
                                        <textarea id="descripcion" name="descripcion" type="text" class="form-control" placeholder="Escribe una descripción..." rows="4" required></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="lazamiento">Fecha de Lanzamiento</label>
                                    <div class="form-group">
                                        <input id="lazamiento" name="lanzamiento" type="text" class="form-control" placeholder="yyyy-mm-dd" required/>
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="estudio">Estudio</label>
                                    <div class="form-group">
                                        <?php Utilities::select('estudio', 'estudio', null); ?>
                                    </div>
                                </div>
                                <div class="col-md-12 form-group">
                                    <label for="plataforma">Plataforma</label>
                                    <div class="form-check form-group">
                                        <?php Utilities::checkbox(null);?>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <input type="submit" class="btn btn-success" onclick="" value="Guardar"><br><br>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<?php require_once '../layouts/footer.php'; ?>
<script type="text/javascript">
    $('#lazamiento').datepicker({
        format: 'yyyy-mm-dd',
        uiLibrary: 'bootstrap4',
        showRightIcon: false,
        orientation: 'bottom auto'
    });

    $('#form').validate({
        errorClass: 'text-danger',
        errorElement: "small",
        rules:{
            plataforma: {
                minlength: 1
            }
        },
        messages:{
            nombre: "El nombre no puede quedar vacío.",
            genero: "El genero no puede quedar vacío.",
            descripcion: "La descripción no puede quedar vacía.",
            lanzamiento: "Debe especificar la fecha de lanzamiento",
            estudio: "Debe selecionar el estudio al que pertenece.",
            plataforma:{
                required: "Selecione una plataforma.",
                minlength: "Debe selecionar al menos 1 plataforma."
            }
        },
        errorPlacement: function(label, element ) {
            if(element.attr("name") === "plataforma")
                element.parent().append(label);
            else
                label.insertAfter(element);
        },
        highlight: function (element) {
            $(element)
                .closest('.form-group')
                .addClass('has-danger');
        },
        unhighlight: function (element) {
            $(element)
                .closest('.form-group')
                .removeClass('has-danger')
                .addClass('has-success');
        },
        submitHandler: function () {
            var platforms = [];
            $('#plataforma-parent input:checked').each(function() {
                platforms.push($(this).val());
            });
            appVue.sendData({
                "nombre": $('#nombre').val(),
                "genero": $('#genero').val(),
                "descripcion": $('#descripcion').val(),
                "lanzamiento": $('#lazamiento').val(),
                "estudio": $('#estudio').val(),
                "plataformas": platforms,
                "func": 'save'
            }, 'GameController');
        },
        invalidHandler: function () {
            appVue.toast('error', 'Ingrese la información correctamente.');
        }
    });
</script>
<style type="text/css" rel="stylesheet">
    #lazamiento-error {position: absolute; top: 40px;}
    #plataforma-error{position: absolute; bottom: 37px; width: 100vh; padding-left: 70px}
</style>
