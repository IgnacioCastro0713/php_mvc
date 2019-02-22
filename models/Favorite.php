<?php

namespace Favorite;

use Configuration\Configuration;
use Connection\Connection as Conn;
use InterfaceModel\InterfaceModel as Model;
Configuration::model();

class Favorite implements Model
{
    private $usuario, $game;

    /**
     * Favorite constructor.
     * @param $usuario
     * @param $game
     */
    public function __construct($usuario, $game)
    {
        $this->usuario = (int)$usuario;
        $this->game = (int)$game;
    }

    /**
     * @return int
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * @return int
     */
    public function getGame()
    {
        return $this->game;
    }



    public function save()
    {
        $sql = "INSERT INTO favoritos(usuario_id, juego_id) VALUES ({$this->getUsuario()}, {$this->getGame()})";
        return Conn::get()->exec($sql);
    }

    public function update($id)
    {

    }

    public static function delete($id)
    {
        $sql = "DELETE FROM favoritos where usuario_id = {$_SESSION['id']} AND juego_id = {$id}";
        return Conn::get()->exec($sql);

    }

    public static function search($search)
    {
        // TODO: Implement search() method.
    }
}