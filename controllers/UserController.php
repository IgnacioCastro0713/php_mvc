<?php
include 'InterfaceController.php'; // TODO: Required, doesn't change.
include '../model/SweetAlert.php'; // TODO: Required, doesn't change.
include '../model/User.php'; // TODO: Change according to the model.

use InterfaceController\InterfaceController as Controller; //TODO: Required doesn't change.
use SweetAlert\SweetAlert; // TODO: Required, doesn't change.
use User\User; // TODO: Change according to the model.

class UserController implements Controller
{
    public static function newObj()
    {
        return new User($_POST['usuario'], $_POST['nombre'], $_POST['apaterno'], $_POST['amaterno'], $_POST['pass']);
    }

    public static function save()
    {
        $user = UserController::newObj();
        if ($user->save())
            SweetAlert::toast("Guardado correctamente", "success", "user/index.php");
        else
            SweetAlert::toast("No se ha podido guardar el usuario", "error", "user/save.php");
    }

    public static function update()
    {
        //
    }

    public static function destroy()
    {
        //
    }

    public static function table()
    {
        $res = User::getAll($_POST['search']);
        $count = $res->rowCount();
        echo $count;
        require_once "../views/user/row.php";
    }
}

$function = (String)$_POST['function'];
UserController::$function();