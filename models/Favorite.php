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

    public function fillable():array
    {
        return [$this->getUsuario(), $this->getGame()];
    }

    public function save()
    {
        $sql = "INSERT INTO favoritos(usuario_id, juego_id) VALUES (?, ?)";
        return Conn::get()->prepare($sql)->execute($this->fillable());
    }

    public function update($id)
    {

    }

    public static function delete($id)
    {
        $sql = "DELETE FROM favoritos where usuario_id = ? AND juego_id = ?";
        return Conn::get()->prepare($sql)->execute([$_SESSION['id'], $id]);

    }

    public static function search($search)
    {
        session_start();
        $sql = "SELECT * FROM juego j 
                INNER JOIN favoritos f ON j.id = f.juego_id 
                WHERE f.usuario_id = {$_SESSION['id']} AND j.nombre 
                LIKE '%{$search}%'";
        return Conn::get()->query($sql);
    }

    public static function getDetail($id)
    {
        $sql = "SELECT *,
                j.nombre AS juego,
                e.nombre AS estudio,
                d.nombre AS desarrollador,
                p.nombre AS plataforma
                FROM juego j 
                INNER JOIN estudio e on j.estudio_id = e.id
                INNER JOIN desarrollador d on e.id = d.estudio_id
                INNER JOIN entorno en on j.id = en.juego_id
                INNER JOIN plataforma p on en.plataforma_id = p.id
                WHERE j.id = {$id}";
        return Conn::get()->query($sql);
    }

    public static function getPlatforms($id_plataforma, $text)
    {
        $sql = "SELECT p.nombre FROM entorno e INNER JOIN plataforma p on e.plataforma_id = p.id WHERE juego_id = {$id_plataforma}";
        $platforms = Conn::get()->query($sql)->fetchAll(\PDO::FETCH_OBJ);
        if ($text){
            $response = "";
            foreach ($platforms as $platform) {
                $response.= $platform->nombre."<br>";
            }
            return $response;
        } else
            return $platforms;
    }

    public static function getDevelopers($id_estudio)
    {
        $sql = "SELECT *, CONCAT(d.nombre, d.apaterno, d.amaterno) AS nombreCompleto 
                FROM estudio e 
                INNER JOIN desarrollador d on e.id = d.estudio_id 
                WHERE e.id = $id_estudio}";
        $developers = Conn::get()->query($sql)->fetchAll(\PDO::FETCH_OBJ);
        $data = array("name" => "", "city" => "");
        foreach ($developers as $developer) {
            $data['name'] .= $developer->nombreCompleto."<br>";
            $data['city'] .= $developer->ciudad."<br>";
        }
        return $data;
    }
}