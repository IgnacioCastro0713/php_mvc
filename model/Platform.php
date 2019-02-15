<?php

namespace Platform;
use Configuration\Configuration;
use Connection\Connection as Conn;
use InterfaceModel\InterfaceModel as Model;
Configuration::model();

class Platform implements Model
{
    private $nombre, $propietario, $website;

    /**
     * Platform constructor.
     * @param $nombre
     * @param $propietario
     * @param $website
     */
    public function __construct($nombre, $propietario, $website)
    {
        $this->nombre = (String)$nombre;
        $this->propietario = (String)$propietario;
        $this->website = (String)$website;
    }

    public function save()
    {
        $sql = "INSERT INTO plataforma (nombre, propietario, website) 
                VALUES ('{$this->nombre}', '{$this->propietario}', '{$this->website}')";
        return Conn::instance()->exec($sql);
    }

    public function update($id)
    {
        $sql = "UPDATE plataforma SET nombre = '{$this->nombre}', propietario = '{$this->propietario}', website = '{$this->website}'
                WHERE id = {$id}";
        return Conn::instance()->exec($sql);
    }

    public static function delete($id)
    {
        $sql = "DELETE FROM plataforma WHERE id = {$id}";
        return Conn::instance()->exec($sql);
    }

    public static function search($search)
    {
        $sql = "SELECT id, nombre, propietario, website 
                FROM plataforma WHERE nombre 
                LIKE '%{$search}%' OR  propietario LIKE '%{$search}%'";
        return Conn::instance()->query($sql);
    }
}