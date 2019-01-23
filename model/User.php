<?php
namespace User; // TODO : Change according to the class.

include 'Connection.php'; // TODO: Required, doesn't change.
include'InterfaceModel.php'; // TODO: Required, doesn't change.

use Connection as Conn; // TODO: Required, doesn't change.
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

    public function delete($id)
    {
    }

    public function getAll()
    {
    }

    public function getById($id)
    {
    }
}