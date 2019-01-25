<?php
use Connection\Connection as Conn;
require '../../config/Connection.php';

if ($_GET['id'] !== "")
    $row = Conn::getById('usuarios', $_GET['id']) ;

require_once '../layouts/head.php';
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
                    <h1 class="category-absolute text-info">Editar usuario.</h1>
                    <form method="post" id="form" action="">
                        <div class="form-row">
                            <div class="col-md-4 form-group">
                                <label for="nombre">Nombre</label>
                                <div class="form-group">
                                    <input id="nombre" name="nombre" type="text" class="form-control" placeholder="Nombre"
                                           value="<?php echo $row['nombre']; ?>" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="apaterno">Apellido Paterno</label>
                                <div class="form-group">
                                    <input id="apaterno" name="apaterno" type="text" class="form-control" placeholder="Apellido paterno"
                                           value="<?php echo $row['apaterno']; ?>" required>
                                </div>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="amaterno">Apellido Materno</label>
                                <div class="form-group">
                                    <input id="amaterno" name="amaterno" type="text" class="form-control" placeholder="Apellido materno"
                                           value="<?php echo $row['amaterno']; ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="usuario">Usuario</label>
                                <div class="form-group">
                                    <input id="usuario" name="usuario" type="text" class="form-control" placeholder="usuario"
                                           value="<?php echo $row['usuario']; ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="pass">Contraseña</label>
                                <div class="form-group">
                                    <input id="pass" name="pass" type="password" class="form-control" placeholder="Contraseña" required>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="text-center">
                            <input type="submit" class="btn btn-success" onclick="" value="Editar">
                            <br><br>
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
    $("#form").validate({
        errorClass: 'text-danger',
        rules: {
            usuario: {
                minlength: 5
            },
            pass: {
                minlength: 5
            }
        },
        messages: {
            usuario: {
                required: "El usuario no puede quedar vacío.",
                minlength: "El usuario debe contener al menos 5 carácteres."
            },
            pass: {
                required: "La contraseña no puede quedar vacía.",
                minlength: "La contraseña debe contener al menos 5 carácteres."
            },
            nombre: "El nombre no puede quedar vacío.",
            apaterno: "El apellido paterno no puede quedar vacío.",
            amaterno: "El apellido materno no puede quedar vacío."
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
            sendData({
                "nombre" : $('#nombre').val(),
                "apaterno" : $('#apaterno').val(),
                "amaterno" : $('#amaterno').val(),
                "usuario" : $('#usuario').val(),
                "pass" : $('#pass').val(),
                "func" : 'update'
            }, 'UserController.php');
        },
        invalidHandler: function () {
            emptyForm();
        }
    });
</script>
