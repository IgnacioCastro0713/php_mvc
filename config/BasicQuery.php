<?php


namespace BaseGeneric;


use Connection\Connection as Conn;
use PDOStatement;

class BasicQuery
{
    /**
     * @var $table
     */
    protected $table;

    /**
     * @Función: Generar la consulta insert de manera automatica.
     * @param array $array: se envía un arreglo asociativo según la tabla a la que se insertaran los datos.
     * @return bool: retorna un verdadero o falso dependiendo el exito de la consulta insert.
     */
    public function created(array $array)
    {
        $sql_keys = '';
        $sql_values = '';
        $data =[];
        foreach ($array as $key => $value) {
            $sql_keys .= "`".addslashes($key)."`,";
            $sql_values .= "?,";
            $data[] = $value;
        }
        $sql_keys = substr($sql_keys, 0, -1);
        $sql_values = substr($sql_values, 0, -1);
        $query = "INSERT INTO {$this->table} ($sql_keys) VALUES ($sql_values)";
        return Conn::get()->prepare($query)->execute($data);
    }

    /**
     * @Función: Generar la consulta update de manera automatica.
     * @param $id: referancia al cualse le aplicará el update.
     * @param array $array: se envia un array con los datos que modificarán el registro.
     * @return bool: retorna un verdadero o false según el exito de la consulta.
     */
    public function updated($id, array $array)
    {
        $sql_set = '';
        $data = [];
        foreach ($array as $key => $value) {
            $sql_set .= "`".addslashes($key)."`=";
            $sql_set .= "?,";
            $data[] = $value;
        }
        $sql_set = substr($sql_set, 0, -1);
        $query = "UPDATE {$this->table} SET $sql_set WHERE id = {$id}";
        return Conn::get()->prepare($query)->execute($data);
    }

    /**
     * @param $id
     * @param string $reference
     * @return bool
     */
    public function destroyed($id, $reference = 'id')
    {
        return Conn::get()->prepare("DELETE FROM {$this->table} WHERE {$reference} = ?")
            ->execute([$id]);
    }

    /**
     * @param string $search
     * @param array $array
     * @param string $conditions
     * @return false|PDOStatement
     * @note: No aplicar en consultas con inner join de tablas
     */
    public function getAll(string $search = '', array $array = [], string $conditions = '*')
    {
        $sql_like = '';
        $or = "";
        $query = "SELECT {$conditions} FROM " . $this->table;
        if (count($array) != 0) {
            $query .= " WHERE ";
            foreach ($array as $value) {
                if (count($array) > 1) {
                    $or = " OR ";
                }
                $sql_like .= $value . " LIKE " . " '%{$search}%' " . $or;
            }
            $query = $query . $sql_like = substr($sql_like, 0, -1);
            $query = substr($query, 0, -2);
            return Conn::get()->query($query);
        }
        return Conn::get()->query($query);
    }

    /**
     * @Funtion: Función para borrar las relaciones de las tablas.
     * @param $id
     * @param $reference
     * @return bool
     */
    public function unset($id, $reference)
    {
        $sql = "SELECT * FROM {$this->table} WHERE {$reference} = {$id}";
        if (Conn::get()->query($sql)->rowCount()) {
            return $this->destroyed($id, $reference);
        } else
            return true;
    }

}