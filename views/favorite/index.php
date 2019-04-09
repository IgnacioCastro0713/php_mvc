<?php
require '../../config/Connection.php';
require '../../config/Utilities.php';
include_once "../layouts/navbar.php";
require_once '../home/auth.php';
$row = \Utilities\Utilities::getById('usuario', $_GET['id'] ?? $_SESSION['id']);
?>
<body class="profile-page">
<div class="wrapper">
    <div class="page-header">
        <img src="../../assets/img/dots.png" class="dots">
        <img src="../../assets/img/path4.png" class="path">
        <div class="container align-items-center">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <h1 class="profile-title text-left"><?php echo "{$row->nombre} {$row->apaterno} {$row->amaterno}"; ?></h1>
                    <h5 class="text-on-back"><i class="tim-icons icon-single-02"></i></h5>
                    <p class="profile-description">
                        Aquí iría una descripción pero no puse eso en la base de datos así que lo deje así xD... perdón
                    </p>
                    <div class="btn-wrapper profile pt-3">
                        <a target="_blank" href="https://twitter.com/creativetim" class="btn btn-icon btn-twitter btn-round" data-toggle="tooltip" data-original-title="Follow us">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a target="_blank" href="https://www.facebook.com/creativetim" class="btn btn-icon btn-facebook btn-round" data-toggle="tooltip" data-original-title="Like us">
                            <i class="fab fa-facebook-square"></i>
                        </a>
                        <a target="_blank" href="https://dribbble.com/creativetim" class="btn btn-icon btn-dribbble  btn-round" data-toggle="tooltip" data-original-title="Follow us">
                            <i class="fab fa-dribbble"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 ml-auto mr-auto">
                    <div class="card card-coin card-plain">
                        <div class="card-header">
                            <img src="../../assets/img/mike.jpg" class="img-center img-fluid rounded-circle">
                            <h4 class="title"><?php echo $row->admin ? "Administrador" : "Normal"; ?></h4>
                        </div>
                        <div class="card-body">
                            <ul class="nav nav-tabs nav-tabs-primary justify-content-center">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#linka">
                                        Wallet
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#linkc">
                                        Información
                                    </a>
                                </li>
                            </ul>

                            <div class="tab-content tab-subcategories">
                                <div class="tab-pane active" id="linka">
                                    <div class="table-responsive ps">
                                        <table class="table tablesorter " id="plain-table">
                                            <thead class=" text-primary">
                                            <tr>
                                                <th class="header">COIN</th>
                                                <th class="header">AMOUNT</th>
                                                <th class="header">VALUE</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>BTC</td>
                                                <td>7.342</td>
                                                <td>48,870.75 USD</td>
                                            </tr>
                                            <tr>
                                                <td>ETH</td>
                                                <td>30.737</td>
                                                <td>64,53.30 USD</td>
                                            </tr>
                                            <tr>
                                                <td>XRP</td>
                                                <td>19.242</td>
                                                <td>18,354.96 USD</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
                                </div>

                                <div class="tab-pane" id="linkc">
                                    <div class="table-responsive ps">
                                        <table class="table tablesorter " id="plain-table">
                                            <thead class=" text-primary">
                                            <tr>
                                                <th class="header">Información detallada</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>Usuario: <?php echo $row->usuario; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Nombre completo: <?php echo $row->nombre; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Apellidos: <?php echo "$row->apaterno $row->amaterno"; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Tipo de usuario: <?php echo $row->admin ? "Administrador" : "Normal"; ?></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div></div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-md-5">
                    <script type="text/javascript">
                        let controller = 'FavoriteController';
                    </script>
                    <?php require_once '../layouts/search.php' ?>
                    <div class="row justify-content-between align-items-center">
                        <table class="table tablesorter " id="plain-table">
                            <thead class=" text-primary">
                            <tr>
                                <th class="header">Nombre</th>
                                <th class="header">Genero</th>
                                <th class="header">Lanzamiento</th>
                            </tr>
                            </thead>
                            <tbody id="response">

                            </tbody>
                        </table>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Detalles</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body" id="detail">

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <style>
                        #exampleModalLong {
                            top: 230px;
                            right: 0;
                            bottom: 0;
                            left: 600px;
                        }
                    </style>
                </div>
            </div>
        </div>
    </div>

</body>
<?php
include_once "../layouts/footer.php";
?>
<script type="text/javascript">
    $(document).ready(loadTable(controller));
</script>
