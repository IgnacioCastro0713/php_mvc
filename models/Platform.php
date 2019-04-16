<?php

namespace Platform;


use BaseGeneric\BasicQuery;
use Configuration\Configuration;
use InterfaceModel\InterfaceModel as Model;
Configuration::model();

class Platform extends BasicQuery implements Model
{
    protected $table = 'plataforma';
    private $nombre, $propietario, $website;

    /**
     * Platform constructor.
     * @param $nombre
     * @param $propietario
     * @param $website
     */
    public function __construct($nombre, $propietario, $website)
    {
        $this->nombre = (string)$nombre;
        $this->propietario = (string)$propietario;
        $this->website = (string)$website;
    }

    public function save()
    {
        return $this->created([
            'nombre' => $this->nombre,
            'propietario' => $this->propietario,
            'website' => $this->website
        ]);
    }

    public function update($id)
    {
        return $this->updated($id, [
            'nombre' => $this->nombre,
            'propietario' => $this->propietario,
            'website' => $this->website
        ]);
    }

    public static function delete($id)
    {
        $query = new BasicQuery();
        $query->table = 'plataforma';
        return $query->destroyed($id);
    }

    public static function search($search)
    {
        $query = new BasicQuery();
        $query->table = 'plataforma';
        return $query->getAll($search, ['nombre', 'propietario']);
    }

    public static function unSetEnviroment($id)
    {
        $query = new BasicQuery();
        $query->table = 'entorno';
        return $query->unset($id, 'plataforma_id');
    }
}