<?php

namespace Game;

use BaseGeneric\BaseModel;
use Configuration\Configuration;
use Connection\Connection as Conn;
use InterfaceModel\InterfaceModel as Model;
Configuration::model();


class Game extends BaseModel implements Model
{
    protected $table = 'juego';
    private $nombre, $genero, $descripcion, $lanzamiento, $estudio, $id;

    /**
     * Game constructor.
     * @param $nombre
     * @param $genero
     * @param $descripcion
     * @param $lanzamiento
     * @param $estudio
     */
    public function __construct($nombre, $genero, $descripcion, $lanzamiento, $estudio)
    {
        $this->nombre = (string)$nombre;
        $this->genero = (string)$genero;
        $this->descripcion = (string)$descripcion;
        $this->lanzamiento = (string)$lanzamiento;
        $this->estudio = (int)$estudio;
    }

    public function save()
    {
        $response = $this->created([
            'nombre' => $this->nombre,
            'genero' => $this->genero,
            'descripcion' => $this->descripcion,
            'lanzamiento' => $this->lanzamiento,
            'estudio_id' => $this->estudio
        ]);
        $this->setId(Conn::get()->lastInsertId());
        return $response;
    }

    public function update($id)
    {
        return $this->updated($id, [
            'nombre' => $this->nombre,
            'genero' => $this->genero,
            'descripcion' => $this->descripcion,
            'lanzamiento' => $this->lanzamiento,
            'estudio_id' => $this->estudio
        ]);
    }

    public static function delete($id)
    {
        $query = new BaseModel();
        $query->table = 'juego';
        return $query->destroyed($id);
    }

    public static function search($search)
    {
        $sql = "SELECT j.*, e.nombre AS estudio FROM juego j INNER JOIN estudio e on j.estudio_id = e.id
                WHERE j.nombre LIKE '%{$search}%' OR j.genero LIKE '%{$search}%'";
        return Conn::get()->query($sql);
    }

    /**
     * @description Obtiene las plataformas vinculadas al videojuego.
     * @param $id
     * @param $text
     * @return array|string
     */
    public static function getPlatforms($id, $text)
    {
        $sql = "SELECT p.nombre FROM entorno e INNER JOIN plataforma p on e.plataforma_id = p.id WHERE juego_id = {$id}";
        $platforms = Conn::get()->query($sql)->fetchAll(\PDO::FETCH_OBJ);
        if ($text){
            $response = "";
            foreach ($platforms as $platform){
                $response.= $platform->nombre."<br>";
            }
            return $response;
        } else
            return $platforms;
    }

    /**
     * @description: Agrega las relaciones relaciones de la tabla intermedia 'entorno'.
     * @param $platform
     * @return bool
     */
    public function setEnvironment($platform)
    {
        $sql = "SELECT * FROM entorno WHERE juego_id = '{$this->getId()}' AND plataforma_id = '{$platform}'";
        if (!Conn::get()->query($sql)->rowCount()) {
            $sql = "INSERT INTO entorno (plataforma_id, juego_id) VALUES (?, ?)";
            return Conn::get()->prepare($sql)->execute([$platform, $this->getId()]);
        } else
            return true;
    }

    /**
     * @description: Elimina las relaciones anteriormente viculadas y agrega las nuevas.
     * @param $id
     * @return bool
     */
    public static function unSetEnvironment($id)
    {
        $query = new BaseModel();
        $query->table = 'entorno';
        return $query->unset($id, 'juego_id');
    }

    /**
     * @description valida si es favorito
     * @param $game
     * @param $user
     * @return int
     */
    public static function isFavorite($game, $user)
    {
        $sql = "SELECT * FROM favoritos WHERE juego_id = {$game} AND usuario_id = {$user}";
        return Conn::get()->query($sql)->rowCount();
    }

    /**
     * @description elimina las relaciones con los usuario en caso de que se elimine el registro
     * @param $id
     * @return bool|int
     */
    public static function unSetFavorite($id)
    {
        $query = new BaseModel();
        $query->table = 'favoritos';
        return $query->unset($id, 'juego_id');
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
}