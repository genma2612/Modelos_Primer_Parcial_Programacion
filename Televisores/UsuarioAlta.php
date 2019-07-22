<?php
require_once('./Clases/Usuario.php');
if(isset($_POST['email']) && isset($_POST['clave']))
{
    $user = new Usuario($_POST['email'], $_POST['clave']);
    $resultado = json_decode($user->GuardarEnArchivo());
    echo $resultado->mensaje;
}