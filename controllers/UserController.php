<?php
include '../model/SweetAlert.php';
include '../model/User.php';
include 'InterfaceController.php';

use SweetAlert\SweetAlert;
use InterfaceController\InterfaceController as Controller;
use User\User;

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
}
$function = (String)$_POST['function'];
UserController::$function();