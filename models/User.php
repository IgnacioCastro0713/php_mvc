<?php
namespace User; // TODO : Change according to the class.
use Configuration\Configuration; // TODO: Required, doesn't change.
use Connection\Connection as Conn; // TODO: Required, doesn't change.
use InterfaceModel\InterfaceModel as Model; // TODO: Required, doesn't change.
Configuration::model();// TODO: Required, doesn't change.

class User implements Model
{
    private $usuario, $nombre, $apaterno, $amaterno, $pass, $admin;
    /**
     * User constructor.
     * @param $usuario
     * @param $nombre
     * @param $apaterno
     * @param $amaterno
     * @param $pass
     * @param $admin
     */
    public function __construct($usuario, $nombre, $apaterno, $amaterno, $pass, $admin)
    {
        $this->usuario = (String)$usuario;
        $this->nombre = (String)$nombre;
        $this->apaterno = (String)$apaterno;
        $this->amaterno = (String)$amaterno;
        $this->pass = (String)md5($pass);
        $this->admin = (int)$admin;
    }

    /**
     * @return array
     */
    public function fillable():array
    {
        return [$this->usuario, $this->pass, $this->nombre, $this->apaterno, $this->amaterno, $this->admin];
    }

    /**
     * @return int
     */
    public function save()
    {
        $sql = "INSERT INTO usuario (usuario, pass, nombre, apaterno, amaterno, admin) VALUES (?, ?, ?, ?, ?, ?)";
        return Conn::get()->prepare($sql)->execute($this->fillable());
    }

    /**
     * @param $id
     * @return int
     */
    public function update($id)
    {
        $sql = "UPDATE usuario SET usuario = ?, pass = ?, nombre = ?, apaterno = ?, amaterno = ?, admin = ? WHERE id = {$id}";
        return Conn::get()->prepare($sql)->execute($this->fillable());
    }

    /**
     * @param $id
     * @return int
     */
    public static function delete($id)
    {
        $sql = "DELETE FROM usuario WHERE id = ?";
        return Conn::get()->prepare($sql)->execute([$id]);
    }

    /**
     * TODO: Function to search a record, change the query according to the table.
     * @param $search
     * @return false|\PDOStatement
     */
    public static function search($search)
    {
        $sql = "SELECT id, usuario, CONCAT(nombre, ' ', apaterno, ' ', amaterno) as nombreCompleto, admin 
                FROM usuario WHERE usuario LIKE '%{$search}%' OR CONCAT(nombre, ' ', apaterno, ' ', amaterno) 
                LIKE '%{$search}%'";
        return Conn::get()->query($sql);
    }

    public function find()
    {
        $sql = "SELECT * FROM usuario WHERE usuario = '{$this->usuario}'";
        return Conn::get()->query($sql)->rowCount();
    }

    public function comparePassword($pass_conf)
    {
        return $this->pass == md5($pass_conf);
    }

    public static function unSetFavorite($id)
    {
        $sql = "SELECT * FROM favoritos WHERE usuario_id = {$id}";
        if (Conn::get()->query($sql)->rowCount()) {
            $sql = "DELETE FROM favoritos WHERE usuario_id = ?";
            return Conn::get()->prepare($sql)->execute([$id]);
        } else
            return true;
    }
}