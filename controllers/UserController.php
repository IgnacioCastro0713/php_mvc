<?php
require_once '../model/SweetAlert.php';
require_once '../model/User.php';

$function = (String)$_POST['function'];
$function();

function save()
{
    $user = createUser();
    if ($user->save())
        SweetAlert::toast("Guardado correctamente", "success", "user/index.php");
    else
        SweetAlert::toast("No se ha podido guardar el usuario", "error", "user/save.php");
}
/**
 * @return User
 */
function createUser()
{
    return new User($_POST['usuario'], $_POST['nombre'], $_POST['apaterno'], $_POST['amaterno'], $_POST['pass']);
}
