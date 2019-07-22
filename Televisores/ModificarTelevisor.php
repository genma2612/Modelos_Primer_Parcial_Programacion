<?php
require_once('./Clases/Televisor.php');
$retorno = (object) [ "exito" => false, "mensaje" => "No se pudo modificar"]; 
if(isset($_POST['tipo']) && isset($_POST['paisOrigen']) && isset($_POST['precio']) && isset($_FILES['foto']))
{
    date_default_timezone_set('America/Argentina/Buenos_Aires'); 
    $time = date("His");

    $tipo = $_POST['tipo'];
    $pais = $_POST['paisOrigen'];
    $precio = $_POST['precio'];

    $extension = pathinfo($_FILES["foto"]["name"], PATHINFO_EXTENSION);
    $path = "./televisores/imagenes/" . $tipo . "." . $pais . "." . $time . "." . $extension;

    $tele = new Televisor($tipo, $precio, $pais, $path);
    if($tele->Modificar())
    {
        $retorno->exito = true;
        $retorno->mensaje = 'Televisor modificado correctamente';

        move_uploaded_file($_FILES['foto']['tmp_name'], $path);
        header("Location: Listado.php");
    }
}
echo json_encode($retorno);