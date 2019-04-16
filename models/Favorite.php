<?php

namespace Favorite;

use BaseGeneric\BasicQuery;
use Configuration\Configuration;
use Connection\Connection as Conn;
use InterfaceModel\InterfaceModel as Model;
Configuration::model();

class Favorite extends BasicQuery implements Model
{
    protected $table = 'favoritos';
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


    public function save()
    {
        return $this->created([
            'usuario_id' => $this->getUsuario(),
            'juego_id' => $this->getGame()
        ]);
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
                j.id AS id_juego, 
                e.id AS id_estudio,
                j.nombre AS juego,
                j.descripcion,
                e.nombre AS estudio
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

    public static function getDeveloper($id_estudio): array
    {
        $sql = "SELECT d.ciudad, CONCAT(d.nombre,' ', d.apaterno, ' ', d.amaterno) AS nombreCompleto 
                FROM estudio e 
                INNER JOIN desarrollador d on e.id = d.estudio_id 
                WHERE e.id = {$id_estudio}";
        $developers = Conn::get()->query($sql)->fetchAll(\PDO::FETCH_OBJ);
        $data = array("name" => "", "city" => "");
        foreach ($developers as $developer) {
            $data['name'] .= $developer->nombreCompleto."<br>";
            $data['city'] .= $developer->ciudad."<br>";
        }
        return $data;
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
}