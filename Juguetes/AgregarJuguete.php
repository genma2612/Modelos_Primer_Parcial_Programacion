<?php
require_once('./clases/Juguete.php');
if(isset($_POST['tipo']) && isset($_POST['precio']) && isset($_POST['paisOrigen']) && isset($_FILES['foto']))
{
    if(!is_dir("./juguetes"))
    {
        mkdir("./juguetes");
        if(!is_dir("./juguetes/imagenes/"))
            mkdir("./juguetes/imagenes/");
    }

    date_default_timezone_set('America/Argentina/Buenos_Aires'); 
    $time = date("His");

    $tipo = $_POST['tipo'];
    $pais = $_POST['paisOrigen'];
    $precio = $_POST['precio'];

    $extension = pathinfo($_FILES["foto"]["name"], PATHINFO_EXTENSION);
    $path = "./juguetes/imagenes/" . $tipo . "." . $pais . "." . $time . "." . $extension;


    $j = new Juguete($tipo,$precio,$pais,$path);
    if($j->Verificar(Juguete::Traer()))
    {
        if($j->Agregar())
        {
            move_uploaded_file($_FILES['foto']['tmp_name'], $path);
            header("Location: Listado.php");
        }
        else
        {
            echo "Error al agregar el juguete a la base de datos";
        }

    }
    else
        echo "El juguete ya existe en la base de datos";
}