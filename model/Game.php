<?php

namespace Game;

use Configuration\Configuration;
use Connection\Connection as Conn;
use InterfaceModel\InterfaceModel as Model;
Configuration::model();


class Game implements Model
{

    public function save()
    {
        // TODO: Implement save() method.
    }

    public function update($id)
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