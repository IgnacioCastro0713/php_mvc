<?php

namespace FavoriteController;

include '../config/Configuration.php';
use Configuration\Configuration;
use InterfaceModel\InterfaceController as Controller;
use Favorite\Favorite;
Configuration::controller('Favorite');

class FavoriteController implements Controller
{

    public static function instance(): Favorite
    {
        session_start();
        return new Favorite($_SESSION['id'], $_POST['id']);
    }

    public static function save()
    {
        $favorite = self::instance();
        echo $favorite->save() ? "setted" : "failed";
    }

    public static function update()
    {
        // TODO: Implement update() method.
    }

    public static function destroy()
    {
        $favorite = self::instance();
        echo $favorite->delete($_POST['id']) ? "unsetted" : "failed";
    }

    public static function table()
    {
        // TODO: Implement table() method.
    }
}
$function = (String)$_POST['func'];
FavoriteController::$function();