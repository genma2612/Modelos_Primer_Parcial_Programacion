<?php
require_once('./Clases/Usuario.php');
if(isset($_GET['email']))
{
    $retorno = (object) [ "exito" => false, "mensaje" => "No se encuentra la cookie"]; 
    $mail = str_replace(".", "_", $_GET['email']);
    if(isset($_COOKIE[$mail]))
    {
        $retorno->exito = true;
        $retorno->mensaje = 'Usuario: ' . $mail . ' logueo a las ' . $_COOKIE[$mail];
    } 
    echo json_encode($retorno);
}