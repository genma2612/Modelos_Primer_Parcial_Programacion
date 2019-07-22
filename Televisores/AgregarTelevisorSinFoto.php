<?php
require_once('./Clases/Televisor.php');
if(isset($_POST['tipo']) && isset($_POST['precio']) && isset($_POST['paisOrigen']))
{
    $retorno = (object) [ "exito" => false, "mensaje" => "No se pudo agregar"]; 
    $tele = new Televisor($_POST['tipo'], $_POST['precio'], $_POST['paisOrigen'],"");
    if($tele->Agregar());
    {
        $retorno->exito = true;
        $retorno->mensaje = 'Televisor agregado a DB';
    }
    echo json_encode($retorno);
}
