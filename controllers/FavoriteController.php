<?php

namespace FavoriteController;

include '../config/Configuration.php';
use Configuration\Configuration;
use InterfaceModel\InterfaceController as Controller;
use Utilities\Utilities;
use Favorite\Favorite;
Configuration::controller('Favorite');

class FavoriteController implements Controller
{

    public static function instance()
    {
        // TODO: Implement instance() method.
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

    public static function setFavorite() {
        session_start();
        $favorite = new Favorite($_POST['id'], $_SESSION['id']);
        if ($favorite -> save())
            echo "setted";
        else
            echo "failed";
    }

    public static function unsetFavorite() {
        session_start();
        $favorite = new Favorite($_POST['id'], $_SESSION['id']);
        if ($favorite -> delete($_POST['id']))
            echo "unsetted";
        else
            echo "failed";
    }
}
$function = (String)$_POST['func'];
FavoriteController::$function();