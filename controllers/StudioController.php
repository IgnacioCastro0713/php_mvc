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

    public static function instanceModel()
    {
        // TODO: Implement instanceModel() method.
    }

    public static function save()
    {
        // TODO: Implement save() method.
    }

    public static function update()
    {
        // TODO: Implement update() method.
    }

    public static function destroy()
    {
        // TODO: Implement destroy() method.
    }

    public static function table()
    {
        // TODO: Implement table() method.
    }
}
$function = (String)$_POST['func'];
StudioController::$function();