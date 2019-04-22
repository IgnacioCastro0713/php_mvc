<?php
$array = explode('/', $_SERVER['REQUEST_URI']);
$path = "";
if (count($array) > 3) {
    $path = "../../";
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo $path; ?>assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="<?php echo $path; ?>assets/img/codigo-fuente.png">
    <title>
        Video Games - Proyect Web
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <!-- Nucleo Icons -->
    <link href="<?php echo $path; ?>assets/css/nucleo-icons.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link href="<?php echo $path; ?>assets/css/blk-design-system.css?v=1.0.0" rel="stylesheet" />
    <link href="<?php echo $path; ?>assets/css/gijgo.css" rel="stylesheet" />
</head>
