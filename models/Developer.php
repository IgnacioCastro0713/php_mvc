<?php

namespace Developer;

use BaseGeneric\BaseModel;
use Configuration\Configuration;
use Connection\Connection as Conn;
use InterfaceModel\InterfaceModel as Model;
Configuration::model();


class Developer extends BaseModel implements Model
{
    protected $table = 'desarrollador';
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
        $this->nombre = (string)$nombre;
        $this->apaterno = (string)$apaterno;
        $this->amaterno = (string)$amaterno;
        $this->ciudad = (string)$ciudad;
        $this->estudio = (int)$estudio;
    }

    public function save()
    {
        return $this->created([
            'nombre' => $this->nombre,
            'apaterno' => $this->apaterno,
            'amaterno' => $this->amaterno,
            'ciudad' => $this->ciudad,
            'estudio_id' => $this->estudio
        ]);
    }

    public function update($id)
    {
        return $this->updated($id, [
            'nombre' => $this->nombre,
            'apaterno' => $this->apaterno,
            'amaterno' => $this->amaterno,
            'ciudad' => $this->ciudad,
            'estudio_id' => $this->estudio
        ]);
    }

    public static function delete($id)
    {
        $query = new BaseModel();
        $query->table = 'desarrollador';
        return $query->destroyed($id);
    }

    public static function search($search)
    {
        $sql = "SELECT d.id, CONCAT(d.nombre, ' ', d.apaterno, ' ', d.amaterno) 
                as nombreCompleto, d.ciudad, d.estudio_id , e.nombre 
                FROM desarrollador d INNER JOIN estudio e on d.estudio_id = e.id 
                WHERE CONCAT(d.nombre, ' ', d.apaterno, ' ', d.amaterno) LIKE '%{$search}%' 
                OR e.nombre LIKE '%{$search}%'";
        return Conn::get()->query($sql);
    }
}