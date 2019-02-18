<?php

namespace GameController;

include '../config/Configuration.php';
use Configuration\Configuration;
use InterfaceModel\InterfaceController as Controller;
use Utilities\Utilities;
use Game\Game;
Configuration::controller('Game');

class GameController implements Controller
{

    public static function instance()
    {
        return new Game($_POST['nombre'], $_POST['genero'], $_POST['descripcion'], $_POST['lanzamiento'], $_POST['estudio']);
    }

    public static function save()
    {
        $continue = true;
        $game = self::instance();
        if ($game->save()) {
            foreach ($_POST['plataformas'] as $platform) {
                if (!$game->setPlatform($platform)) {
                    $continue = false;
                    Utilities::message('No se ha podido relacionar el autor: ' . $platform, 'alert alert-danger');
                }
            }
            if ($continue)
                Utilities::messageToast('Guardado correctamente','success', 'game/index.php');
        } else
            Utilities::message('No se ha podido guardar el juego', 'alert alert-danger');
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
GameController::$function();