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
        $game = self::instance();
        $continue = true;
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
        $game = self::instance();
        $continue = true;
        if ($game->update($_POST['id'])){
            if ($game->unSetPlatform($_POST['id'])){
                $game->setId($_POST['id']);
                foreach ($_POST['plataformas'] as $platform){
                    if (!$game->setPlatform($platform)) {
                        $continue = false;
                        Utilities::message('No se ha podido relacionar el autor: ' . $platform, 'alert alert-danger');
                    }
                }
                if ($continue)
                    Utilities::messageToast('Guardado correctamente','success', 'game/index.php');
            } else
                Utilities::message('No se ha podido eliminar las relaciones de autor', 'alert alert-danger');
        } else
            Utilities::message('No se ha podido guardar la canción o no se han realizado cambios.', 'alert alert-danger');
    }

    public static function destroy()
    {
        echo Game::delete($_POST['id']);
    }

    public static function table()
    {
        $res = Game::search($_POST['search']);
        $count = $res->rowCount();
        echo $count;
        require_once "../views/game/row.php";
    }
}
$function = (String)$_POST['func'];
GameController::$function();