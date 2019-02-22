<?php

namespace Game;

use Configuration\Configuration;
use Connection\Connection as Conn;
use InterfaceModel\InterfaceModel as Model;
Configuration::model();


class Game implements Model
{
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
        $this->nombre = (String)$nombre;
        $this->genero = (String)$genero;
        $this->descripcion = (String)$descripcion;
        $this->lanzamiento = (String)$lanzamiento;
        $this->estudio = (int)$estudio;
    }


    public function save()
    {
        $sql = "INSERT INTO juego (nombre, genero, descripcion, lanzamiento, estudio_id) 
                VALUES ('{$this->nombre}', '{$this->genero}', '{$this->descripcion}', '{$this->lanzamiento}', '{$this->estudio}')";
        $response = Conn::instance()->exec($sql);
        $this->setId(Conn::instance()->lastInsertId());
        return $response;
    }

    public function update($id)
    {
        $sql = "UPDATE juego SET nombre = '{$this->nombre}', genero = '{$this->genero}', descripcion = '{$this->descripcion}', 
                 lanzamiento = '{$this->lanzamiento}', estudio_id = {$this->estudio} WHERE id = {$id}";
        return Conn::instance()->exec($sql);
    }

    public static function delete($id)
    {
        $sql = "DELETE FROM juego WHERE id = {$id}";
        return Conn::instance()->exec($sql);
    }

    public static function search($search)
    {
        $sql = "SELECT j.*, e.nombre AS estudio FROM juego j INNER JOIN estudio e on j.estudio_id = e.id
                WHERE j.nombre LIKE '%{$search}%' OR j.genero LIKE '%{$search}%'";
        return Conn::instance()->query($sql);
    }

    /**
     * @función: Agrega las relaciones relaciones de la tabla intermedia.
     * @param $platform
     * @return bool|int
     */
    public function setPlatform($platform)
    {
        $sql = "SELECT * FROM entorno WHERE juego_id = '{$this->getId()}' AND plataforma_id = '{$platform}'";
        if (!Conn::instance() -> query($sql) -> rowCount()){
            $sql = "INSERT INTO entorno (plataforma_id, juego_id) VALUES ('{$platform}', '{$this->getId()}')";
            return Conn::instance()->exec($sql);
        } else
            return true;
    }

    /**
     * @función: Elimina las relaciones anterioemente viculadas y agrega las nuevas.
     * @param $id
     * @return bool|int
     */
    public static function unSetPlatform($id)
    {
        $sql = "SELECT * FROM entorno WHERE juego_id = {$id}";
        if (Conn::instance()->query($sql)->rowCount()){
            $sql = "DELETE FROM entorno WHERE juego_id = {$id}";
            return Conn::instance()->exec($sql);
        } else
            return true;

    }

    /**
     * @función Obtiene las plataformas vinculadas al videojuego.
     * @param $id
     * @param $text
     * @return array|string
     */
    public static function getPlatform($id, $text)
    {
        $sql = "SELECT p.nombre FROM entorno e INNER JOIN plataforma p on e.plataforma_id = p.id WHERE juego_id = {$id}";
        $platforms = Conn::instance()->query($sql)->fetchAll();
        if ($text){
            $response = "";
            foreach ($platforms as $platform){
                $response.= $platform['nombre']."<br>";
            }
            return $response;
        }else
            return $platforms;
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