<?php


namespace BaseGeneric;


use Connection\Connection as Conn;
use PDOStatement;


/**
 * Class BaseModel
 * @package BaseGeneric
 * @copyright: DinaDev's team 🧨.
 * @author: José Ignacio menchaca Castro.
 */
class BaseModel
{
    /**
     * @var $table : hace referencia a la tabla con la que estará interactuando.
     * @note: Para funciones estaticas es necesario instancias un nuevo objeto de esta clase e inicializar nuevamente.
     * esta variable de lo contrario no funcionara.
     */
    protected $table;

    /**
     * @Function: Generar la consulta insert de manera automatica.
     * @param array $array : se envía un arreglo asociativo según la tabla a la que se insertaran los datos.
     * @return bool: retorna un verdadero o falso dependiendo el exito de la consulta insert.
     */
    public function created(array $array)
    {
        $sql_keys = '';
        $sql_values = '';
        $data = [];
        foreach ($array as $key => $value) {
            $sql_keys .= "`" . addslashes($key) . "`,";
            $sql_values .= "?,";
            $data[] = $value;
        }
        $sql_keys = substr($sql_keys, 0, -1);
        $sql_values = substr($sql_values, 0, -1);
        $query = "INSERT INTO {$this->table} ($sql_keys) VALUES ($sql_values)";
        return Conn::get()->prepare($query)->execute($data);
    }

    /**
     * @Function: Generar la consulta update de manera automatica.
     * @param $id : referancia al cualse le aplicará el update.
     * @param array $array : se envia un array con los datos que modificarán el registro.
     * @return bool: retorna un verdadero o false según el exito de la consulta.
     */
    public function updated($id, array $array)
    {
        $sql_set = '';
        $data = [];
        foreach ($array as $key => $value) {
            $sql_set .= "`" . addslashes($key) . "`=";
            $sql_set .= "?,";
            $data[] = $value;
        }
        $sql_set = substr($sql_set, 0, -1);
        $query = "UPDATE {$this->table} SET $sql_set WHERE id = {$id}";
        return Conn::get()->prepare($query)->execute($data);
    }

    /**
     * @Funtion : Genera la consulta delete de manero automatica.
     * @param $id : identificador del registro que se actualizará.
     * @param string $reference : si la referencia despues del where cambia donde se indica(opcional) esta como id por
     * default
     * @return bool: retorna un verdadero o false según el exito de la consulta.
     */
    public function destroyed($id, $reference = 'id')
    {
        return Conn::get()->prepare("DELETE FROM {$this->table} WHERE {$reference} = ?")
            ->execute([$id]);
    }

    /**
     * @Funtion: Funcion para traer los registros de cualquier tabla generando una consulta select.
     * @use: la funcion traera un simple select o con los campo que desea buscar durante la consulta.
     * @param string $search : la variable que viene desde el buscador.
     * @param array $array : los campos que desea o que permita que busque de la tabla.
     * @param string $conditions : los campos que desea traer a traves de la consulta.
     * @return false|PDOStatement
     * @note: No aplicar en consultas con inner join de tablas. | Posible actualización...no lo creo.
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
     * @param $id : identificador del registro a eliminar.
     * @param $reference : si la referencia despues del where cambia donde se indica.
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