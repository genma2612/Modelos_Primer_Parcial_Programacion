<?php
require_once('./Clases/Ovni.php');
if(isset($_POST['ovni']))
{
    $retorno = (object) [ "exito" => false, "mensaje" => "No coincide con "];

    $json = json_decode($_POST['ovni']);
    $ovni = new Ovni($json->tipo, $json->velocidad, $json->planetaOrigen, $json->pathFoto);
    $array = Ovni::Traer();
    
    $ovniEncontrado = null;
    $flagTipo = false;
    $flagPlaneta = false;
    $estado = 0;
    foreach ($array as $o) {
        if($o->planetaOrigen == $ovni->planetaOrigen) {
            $flagPlaneta = true;
            $estado = 1;
        }
        if ($o->tipo == $ovni->tipo) {
            $flagTipo = true;
            $estado = 2;
            if($flagPlaneta == true){
                $ovniEncontrado = $o;
                break;
            }
        }
    }
    if($ovniEncontrado != null){
        $retorno->exito = true;
        $retorno->mensaje = $ovni->ToJson();
    }
    else{
        switch ($estado) {
            case 0:
                $retorno->mensaje .= "ambos parametros";
                break;      
            case 1:
                $retorno->mensaje .= "con el tipo";
                break;
            case 2:
                $retorno->mensaje .= "con el planeta";
                break;
            default:
                break;
        }
    }

    echo json_encode($retorno);
}