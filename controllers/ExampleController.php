<?php
namespace ExampleController;
use Configuration\Configuration;
use InterfaceModel\InterfaceController as Model;
Configuration::controller('ExampleModel');

class ExampleController implements Model
{

    public static function newObj()
    {
        // TODO: Implement newObj() method.
    }

    public static function save()
    {
        // TODO: Implement save() method.
    }

    public static function update()
    {
        // TODO: Implement update() method.
    }

    public static function destroy()
    {
        // TODO: Implement destroy() method.
    }

    public static function table()
    {
        // TODO: Implement table() method.
    }
}