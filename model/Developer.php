<?php
/**
 * Created by IntelliJ IDEA.
 * User: ignac
 * Date: 10/02/2019
 * Time: 01:58 PM
 */

namespace Developer;

use Configuration\Configuration;
use Connection\Connection as Conn;
use InterfaceModel\InterfaceModel as Model;
Configuration::model();


class Developer implements Model
{

    public function save()
    {
        // TODO: Implement save() method.
    }

    public function update()
    {
        // TODO: Implement update() method.
    }

    public static function delete($id)
    {
        // TODO: Implement delete() method.
    }

    public static function search($search)
    {
        // TODO: Implement search() method.
    }
}