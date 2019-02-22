<?php
namespace LoginController;

use Utilities\Utilities;
use Auth\Auth;

include '../config/Utilities.php';
include '../models/Auth.php';

class LoginController
{
    public static function signin()
    {
        $session = new Auth($_POST['user'], $_POST['pass']);
        if ($session->check())
        {
            $data = $session->get();
            session_start();
            $_SESSION['valid'] = true;
            $_SESSION['id'] = $data['id'];
            $_SESSION['user'] = "{$data['nombre']} {$data['apaterno']} {$data['amaterno']}";
            Utilities::messageToast("¡Bienvenido {$data['nombre']}!", "info", 'home/index.php');
        } else
            Utilities::message('Credenciales incorrectas', 'alert alert-danger');

    }

    public static function logout()
    {
        session_start();
        $_SESSION = [];
        session_unset();
        if (session_destroy())
            Utilities::messageToast("¡Ha cerrado sesión!", 'info', '../views/home/index.php');
        else
            Utilities::messageToast("No se ha podido cerrar sesión", 'success', '../layouts/index.php');
    }
}

$function = (String)$_POST['func'];
LoginController::$function();