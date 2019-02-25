<?php
require '../../config/Connection.php';
require '../../config/Utilities.php';
include_once "../layouts/header.php";
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
                    <p class="profile-description">Offices parties lasting outward nothing age few resolve. Impression to discretion understood to we interested he excellence. Him remarkably use projection collecting. Going about eat forty world has round miles.</p>
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
                                        News
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
                                                <th class="header">Latest Crypto News</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>The Daily: Nexo to Pay on Stable...</td>
                                            </tr>
                                            <tr>
                                                <td>Venezuela Begins Public of Nation...</td>
                                            </tr>
                                            <tr>
                                                <td>PR: BitCanna – Dutch Blockchain...</td>
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
                <div class="col-md-6">
                    <div class="row justify-content-between align-items-center">
                        <!--Section 1-->
                    </div>
                </div>
                <div class="col-md-5">
                    <!--Section 2-->
                </div>
            </div>
        </div>
    </div>
</body>
<?php
include_once "../layouts/footer.php";
?>
