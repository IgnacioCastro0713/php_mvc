<?php
require_once '../home/auth.php';

require_once '../layouts/head.php';
require_once '../layouts/navbar.php';
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
                    <div class="col-lg-12 col-md-12 border-primary" style="border-radius: 10px; background-color: #1e1e26">
                        <br>
                        <h1 class="category-absolute text-info">Agregar Estudio.</h1>
                        <form method="post" id="form" action="">
                            <div class="form-row">
                                <div class="col-md-6 form-group">
                                    <label for="nombre">Nombre</label>
                                    <div class="form-group">
                                        <input id="nombre" name="nombre" type="text" class="form-control" placeholder="Nombre" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="propietario">Propietario</label>
                                    <div class="form-group">
                                        <input id="propietario" name="propietario" type="text" class="form-control" placeholder="Propietario" required>
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="sede">Sede</label>
                                    <div class="form-group">
                                        <input id="sede" name="sede" type="text" class="form-control" placeholder="sede..." required>
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="fundacion">Fecha de fundación</label>
                                    <div class="form-group">
                                        <input id="fundacion" name="fundacion" type="text" class="form-control" placeholder="yyyy-mm-dd" required/>
                                    </div>
                                </div>
                            </div><br>
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
    $('#fundacion').datepicker({
        format: 'yyyy-mm-dd',
        uiLibrary: 'bootstrap4',
        showRightIcon: false,
        orientation: 'bottom auto'
    });

    $('#form').validate({
        errorClass:'text-danger',
        errorElement: 'small',

        messages: {
            nombre:'El nombre no puede quedar vacío.',
            propietario:'El propietario no puede quedar vacío.',
            sede:'La sede no puede quedar vacío.',
            fundacion:'Debe especificar la fecha.'
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
            appVue.sendData({
                "nombre": $('#nombre').val(),
                "propietario": $('#propietario').val(),
                "sede": $('#sede').val(),
                "fundacion": $('#fundacion').val(),
                "func": 'save'
            },'StudioController');
        },
        invalidHandler: function () {
            appVue.toast('error', 'Ingrese la información correctamente.');
        }
    });
</script>
<style type="text/css" rel="stylesheet">
    #fundacion-error{position: absolute; top: 50px;}
</style>