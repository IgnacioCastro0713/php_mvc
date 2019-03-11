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

    public function fillable():array
    {
        return [$this->nombre, $this->propietario, $this->sede, $this->fundacion];
    }

    public function save()
    {
        $sql = "INSERT INTO estudio (nombre, propietario, sede, fundacion) VALUES (?, ?, ?, ?)";
        return Conn::get()->prepare($sql)->execute($this->fillable());
    }

    public function update($id)
    {
        $sql = "UPDATE estudio SET nombre = ?, propietario = ?, sede = ?, fundacion = ? WHERE id = {$id}";
        return Conn::get()->prepare($sql)->execute($this->fillable());
    }

    public static function delete($id)
    {
        $sql = "DELETE FROM estudio WHERE id = ?";
        return Conn::get()->prepare($sql)->execute([$id]);
    }

    public static function search($search)
    {
        $sql = "SELECT * FROM estudio WHERE nombre LIKE '%{$search}%' OR propietario LIKE '%{$search}%'
                OR sede LIKE '%{$search}%'";
        return Conn::get()->query($sql);
    }

    public static function unSetDevelopers($id)
    {
        $sql = "SELECT * FROM desarrollador WHERE estudio_id = {$id}";
        if (Conn::get()->query($sql)->rowCount()) {
            $sql = "DELETE FROM desarrollador WHERE estudio_id = ?";
            return Conn::get()->prepare($sql)->execute([$id]);
        } else
            return true;
    }
}