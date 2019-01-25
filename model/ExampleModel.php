<?php
namespace ExampleModel;
use Configuration\Configuration;
use InterfaceModel\InterfaceModel as Model;
Configuration::model();

class ExampleModel implements Model
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