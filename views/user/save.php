<?php require_once '../layouts/head.php'?>
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
                    <div class="col-lg-12 col-md-12 border-primary" style="border-radius: 10px; background-color: #242637">
                        <h1 class="text-secondary text-center">Agregar usuario</h1>
                        <form method="post" id="form" action="">
                            <div class="form-row">
                                <div class="col-md-4">
                                    <label for="nombre">Nombre</label>
                                    <input id="nombre" name="nombre" type="text" class="form-control" placeholder="Nombre">
                                </div>
                                <div class="col-md-4">
                                    <label for="apaterno">Apellido Paterno</label>
                                    <input id="apaterno" name="apaterno" type="text" class="form-control" placeholder="Apellido paterno">
                                </div>
                                <div class="col-md-4">
                                    <label for="amaterno">Apellido Materno</label>
                                    <input id="amaterno" name="amaterno" type="text" class="form-control" placeholder="Apellido materno">
                                </div>
                                <div class="col-md-6">
                                    <label for="usuario">Usuario</label>
                                    <input id="usuario" name="usuario" type="text" class="form-control" placeholder="usuario">
                                </div>
                                <div class="col-md-6">
                                    <label for="pass">Contraseña</label>
                                    <input id="pass" name="pass" type="password" class="form-control" placeholder="Contraseña">
                                </div>
                            </div><br>
                            <div class="text-center">
                                <input type="submit" class="btn btn-primary" onclick="" value="Guardar">
                            </div>
                        </form>
                        <div id="response">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<?php require_once '../layouts/footer.php'; ?>
<script type="text/javascript">
    $('#form').submit(function () {
        event.preventDefault();
        sendData({
            "nombre" : $('#nombre').val(),
            "apaterno" : $('#apaterno').val(),
            "amaterno" : $('#amaterno').val(),
            "usuario" : $('#usuario').val(),
            "pass" : $('#pass').val(),
            "function" : 'save'
        }, 'UserController.php');
    });
</script>
