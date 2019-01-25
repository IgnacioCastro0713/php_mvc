<?php
namespace LoginController;

use Alert\Alert;
use Auth\Auth;

include '../config/Alert.php';
include '../model/Auth.php';

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
            Alert::toast("¡Bienvenido {$data['nombre']}", "success", 'home/index.php');
        } else
            Alert::message('Credenciales incorrectas', 'alert alert-danger');

    }

    public static function logout()
    {
        session_start();
        $_SESSION = [];
        session_unset();
        if (session_destroy())
            Alert::toast("¡Ha cerrado sesión!", 'success', '../views/home/index.php');
        else
            Alert::toast("No se ha podido cerrar sesión", 'success', '../layouts/index.php');
    }
}

$function = (String)$_POST['func'];
LoginController::$function();