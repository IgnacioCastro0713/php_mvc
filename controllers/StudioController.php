<?php

namespace StudioController;

include '../config/Configuration.php';
use Configuration\Configuration;
use InterfaceModel\InterfaceController as Controller;
use Utilities\Utilities;
use Studio\Studio;
Configuration::controller('Studio');


class StudioController implements Controller
{

    public static function instance()
    {
        return new Studio($_POST['nombre'], $_POST['propietario'], $_POST['sede'], $_POST['fundacion']);
    }

    public static function save()
    {
        $studio = self::instance();
        if ($studio->save())
            Utilities::messageToast("Guardado correctamente!", "success", "studio/index.php");
        else
            Utilities::message('No se ha podido guardar el estudio.', 'alert alert-danger');
    }

    public static function update()
    {
        $studio = self::instance();
        if ($studio->update($_POST['id']))
            Utilities::messageToast("Actualizado correctamente!", "success", "studio/index.php");
        else
            Utilities::message('No se ha podido actualizar el estudio.', 'alert alert-danger');
    }

    public static function destroy()
    {
        echo Studio::delete($_POST['id']);
    }

    public static function table()
    {
        $res = Studio::search($_POST['search']);
        $count = $res->rowCount();
        echo $count;
        require_once "../views/studio/row.php";
    }
}
$function = (String)$_POST['func'];
StudioController::$function();