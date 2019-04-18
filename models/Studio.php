<?php

namespace Studio;

use BaseGeneric\BaseModel;
use Configuration\Configuration;
use InterfaceModel\InterfaceModel as Model;
Configuration::model();


class Studio extends BaseModel implements Model
{
    protected $table = 'estudio';
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
        $this->nombre = (string)$nombre;
        $this->propietario = (string)$propietario;
        $this->sede = (string)$sede;
        $this->fundacion = (string)$fundacion;
    }

    public function save()
    {
        return $this->created([
            'nombre' => $this->nombre,
            'propietario' => $this->propietario,
            'sede' => $this->sede,
            'fundacion' => $this->fundacion
        ]);
    }

    public function update($id)
    {
        return $this->updated($id, [
            'nombre' => $this->nombre,
            'propietario' => $this->propietario,
            'sede' => $this->sede,
            'fundacion' => $this->fundacion
        ]);
    }

    public static function delete($id)
    {
        $query = new BaseModel();
        $query->table = 'estudio';
        return $query->destroyed($id);
    }

    public static function search($search)
    {
        $query = new BaseModel();
        $query->table = 'estudio';
        return $query->getAll($search, ['nombre', 'propietario']);
    }

    public static function unSetDevelopers($id)
    {
        $query = new BaseModel();
        $query->table = 'desarrollador';
        return $query->unset($id, 'estudio_id');
    }
}