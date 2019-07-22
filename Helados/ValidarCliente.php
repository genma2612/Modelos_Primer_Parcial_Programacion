<?php
require_once('./Clases/Cliente.php');
if(isset($_POST['correo']) && isset($_POST['clave']))
{
    $retorno = "Cliente inexistente";
    $correo = $_POST['correo'];
    $clave = $_POST['clave'];
    $archivo = "./clientes/clientesActuales.txt";
    $f = fopen($archivo, "r");
    while(!feof($f))
    {
        $tempString = fgets($f);
        if($tempString == "")
            continue;
        $tempArray = explode("-", $tempString);
        //var_dump($tempArray);die;
        if(trim($tempArray[1]) == $correo && trim($tempArray[2]) == $clave)
        {
            $retorno = "Cliente " . $tempArray[0] . " logueado."; 
            break;
        }
    }
    fclose($f);
    echo $retorno;
}