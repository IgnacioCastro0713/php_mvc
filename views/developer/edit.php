<?php
require '../../config/Connection.php';
require '../../config/Utilities.php';
use Utilities\Utilities;
if ($_GET['id'] !== "")
    $row = Utilities::getById('desarrollador', $_GET['id']) ;
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
                <div class="col-lg-12 col-md-12 border-primary" style="border-radius: 10px; background-color: #1e1e26">
                    <br>
                    <h1 class="category-absolute text-info">Agregar desarrollador.</h1>
                    <form method="post" id="form" action="">
                        <div class="form-row">
                            <div class="col-md-4 form-group">
                                <label for="nombre">Nombre</label>
                                <div class="form-group">
                                    <input id="nombre" name="nombre" type="text" class="form-control" placeholder="Nombre"
                                           value="<?php echo $row->nombre; ?>" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="apaterno">Apellido Paterno</label>
                                <div class="form-group">
                                    <input id="apaterno" name="apaterno" type="text" class="form-control" placeholder="Apellido paterno"
                                           value="<?php echo $row->apaterno; ?>" required>
                                </div>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="amaterno">Apellido Materno</label>
                                <div class="form-group">
                                    <input id="amaterno" name="amaterno" type="text" class="form-control" placeholder="Apellido materno"
                                           value="<?php echo $row->amaterno; ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="ciudad">Cuidad</label>
                                <div class="form-group">
                                    <input id="ciudad" name="ciudad" type="text" class="form-control" placeholder="Ciudad"
                                           value="<?php echo $row->ciudad; ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="estudio">Estudio</label>
                                <div class="form-group">
                                    <?php Utilities::select('estudio', 'estudio', $row->estudio_id); ?>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="text-center">
                            <input type="submit" class="btn btn-success" onclick="" value="Editar"><br><br>
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
        errorClass:'text-danger',
        errorElement:'small',

        messages:{
            nombre: "El nombre no puede quedar vacío.",
            apaterno: "El apellido paterno no puede quedar vacío.",
            amaterno: "El apellido materno no puede quedar vacío.",
            ciudad: "EL nombre de la ciudad no puede quedar vacío.",
            estudio: "Debe selecionar el estudio al que pertenece."
        },
        highlight: function(element){
            $(element)
                .closest('.form-group')
                .addClass('has-danger');
        },
        unhighlight: function(element){
            $(element)
                .closest('.form-group')
                .removeClass('has-danger')
                .addClass('has-success');
        },
        submitHandler: function () {
            appVue.sendData({
                "id": <?php echo $_GET['id']; ?>,
                "nombre": $('#nombre').val(),
                "apaterno": $('#apaterno').val(),
                "amaterno": $('#amaterno').val(),
                "ciudad": $('#ciudad').val(),
                "estudio": $('#estudio').val(),
                "func": 'update'
            }, 'DeveloperController');
        },
        invalidHandler: function () {
            appVue.toast('error', 'Ingrese la información correctamente.');
        }
    });
</script>