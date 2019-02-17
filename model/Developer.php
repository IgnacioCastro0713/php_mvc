<?php
/**
 * Created by IntelliJ IDEA.
 * User: ignac
 * Date: 10/02/2019
 * Time: 01:58 PM
 */

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


    public function save()
    {
        $sql = "INSERT INTO desarrollador(nombre, apaterno, amaterno, ciudad, estudio_id) 
                VALUES ('{$this->nombre}', '{$this->apaterno}', '{$this->amaterno}', '{$this->ciudad}', '{$this->estudio}')";
        return Conn::instance()->exec($sql);
    }

    public function update($id)
    {
        $sql = "UPDATE desarrollador SET nombre = '{$this->nombre}', apaterno = '{$this->apaterno}', amaterno = '{$this->amaterno}',
                ciudad = '{$this->ciudad}', estudio_id = '{$this->estudio}'
                WHERE id = {$id}";
        return Conn::instance()->exec($sql);
    }

    public static function delete($id)
    {
        $sql = "DELETE FROM desarrollador WHERE id = {$id}";
        return Conn::instance()->exec($sql);
    }

    public static function search($search)
    {
        $sql = "SELECT d.id, CONCAT(d.nombre, ' ', d.apaterno, ' ', d.amaterno) as nombreCompleto, d.ciudad, d.estudio_id , e.nombre 
                FROM desarrollador d INNER JOIN estudio e on d.estudio_id = e.id 
                WHERE CONCAT(d.nombre, ' ', d.apaterno, ' ', d.amaterno) LIKE '%{$search}%' OR 
                e.nombre LIKE '%{$search}%'";
        return Conn::instance()->query($sql);
    }
}