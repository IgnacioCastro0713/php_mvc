<?php
namespace LoginController;

use Alert\Alert;
use Auth\Auth;

require '../config/Alert.php';
require '../model/Auth.php';

class LoginController
{
    public static function singin()
    {
        $session = new Auth($_POST['user'], $_POST['pass']);
        if ($session->check())
        {
            $data = $session->get();
            session_start();
            $_SESSION['valid'] = true;
            $_SESSION['id'] = $data['idusuarios'];
            $_SESSION['user'] = "{$data['nombre']} {$data['apaterno']} {$data['amaterno']}";
            Alert::toast("¡Bienvenido {$data['nombre']}", "success", 'layouts/index.php');
        } else
            Alert::message('Credenciales incorrectas', 'alert alert-danger');

    }

    public static function logout()
    {
        session_start();
        $_SESSION = [];
        session_unset();

        if (session_destroy())
            Alert::toast("¡Ha cerrado sesión!", 'success', '../layouts/index.php');
        else
            Alert::toast("¡Ha cerrado sesión!", 'success', 'layouts/index.php');
    }
}

$function = (String)$_POST['func'];
LoginController::$function();