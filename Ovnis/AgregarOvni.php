<?php
require_once('./Clases/Ovni.php');
$retorno = (object) [ "exito" => false, "mensaje" => "No se pudo agregar"]; 
if(isset($_POST['tipo']) && isset($_POST['velocidad']) && isset($_POST['planetaOrigen']) && isset($_FILES['foto']))
{
    date_default_timezone_set('America/Argentina/Buenos_Aires'); 
    $time = date("His");

    $tipo = $_POST['tipo'];
    $planeta = $_POST['planetaOrigen'];
    $velocidad = $_POST['velocidad'];

    $extension = pathinfo($_FILES["foto"]["name"], PATHINFO_EXTENSION);
    $path = "./ovnis/imagenes/" . $tipo . "." . $planeta . "." . $time . "." . $extension;

    $ovni = new Ovni($tipo, $velocidad, $planeta, $path);

    if($ovni->Existe())
    {
        $retorno->mensaje = "El ovni ya existe";
    }
    else
    {
        if($ovni->Agregar());
        {
            $retorno->exito = true;
            $retorno->mensaje = 'Ovni agregado a DB';
    
            move_uploaded_file($_FILES['foto']['tmp_name'], $path);
    
            header('Location: http://localhost/P/Ovnis/Listado.php');
        }
    }
}
echo json_encode($retorno);
