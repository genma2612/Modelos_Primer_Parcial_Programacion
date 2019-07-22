<?php
require_once('./Clases/Helado.php');
date_default_timezone_set('America/Argentina/Buenos_Aires'); 

if(isset($_POST['sabor']) && isset($_POST['precio']) && isset($_FILES['foto']))
{
    $archivo = "./heladosArchivo/helados.txt";

    $sabor = $_POST['sabor'];
    $precio = $_POST['precio'];
    $hora = date('His');
    $extension = pathinfo($_FILES["foto"]["name"], PATHINFO_EXTENSION);
    $path = "./heladosImagen/" . $sabor . "." . $hora . "." . $extension;
    if(!is_dir("./heladosArchivo"))
    {
        mkdir("./heladosArchivo");
    }
    if(!is_dir("./heladosImagen"))
    {
        mkdir("./heladosImagen");
    }
    $f = fopen($archivo, "a");
    fwrite($f, $sabor . "-" . $precio . "\r\n");
    fclose($f);
    move_uploaded_file($_FILES['foto']['tmp_name'], $path);
    //echo $retorno;
}