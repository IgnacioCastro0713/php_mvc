<?php
namespace User; // TODO : Change according to the class.

include '../config/Connection.php'; // TODO: Required, doesn't change.
include '../config/InterfaceModel.php'; // TODO: Required, doesn't change.

use Connection\Connection as Conn; // TODO: Required, doesn't change.
use InterfaceModel\InterfaceModel as Model; // TODO: Required, doesn't change.

class User implements Model
{
    private $usuario, $nombre, $apaterno, $amaterno, $pass;
    /**
     * User constructor.
     * @param $usuario
     * @param $nombre
     * @param $apaterno
     * @param $amaterno
     * @param $pass
     */
    public function __construct($usuario, $nombre, $apaterno, $amaterno, $pass)
    {
        $this->usuario = (String)$usuario;
        $this->nombre = (String)$nombre;
        $this->apaterno = (String)$apaterno;
        $this->amaterno = (String)$amaterno;
        $this->pass = (String) md5($pass);
    }

    public function save()
    {
        $sql = "INSERT INTO usuarios (usuario, pass, nombre, apaterno, amaterno) 
                VALUES ('{$this->usuario}', '{$this->pass}', '{$this->nombre}', '{$this->apaterno}', '{$this->amaterno}')";
        return Conn::instance()->exec($sql);
    }

    public function update($id)
    {

    }

    public static function delete($id)
    {

    }

    public static function search($search)
    {
        $sql = "SELECT id, usuario, CONCAT(nombre, ' ', apaterno, ' ', amaterno) as nombreCompleto 
                FROM usuarios WHERE usuario LIKE '%{$search}%' OR CONCAT(nombre, ' ', apaterno, ' ', amaterno) 
                LIKE '%{$search}%'";
        return Conn::instance()->query($sql);
    }

    public static function getById($id)
    {

    }

    public function find()
    {
        $sql = "SELECT * FROM usuarios WHERE usuario = '{$this->usuario}'";
        return Conn::instance()->query($sql)->rowCount();
    }
}