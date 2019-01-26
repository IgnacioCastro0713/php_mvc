<?php
namespace Configuration;

class Configuration
{
    public static function model()
    {
        include '../config/Connection.php';// TODO: Required, doesn't change.
        include '../config/InterfaceModel.php';// TODO: Required, doesn't change.
    }

    public static function controller($model)
    {
        include '../config/InterfaceController.php'; // TODO: Required, doesn't change.
        include '../config/Utilities.php'; // TODO: Required, doesn't change.
        include '../model/'.ucfirst(strtolower($model)).'.php'; // TODO: Change according to the model.
    }
}