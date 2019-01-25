<?php require_once '../layouts/head.php'; ?>
<!--login-->
<body class="register-page">
<div class="wrapper">
    <div class="page-header">
        <div class="page-header-image"></div>
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 col-md-5 offset-lg-1 offset-md-4">
                        <div id="response">
                            <br><br><br>
                        </div>
                        <div id="square7" class="square square-7"></div>
                        <div id="square8" class="square square-8"></div>
                        <div class="card card-register">
                            <div class="card-body">
                                <form id="form" class="form">
                                    <h4 class="text-info text-lg-left">Usuario</h4>
                                    <div class="form-group">
                                        <input id="user" name="user" type="text" class="form-control" placeholder="Usuario" required>
                                    </div>
                                    <h4 class="text-info text-lg-left">Contraseña</h4>
                                    <div class="form-group">
                                        <input id="pass" name="pass" type="password" class="form-control" placeholder="Contraseña" required>
                                    </div>
                                    <br>
                                    <div class="text-center">
                                        <input type="submit" href="" class="btn btn-info btn-round btn-lg" value="Ingresar" onclick="">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="register-bg"></div>
                <div id="square1" class="square square-1"></div>
                <div id="square2" class="square square-2"></div>
                <div id="square3" class="square square-3"></div>
                <div id="square4" class="square square-4"></div>
                <div id="square5" class="square square-5"></div>
                <div id="square6" class="square square-6"></div>
            </div>
        </div>
    </div>
</body>
<!--end login-->
<?php require_once '../layouts/footer.php'; ?>
<script type="text/javascript">
    $('#form').validate({
        errorClass:'text-danger',
        messages:{
            user: 'El usuario no puede quedar vacío.',
            pass: 'La contraseña no puede quedar vacía.'

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
            sendData({
                "user" : $("#user").val(),
                "pass" : $("#pass").val(),
                "func" : "signin"
            }, 'LoginController.php');
        },
        invalidHandler: function () {
            emptyForm();
        }
    });
</script>

