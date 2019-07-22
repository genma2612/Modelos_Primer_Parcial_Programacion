<?php
require_once('./Clases/Usuario.php');
if(isset($_POST['email']) && isset($_POST['clave']))
{
    $retorno = (object) [ "exito" => false, "mensaje" => "No existe el usuario"];
    $user = new Usuario($_POST['email'], $_POST['clave']);
    if(Usuario::VerificarExistencia($user))
    {
        $nombreCookie = $_POST['email'];
        date_default_timezone_set('America/Argentina/Buenos_Aires'); 
        $valorCookie = date('H:i:s');
        setcookie($nombreCookie, $valorCookie);
        //setcookie($nombreCookie, $valorCookie, -1); delete coockie
        $retorno->exito = true;
        $retorno->mensaje = "Cookie generada correctamente";
        header('Location: http://localhost/RPP/ListadoUsuarios.php');
    }
    echo json_encode($retorno);
}