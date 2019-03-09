<?php

namespace DeveloperController;

include '../config/Configuration.php';
use Configuration\Configuration;
use InterfaceModel\InterfaceController as Controller;
use Utilities\Utilities;
use Developer\Developer;
Configuration::controller('Developer');

class DeveloperController implements Controller
{

    public static function instance(): Developer
    {
        return new Developer($_POST['nombre'], $_POST['apaterno'], $_POST['amaterno'], $_POST['ciudad'], $_POST['estudio']);
    }

    public static function save()
    {
        $developer = self::instance();
        if ($developer->save())
            Utilities::messageToast("Guardado correctamente!", "success", "developer/index");
        else
            Utilities::message('No se ha podido guardar el estudio.', 'alert alert-danger');
    }

    public static function update()
    {
        $developer = self::instance();
        if ($developer->update($_POST['id']))
            Utilities::messageToast("Actualizado correctamente!", "success", "developer/index");
        else
            Utilities::message('No se ha podido actualizar el estudio.', 'alert alert-danger');
    }

    public static function destroy()
    {
        echo  Developer::delete($_POST['id']);
    }

    public static function table()
    {
        $res = Developer::search($_POST['search']);
        $count = $res->rowCount();
        echo $count;
        require_once "../views/developer/row.php";
    }
}
$function = (String)$_POST['func'];
DeveloperController::$function();