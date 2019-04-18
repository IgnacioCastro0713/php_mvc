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
        include '../config/interface/InterfaceModel.php';// TODO: Required, doesn't change.
        include '../config/core/BaseModel.php';// TODO: Required, doesn't change.
    }

    /**
     * Configuration to controllers
     * @param $model
     */
    public static function controller($model)
    {
        include '../config/interface/InterfaceController.php'; // TODO: Required, doesn't change.
        include '../config/core/Utilities.php'; // TODO: Required, doesn't change.
        include '../models/'.$model.'.php'; // TODO: Change according to the model.
    }
}