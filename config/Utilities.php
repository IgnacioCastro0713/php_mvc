<?php
namespace Utilities;

use Connection\Connection as Conn;

class Utilities
{

    public static function messageToast($message, $type, $location)
    {
        echo "<script type='text/javascript'>
        Toast.fire({
          type: '{$type}',
          title: '{$message}'
        }).then(function() {
          setTimeout(\"location . href = '../$location'\", 0)
        });</script>";
    }

    public static function message($message, $type)
    {
        echo "<div class=\"{$type} alert-with-icon\">
                <button type=\"button\" aria-hidden=\"true\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                    <i class=\"tim-icons icon-simple-remove\"></i>
                </button>
            <span data-notify=\"icon\" class=\"tim-icons icon-alert-circle-exc\"></span>
            <span>
              <b> Error! - </b> {$message}</span>
          </div>";
    }

    public static function getById($table, $id)
    {
        return Conn::instance()
            ->query("SELECT * FROM {$table} WHERE id = {$id}")
            ->fetchAll()[0];
    }

    public static function select($table, $id, $default)
    {
        $sql = "SELECT * FROM {$table}";
        $res = Conn::instance()->query($sql);
        $rows = $res->fetchAll();
        echo "<select id=\"{$id}\" name='{$id}' class=\"form-control\" required>";
        echo "<option style='color: #0a0c0d' value=''>Seleccione una opción</option>";
        foreach ($rows as $row){
            echo "<option  style='color: #0a0c0d' value='{$row['id']}'";
            if ($row['id'] === $default)
                echo "selected";
            echo ">{$row['nombre']} - {$row['sede']}</option>";
        }
        echo "</select>";
    }
}