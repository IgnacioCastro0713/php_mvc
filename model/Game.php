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
        $this->nombre = $nombre;
        $this->genero = $genero;
        $this->descripcion = $descripcion;
        $this->lanzamiento = $lanzamiento;
        $this->estudio = $estudio;
    }


    public function save()
    {
        $sql = "INSERT INTO juego (nombre, genero, descripcion, lanzamiento, estudio_id) 
                VALUES ('{$this->nombre}', '{$this->genero}', '{$this->descripcion}', '{$this->lanzamiento}', '{$this->estudio}')";
        $res = Conn::instance()->exec($sql);
        $this->id = Conn::instance()->lastInsertId();
        return $res;
    }

    public function update($id)
    {
        // TODO: Implement update() method.
    }

    public static function delete($id)
    {
        // TODO: Implement delete() method.
    }

    public static function search($search)
    {
        // TODO: Implement search() method.
    }

    public function setPlatform($platform)
    {
        $sql = "SELECT * FROM entorno WHERE juego_id = '{$this->id}' AND plataforma_id = '{$platform}'";
        if (!Conn::instance() -> query($sql) -> rowCount()) {
            $sql = "INSERT INTO entorno (plataforma_id, juego_id) VALUES ('{$platform}', '{$this->id}')";
            return Conn::instance()->exec($sql);
        } else
            return true;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }


}