<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../../assets/img/codigo-fuente.png">
    <title>
        Video Games - Proyect Web
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <!-- Nucleo Icons -->
    <link href="../../assets/css/nucleo-icons.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link href="../../assets/css/blk-design-system.css?v=1.0.0" rel="stylesheet" />

</head>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg fixed-top navbar-transparent " color-on-scroll="100">
    <div class="container">
        <div class="navbar-translate">
            <a class="navbar-brand" href="https://demos.creative-tim.com/blk-design-system/index.html" rel="tooltip" title="Designed and Coded by Creative Tim" data-placement="bottom" target="_blank">
                <span>BLK•</span> Design System
            </a>
            <button class="navbar-toggler navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <div class="navbar-collapse-header">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a>
                            BLK•
                        </a>
                    </div>
                    <div class="col-6 collapse-close text-right">
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                            <i class="tim-icons icon-simple-remove"></i>
                        </button>
                    </div>
                </div>
            </div>
            <?php
            if (isset($_SESSION['valid'])){ ?>
                <ul class="navbar-nav">
                    <li class="dropdown nav-item">
                        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                            <i class="tim-icons icon-atom"></i>Estudio
                        </a>
                        <div class="dropdown-menu dropdown-with-icons">
                            <a href="../studio/save.php" class="dropdown-item">
                                <i class="tim-icons icon-simple-add"></i> Agregar
                            </a>
                            <a href="../studio/index.php" class="dropdown-item">
                                <i class="tim-icons icon-bullet-list-67"></i>Consultar
                            </a>
                        </div>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="dropdown nav-item">
                        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                            <i class="tim-icons icon-planet"></i>Plataforma
                        </a>
                        <div class="dropdown-menu dropdown-with-icons">
                            <a href="../platform/save.php" class="dropdown-item">
                                <i class="tim-icons icon-simple-add"></i> Agregar
                            </a>
                            <a href="../platform/index.php" class="dropdown-item">
                                <i class="tim-icons icon-bullet-list-67"></i>Consultar
                            </a>
                        </div>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="dropdown nav-item">
                        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                            <i class="tim-icons icon-single-02"></i>Usuarios
                        </a>
                        <div class="dropdown-menu dropdown-with-icons">
                            <a href="../user/save.php" class="dropdown-item">
                                <i class="tim-icons icon-simple-add"></i> Agregar
                            </a>
                            <a href="../user/index.php" class="dropdown-item">
                                <i class="tim-icons icon-bullet-list-67"></i>Consultar
                            </a>
                        </div>
                    </li>
                </ul>
            <ul class="navbar-nav">
                <li class="dropdown nav-item">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                        <i class="tim-icons icon-settings-gear-63"></i>
                    </a>
                    <div class="dropdown-menu dropdown-with-icons">
                        <a href="" class="dropdown-item">
                            <i class="tim-icons icon-badge"></i> <?php echo $_SESSION['user']?>
                        </a>
                        <a href="" class="dropdown-item" onclick="logout(event)">
                            <i class="tim-icons icon-simple-remove"></i>Salir
                        </a>
                    </div>
                </li>
            </ul>
            <?php } else { ?>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="../home/login.php" class="nav-link">
                            <i class="tim-icons icon-tap-02"></i> Ingresar
                        </a>
                    </li>
                </ul>
            <?php } ?>
        </div>
    </div>
</nav>
<!-- End Navbar -->

