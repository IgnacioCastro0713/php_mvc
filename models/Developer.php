<?php
namespace Developer;

use Configuration\Configuration;
use Connection\Connection as Conn;
use InterfaceModel\InterfaceModel as Model;
Configuration::model();


class Developer implements Model
{
    private $nombre, $apaterno, $amaterno, $ciudad, $estudio;
    /**
     * Developer constructor.
     * @param $nombre
     * @param $apaterno
     * @param $amaterno
     * @param $ciudad
     * @param $estudio
     */
    public function __construct($nombre, $apaterno, $amaterno, $ciudad, $estudio)
    {
        $this->nombre = (String)$nombre;
        $this->apaterno = (String)$apaterno;
        $this->amaterno = (String)$amaterno;
        $this->ciudad = (String)$ciudad;
        $this->estudio = (int)$estudio;
    }

    public function fillable():array
    {
        return [$this->nombre, $this->apaterno, $this->amaterno, $this->ciudad, $this->estudio];
    }

    public function save()
    {
        $sql = "INSERT INTO desarrollador(nombre, apaterno, amaterno, ciudad, estudio_id) VALUES (?, ?, ?, ?, ?)";
        return Conn::get()->prepare($sql)->execute($this->fillable());
    }

    public function update($id)
    {
        $sql = "UPDATE desarrollador SET nombre = ?, apaterno = ?, amaterno = ?, ciudad = ?, estudio_id = ? WHERE id = {$id}";
        return Conn::get()->prepare($sql)->execute($this->fillable());
    }

    public static function delete($id)
    {
        $sql = "DELETE FROM desarrollador WHERE id = ?";
        return Conn::get()->prepare($sql)->execute([$id]);
    }

    public static function search($search)
    {
        $sql = "SELECT d.id, CONCAT(d.nombre, ' ', d.apaterno, ' ', d.amaterno) as nombreCompleto, d.ciudad, d.estudio_id , e.nombre 
                FROM desarrollador d INNER JOIN estudio e on d.estudio_id = e.id 
                WHERE CONCAT(d.nombre, ' ', d.apaterno, ' ', d.amaterno) LIKE '%{$search}%' 
                OR e.nombre LIKE '%{$search}%'";
        return Conn::get()->query($sql);
    }
}