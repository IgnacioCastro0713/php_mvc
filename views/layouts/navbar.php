<div id="app">
<nav class="navbar navbar-expand-lg fixed-top navbar-transparent " color-on-scroll="100">
    <div class="container">
        <div class="navbar-translate">
            <a class="navbar-brand" href="../../" rel="tooltip" title="Designed and Coded by Creative Tim" data-placement="bottom">
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
            <?php if (isset($_SESSION['valid'])) {?>
                <ul class="navbar-nav">
                    <li class="dropdown nav-item">
                        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                            <i class="tim-icons icon-controller"></i>videojuego
                        </a>
                        <div class="dropdown-menu dropdown-with-icons">
                            <a href="<?php echo $path; ?>views/game/create" class="dropdown-item">
                                <i class="tim-icons icon-simple-add"></i> Agregar
                            </a>
                            <a href="<?php echo $path; ?>views/game/" class="dropdown-item">
                                <i class="tim-icons icon-bullet-list-67"></i>Consultar
                            </a>
                        </div>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="dropdown nav-item">
                        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                            <i class="tim-icons icon-atom"></i>Desarrollador
                        </a>
                        <div class="dropdown-menu dropdown-with-icons">
                            <a href="<?php echo $path; ?>views/developer/create" class="dropdown-item">
                                <i class="tim-icons icon-simple-add"></i> Agregar
                            </a>
                            <a href="<?php echo $path; ?>views/developer/" class="dropdown-item">
                                <i class="tim-icons icon-bullet-list-67"></i>Consultar
                            </a>
                        </div>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="dropdown nav-item">
                        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                            <i class="tim-icons icon-molecule-40"></i>Estudio
                        </a>
                        <div class="dropdown-menu dropdown-with-icons">
                            <a href="<?php echo $path; ?>views/studio/create" class="dropdown-item">
                                <i class="tim-icons icon-simple-add"></i> Agregar
                            </a>
                            <a href="<?php echo $path; ?>views/studio/" class="dropdown-item">
                                <i class="tim-icons icon-bullet-list-67"></i>Consultar
                            </a>
                        </div>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="dropdown nav-item">
                        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                            <i class="tim-icons icon-app"></i>Plataforma
                        </a>
                        <div class="dropdown-menu dropdown-with-icons">
                            <a href="<?php echo $path; ?>views/platform/create" class="dropdown-item">
                                <i class="tim-icons icon-simple-add"></i> Agregar
                            </a>
                            <a href="<?php echo $path; ?>views/platform/" class="dropdown-item">
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
                            <a href="<?php echo $path; ?>views/user/create" class="dropdown-item">
                                <i class="tim-icons icon-simple-add"></i> Agregar
                            </a>
                            <a href="<?php echo $path; ?>views/user/" class="dropdown-item">
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
                            <a href="<?php echo $path; ?>views/favorite/index?id=<?php echo $_SESSION['id'] ?>" class="dropdown-item">
                                <i class="tim-icons icon-badge"></i> <?php echo $_SESSION['user'] ?>
                            </a>
                            <a href="<?php echo $path; ?>" class="dropdown-item" @click.prevent="logout()">
                                <i class="tim-icons icon-simple-remove"></i>Salir
                            </a>
                        </div>
                    </li>
                </ul>
            <?php } else {?>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="<?php echo $path; ?>views/home/login" class="nav-link">
                            <i class="tim-icons icon-tap-02"></i> Ingresar
                        </a>
                    </li>
                </ul>
            <?php }?>
        </div>
    </div>
</nav>
</div>
