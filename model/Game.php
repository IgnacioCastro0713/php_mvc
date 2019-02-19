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
        $response = Conn::instance()->exec($sql);
        $this->setId(Conn::instance()->lastInsertId());
        return $response;
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
        $sql = "SELECT * FROM juego j INNER JOIN entorno e on j.id = e.juego_id INNER JOIN estudio e2 on j.estudio_id = e2.id
                INNER JOIN desarrollador d on e2.id = d.estudio_id INNER JOIN plataforma p on e.plataforma_id = p.id
                WHERE j.nombre LIKE '{$search}' OR j.genero LIKE '{$search}' OR e2.nombre LIKE '{$search}'";
        return Conn::instance()->query($sql);
    }

    public function setPlatform($platform)
    {
        $sql = "SELECT * FROM entorno WHERE juego_id = '{$this->getId()}' AND plataforma_id = '{$platform}'";
        if (!Conn::instance() -> query($sql) -> rowCount()) {
            $sql = "INSERT INTO entorno (plataforma_id, juego_id) VALUES ('{$platform}', '{$this->getId()}')";
            return Conn::instance()->exec($sql);
        } else
            return true;
    }

    public function unSetPlatform()
    {

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