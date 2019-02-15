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

    public static function instance()
    {
        return new Platform($_POST['nombre'], $_POST['propietario'], $_POST['website']);
    }

    public static function save()
    {
        $platform = self::instance();
        if ($platform->save())
            Utilities::messageToast("Guardado correctamente", "success", "platform/index.php");
        else
            Utilities::message('No se ha podido guardar el usuario.', 'alert alert-danger');
    }

    public static function update()
    {
        $platform = self::instance();
        if ($platform->update($_POST['id']))
            Utilities::messageToast("Actualizado correctamente!", "success", "platform/index.php");
        else
            Utilities::message('No se ha podido guardar el usuario.', 'alert alert-danger');
    }

    public static function destroy()
    {
        echo  Platform::delete($_POST['id']);
    }

    public static function table()
    {
        $res = Platform::search($_POST['search']);
        $count = $res->rowCount();
        echo $count;
        require_once "../views/platform/row.php";
    }
}
$function = (String)$_POST['func'];
PlatformController::$function();