<?php
namespace User; // TODO : Change according to the class.
use Configuration\Configuration; // TODO: Required, doesn't change.
use Connection\Connection as Conn; // TODO: Required, doesn't change.
use InterfaceModel\InterfaceModel as Model; // TODO: Required, doesn't change.
Configuration::model();// TODO: Required, doesn't change.

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
        $this->pass = (String)md5($pass);
    }

    /**
     * @return int
     */
    public function save()
    {
        $sql = "INSERT INTO usuario (usuario, pass, nombre, apaterno, amaterno) 
                VALUES ('{$this->usuario}', '{$this->pass}', '{$this->nombre}', '{$this->apaterno}', '{$this->amaterno}')";
        return Conn::instance()->exec($sql);
    }

    /**
     * @param $id
     * @return int
     */
    public function update($id)
    {
        $sql = "UPDATE usuario SET nombre = '{$this->nombre}', apaterno = '{$this->apaterno}', amaterno = '{$this->amaterno}', 
                usuario = '{$this->usuario}', pass = '{$this->pass}'
                WHERE id = '{$id}'";
        return Conn::instance()->exec($sql);
    }

    /**
     * @param $id
     * @return int
     */
    public static function delete($id)
    {
        $sql = "DELETE FROM usuario WHERE id = {$id}";
        return Conn::instance()->exec($sql);
    }

    /**
     * TODO: Function to search a record, change the query according to the table.
     * @param $search
     * @return false|\PDOStatement
     */
    public static function search($search)
    {
        $sql = "SELECT id, usuario, CONCAT(nombre, ' ', apaterno, ' ', amaterno) as nombreCompleto 
                FROM usuario WHERE usuario LIKE '%{$search}%' OR CONCAT(nombre, ' ', apaterno, ' ', amaterno) 
                LIKE '%{$search}%'";
        return Conn::instance()->query($sql);
    }

    public function find()
    {
        $sql = "SELECT * FROM usuario WHERE usuario = '{$this->usuario}'";
        return Conn::instance()->query($sql)->rowCount();
    }

    public function comparePassword($pass_conf)
    {
        return $this->pass == md5($pass_conf);
    }

}