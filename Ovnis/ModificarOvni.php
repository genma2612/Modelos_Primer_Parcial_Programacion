<?php
require_once('./Clases/Ovni.php');
$retorno = (object) [ "exito" => false, "mensaje" => "No se pudo modificar"]; 
if(isset($_POST['tipo']) && isset($_POST['planetaOrigen']) && isset($_POST['velocidad']) && isset($_FILES['foto']))
{
    date_default_timezone_set('America/Argentina/Buenos_Aires'); 
    $time = date("His");

    $tipo = $_POST['tipo'];
    $planeta = $_POST['planetaOrigen'];
    $velocidad = $_POST['velocidad'];

    $extension = pathinfo($_FILES["foto"]["name"], PATHINFO_EXTENSION);
    $path = "./ovnisModificados/" . $tipo . "." . $planeta . ".modificado." . $time . "." . $extension;

    $ovni = new Ovni($tipo, $velocidad, $planeta, $path);
    if($ovni->Modificar())
    {
        $retorno->exito = true;
        $retorno->mensaje = 'Ovni modificado correctamente';

        move_uploaded_file($_FILES['foto']['tmp_name'], $path);
        header("Location: Listado.php");
    }
}
echo json_encode($retorno);