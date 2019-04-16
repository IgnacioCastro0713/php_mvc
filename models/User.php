<?php

namespace User;

use BaseGeneric\BasicQuery;
use Configuration\Configuration;
use Connection\Connection as Conn;
use InterfaceModel\InterfaceModel as Model;
use PDOStatement;
Configuration::model();

class User extends BasicQuery implements Model
{
    protected $table = 'usuario';
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
        $this->usuario = (string)$usuario;
        $this->nombre = (string)$nombre;
        $this->apaterno = (string)$apaterno;
        $this->amaterno = (string)$amaterno;
        $this->pass = (string)md5($pass);
        $this->admin = (int)$admin;
    }

    /**
     * @return int
     */
    public function save()
    {
        return $this->created([
           'usuario' => $this->usuario,
           'pass' => $this->pass,
           'nombre' => $this->nombre,
           'apaterno' => $this->apaterno,
           'amaterno' => $this->amaterno,
           'admin' => $this->admin
        ]);
    }

    /**
     * @param $id
     * @return int
     */
    public function update($id)
    {
        return $this->updated($id, [
            'usuario' => $this->usuario,
            'pass' => $this->pass,
            'nombre' => $this->nombre,
            'apaterno' => $this->apaterno,
            'amaterno' => $this->amaterno,
            'admin' => $this->admin
        ]);
    }

    /**
     * @param $id
     * @return int
     */
    public static function delete($id)
    {
        $query = new BasicQuery();
        $query->table = 'usuario';
        return $query->destroyed($id);
    }

    /**
     * @param $search
     * @return false|PDOStatement
     */
    public static function search($search)
    {
        $query = new BasicQuery();
        $query->table = 'usuario';
        return $query->getAll($search,
            [
                'usuario',
                "CONCAT(nombre, ' ', apaterno, ' ', amaterno)"
            ],
            "id, usuario, CONCAT(nombre, ' ', apaterno, ' ', amaterno) as nombreCompleto, admin"
        );
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
        $query = new BasicQuery();
        $query->table = 'favoritos';
        return $query->unset($id, 'usuario_id');
    }
}