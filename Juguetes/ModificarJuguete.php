<?php
require_once('./clases/Juguete.php');
if(isset($_POST['tipo']) && isset($_POST['paisOrigen']) && isset($_POST['precio']) && isset($_FILES['foto']))
{
    if(!is_dir("./juguetesModificados"))
    {
        mkdir("./juguetesModificados");
    }

    date_default_timezone_set('America/Argentina/Buenos_Aires'); 
    $time = date("His");

    $tipo = $_POST['tipo'];
    $pais = $_POST['paisOrigen'];
    $precio = $_POST['precio'];

    $extension = pathinfo($_FILES["foto"]["name"], PATHINFO_EXTENSION);
    $path = "./juguetesModificados/" . $tipo . "." . $pais . ".modificado." . $time . "." . $extension;

    $j = new Juguete($tipo,$precio,$pais,$path);
    if($j->Modificar())
    {
        move_uploaded_file($_FILES['foto']['tmp_name'], $path);
        header("Location: Listado.php");
    }
    else
        echo "No se pudo modificar";
}