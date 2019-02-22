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
        return Conn::instance()->exec($sql);
    }

    public function update($id)
    {

    }

    public static function delete($id)
    {
        $sql = "DELETE FROM favoritos where usuario_id = {$_SESSION['id']} AND juego_id = {$id}";
        return Conn::instance()->exec($sql);

    }

    public static function search($search)
    {
        // TODO: Implement search() method.
    }

    public static function deleteByGameId($id)
    {
        $sql = "SELECT * FROM favoritos WHERE juego_id = {$id}";
        if (Conn::instance()->query($sql)->rowCount()) {
            $sql = "DELETE FROM favoritos WHERE juego_id = {$id}";
            return Conn::instance()->exec($sql);
        } else
            return true;
    }

    public function isFavorite()
    {
        $sql = "SELECT * FROM favoritos WHERE juego_id = {$this->getGame()} AND usuario_id = {$this->getUsuario()}";
        return Conn::instance()->query($sql)->rowCount();
    }
}