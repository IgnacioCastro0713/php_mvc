<?php

namespace UserController; // TODO: Change according to the controller.
include '../config/Configuration.php'; // TODO: Required, doesn't change.
use Configuration\Configuration; // TODO: Required, doesn't change.
use InterfaceModel\InterfaceController as Controller; //TODO: Required doesn't change.
use Utilities\Utilities; // TODO: Required, doesn't change.
use User\User; // TODO: Change according to the model.
Configuration::controller('User'); // TODO: Required, Change according to the model.

class UserController implements Controller
{
    /**
     * TODO: Function to return a instance from model reference.
     * @return Object
     */
    public static function instanceModel()
    {
        return new User($_POST['usuario'], $_POST['nombre'], $_POST['apaterno'], $_POST['amaterno'], $_POST['pass']);
    }

    /**
     *
     */
    public static function save()
    {
        $user = self::instanceModel();
        if (!$user->find()){
            if ($user->save()){
                Utilities::messageToast("Guardado correctamente!", "success", "user/index.php");
            } else
                Utilities::message('No se ha podido guardar el usuario.', 'alert alert-danger');
        } else
            Utilities::message('¡Nombre de usuario ya ha sido utilizado!', 'alert alert-danger');
    }

    /**
     *
     */
    public static function update()
    {
        $user = self::instanceModel();
        if ($user->comparePassword($_POST['pass_conf'])){
            if ($user->update()){
                Utilities::messageToast("Actualizado correctamente!", "success", "user/index.php");
            } else
                Utilities::message('No se ha podido actualizar el usuario o no ha realizado cambios.', 'alert alert-danger');
        } else
            Utilities::message("Las contraseñas no coinciden.","alert alert-danger");
    }

    /**
     *
     */
    public static function destroy()
    {
        echo User::delete($_POST['id']);
    }

    /**
     *
     */
    public static function table()
    {
        $res = User::search($_POST['search']);
        $count = $res->rowCount();
        echo $count;
        require_once "../views/user/row.php";
    }
}
$function = (String)$_POST['func'];
UserController::$function();