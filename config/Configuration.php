<?php
namespace Configuration;

class Configuration
{
    /**
     * Configuration to model's
     */
    public static function model()
    {
        include '../config/Connection.php';// TODO: Required, doesn't change.
        include '../config/InterfaceModel.php';// TODO: Required, doesn't change.
        include '../config/BasicQuery.php';// TODO: Required, doesn't change.
    }

    /**
     * Configuration to controllers
     * @param $model
     */
    public static function controller($model)
    {
        include '../config/InterfaceController.php'; // TODO: Required, doesn't change.
        include '../config/Utilities.php'; // TODO: Required, doesn't change.
        include '../models/'.$model.'.php'; // TODO: Change according to the model.
    }
}