<?php

namespace Studio;

use Configuration\Configuration;
use Connection\Connection as Conn;
use InterfaceModel\InterfaceModel as Model;
Configuration::model();


class Studio implements Model
{

    private $nombre, $propietario, $sede, $fundacion;

    /**
     * Studio constructor.
     * @param $nombre
     * @param $propietario
     * @param $sede
     * @param $fundacion
     */
    public function __construct($nombre, $propietario, $sede, $fundacion)
    {
        $this->nombre = (String)$nombre;
        $this->propietario = (String)$propietario;
        $this->sede = (String)$sede;
        $this->fundacion = (String)$fundacion;
    }

    public function save()
    {
        $sql = "INSERT INTO estudio (nombre, propietario, sede, fundacion) 
                VALUES ('{$this->nombre}', '{$this->propietario}', '{$this->sede}', '{$this->fundacion}')";
        return Conn::instance()->exec($sql);
    }

    public function update($id)
    {
        $sql = "UPDATE estudio SET 
                nombre = '{$this->nombre}', propietario = '{$this->propietario}', sede = '{$this->sede}', fundacion = '{$this->fundacion}'
                WHERE id = {$id}";
        return Conn::instance()->exec($sql);
    }

    public static function delete($id)
    {
        $sql = "DELETE FROM estudio WHERE id = {$id}";
        return Conn::instance()->exec($sql);
    }

    public static function search($search)
    {
        $sql = "SELECT * FROM estudio WHERE nombre LIKE '%{$search}%' OR propietario LIKE '%{$search}%'
                OR sede LIKE '%{$search}%'";
        return Conn::instance()->query($sql);
    }
}