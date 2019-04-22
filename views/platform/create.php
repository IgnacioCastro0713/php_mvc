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
                        <h1 class="category-absolute text-info">Agregar plataforma.</h1>
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
                                <div class="col-md-12 form-group">
                                    <label for="website">Sitio Web</label>
                                    <div class="form-group">
                                        <input id="website" name="website" type="text" class="form-control" placeholder="https://example.com" required>
                                    </div>
                                </div>
                            </div>
                            <br>
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
    $('#form').validate({
        errorElement: 'small',
        errorClass: 'text-danger',
        rules: {
           website:{
               url: true
           },
        },
        messages: {
            nombre: "El nombre no puede quedar vacío.",
            propietario: "El propietario no puede quedar vacío.",
            website: {
                url: "Ingrese una url valida.",
                required: "La url no puede quedar vacía."
            }
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
                "nombre" : $('#nombre').val(),
                "propietario" : $('#propietario').val(),
                "website" : $('#website').val(),
                "func" : 'save'
            }, 'PlatformController');
        },
        invalidHandler: function () {
            appVue.toast('error', 'Ingrese la información correctamente.');
        }
    });
</script>
