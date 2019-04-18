<?php
namespace LoginController;

use Utilities\Utilities;
use Auth\Auth;

include '../config/core/Utilities.php';
include '../models/Auth.php';

class LoginController
{
    public static function signIn()
    {
        $session = new Auth($_POST['user'], $_POST['pass']);
        if ($session->check())
        {
            $data = $session->get();
            session_start();
            $_SESSION['valid'] = true;
            $_SESSION['id'] = $data->id;
            $_SESSION['admin'] = $data->admin;
            $_SESSION['user'] = "{$data->nombre} {$data->apaterno} {$data->amaterno}";
            Utilities::messageToast("¡Bienvenido {$data->nombre}!", "info", 'home/');
        } else
            Utilities::message('Credenciales incorrectas', 'alert alert-danger');
    }

    public static function logout()
    {
        session_start();
        $_SESSION = [];
        session_unset();
        if (session_destroy())
            Utilities::messageToast("¡Ha cerrado sesión!", 'info', 'home/login');
        else
            Utilities::messageToast("No se ha podido cerrar sesión", 'success', 'home/index');
    }
}

$function = (string)$_POST['func'];
LoginController::$function();