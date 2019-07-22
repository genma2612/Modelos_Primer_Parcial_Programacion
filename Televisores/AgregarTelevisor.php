<?php
require_once('./Clases/Televisor.php');
$retorno = (object) [ "exito" => false, "mensaje" => "No se pudo agregar"]; 
if(isset($_POST['tipo']) && isset($_POST['precio']) && isset($_POST['paisOrigen']) && isset($_FILES['foto']))
{
    date_default_timezone_set('America/Argentina/Buenos_Aires'); 
    $time = date("His");

    $tipo = $_POST['tipo'];
    $pais = $_POST['paisOrigen'];
    $precio = $_POST['precio'];

    $extension = pathinfo($_FILES["foto"]["name"], PATHINFO_EXTENSION);
    $path = "./televisores/imagenes/" . $tipo . "." . $pais . "." . $time . "." . $extension;

    $tele = new Televisor($tipo, $precio, $pais, $path);
    //var_dump($tele);die;
    if($tele->Agregar());
    {
        $retorno->exito = true;
        $retorno->mensaje = 'Televisor agregado a DB';

        move_uploaded_file($_FILES['foto']['tmp_name'], $path);

        header('Location: http://localhost/RPP/Listado.php');
    }
}
echo json_encode($retorno);
