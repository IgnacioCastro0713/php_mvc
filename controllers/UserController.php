<?php

namespace UserController; // TODO: Change according to the controller.
include '../config/Configuration.php'; // TODO: Required, doesn't change.
use Configuration\Configuration; // TODO: Required, doesn't change.
use InterfaceModel\InterfaceController as Controller; //TODO: Required doesn't change.
use Alert\Alert; // TODO: Required, doesn't change.
use User\User; // TODO: Change according to the model.
Configuration::controller('User'); // TODO: Required, Change according to the model.

class UserController implements Controller
{
    public static function newObj()
    {
        return new User($_POST['usuario'], $_POST['nombre'], $_POST['apaterno'], $_POST['amaterno'], $_POST['pass']);
    }

    public static function save()
    {
        $user = self::newObj();
        if (!$user->find()){
            if ($user->save()){
                Alert::toast("Guardado correctamente!", "success", "user/index.php");
            } else
                Alert::message('No se ha podido guardar el usuario.', 'alert alert-danger');
        } else
            Alert::message('¡Nombre de usuario ya ha sido utilizado!', 'alert alert-danger');
    }

    public static function update()
    {
        $user = self::newObj();
        if ($user->comparePassword($_POST['pass_conf'])){
            if ($user->update()){
                Alert::toast("Actualizado correctamente!", "success", "user/index.php");
            } else
                Alert::message('No se ha podido actualizar el usuario o no ha realizado cambios.', 'alert alert-danger');
        } else
            Alert::message("Las contraseñas no coinciden.","alert alert-danger");
    }
    public static function destroy()
    {
        echo User::delete($_POST['id']);
    }

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