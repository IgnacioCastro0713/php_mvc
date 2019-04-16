<?php

namespace PlatformController;

include '../config/Configuration.php';
use Configuration\Configuration;
use InterfaceModel\InterfaceController as Controller;
use Utilities\Utilities;
use Platform\Platform;
Configuration::controller('Platform');

class PlatformController implements Controller
{

    public static function instance(): Platform
    {
        return new Platform($_POST['nombre'], $_POST['propietario'], $_POST['website']);
    }

    public static function save()
    {
        $platform = self::instance();
        if ($platform->save())
            Utilities::messageToast("Guardado correctamente!", "success", "platform/");
        else
            Utilities::message('No se ha podido guardar la plataforma.', 'alert alert-danger');
    }

    public static function update()
    {
        $platform = self::instance();
        if ($platform->update($_POST['id']))
            Utilities::messageToast("Actualizado correctamente!", "success", "platform/");
        else
            Utilities::message('No se ha podido actualizar la plataforma.', 'alert alert-danger');
    }

    public static function destroy()
    {
        if (Platform::unSetEnviroment($_POST['id']))
            echo Platform::delete($_POST['id']);
        else
            echo "false";
    }

    public static function table()
    {
        $res = Platform::search($_POST['search']);
        $count = $res->rowCount();
        echo $count;
        require_once "../views/platform/row.php";
    }
}
$function = (string)$_POST['func'];
PlatformController::$function();