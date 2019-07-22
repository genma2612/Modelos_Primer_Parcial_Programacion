<?php
require_once('./Clases/Televisor.php');


if(isset($_GET['tipo']))
{
    $msj = "No está el televisor en la bd";
    foreach (Televisor::Traer() as $tele) {
        if($tele->tipo == $_GET['tipo'])
        {
            $msj = "El televisor se encuentra en la bd";
            break;
        }
    }
    echo $msj;
}


if(isset($_POST['tipo']) && isset($_POST['pais']) && isset($_POST['accion']))
{
    $retorno = (object) [ "exito" => false, "mensaje" => "No se pudo eliminar"]; 
    if($_POST['accion'] == "borrar")
    {
        $tipo = $_POST['tipo'];
        $pais = $_POST['pais'];
        $tele = Televisor::TraerUno($tipo, $pais);
        if($tele != null)
        {
            if($tele->Eliminar())
            {
                $retorno->exito = true;
                $retorno->mensaje = 'Televisor eliminado correctamente';
                header("Location: Listado.php");die;
            }
        }
    }
    echo json_encode($retorno);
}