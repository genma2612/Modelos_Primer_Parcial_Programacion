<?php
require_once('./Clases/Ovni.php');
if(isset($_POST['tipo']) && isset($_POST['velocidad']) && isset($_POST['planetaOrigen']))
{
    $retorno = (object) [ "exito" => false, "mensaje" => "No se pudo agregar"]; 
    $ovni = new Ovni($_POST['tipo'], $_POST['velocidad'], $_POST['planetaOrigen'],"");
    if($ovni->Agregar());
    {
        $retorno->exito = true;
        $retorno->mensaje = 'Ovni agregado a DB';
    }
    echo json_encode($retorno);
}
