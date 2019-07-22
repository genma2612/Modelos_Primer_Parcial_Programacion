<?php
require_once('./clases/Juguete.php');
if(isset($_GET['tipo']) && isset($_GET['paisOrigen']))
{
    $tipo = $_GET['tipo'];
    $pais = $_GET['paisOrigen'];
    $juguetes = Juguete::Traer();
    $jugueteEncontrado = null;
    $flagTipo = false;
    $flagPais = false;
    $estado = 0;
    foreach ($juguetes as $j) {
        if($j->Pais() == $pais) {
            $flagPais = true;
            $estado = 1;
        }
        if ($j->Tipo() == $tipo) {
            $flagTipo = true;
            $estado = 2;
            if($flagPais == true){
                $jugueteEncontrado = $j;
                break;
            }
        }
    }
    if($jugueteEncontrado != null){
        echo $jugueteEncontrado->ToString() . " Precio con IVA: $" . $jugueteEncontrado->CalcularIVA();
    }
    else{
        echo "No coincide con ";
        switch ($estado) {
            case 0:
                echo "ambos parametros";
                break;      
            case 1:
                echo "con el tipo";
                break;
            case 2:
                echo "con el pais";
                break;
            default:
                break;
        }
    }
}