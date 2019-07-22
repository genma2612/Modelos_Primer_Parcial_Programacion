<?php
require_once('./Clases/Helado.php');
if(isset($_GET['sabor']) && isset($_GET['cantidad']))
{
    $retorno = "El sabor no se encuentra";
    $sabor = $_GET['sabor'];
    $cantidad = $_GET['cantidad'];
    $helados = Helado::RetornarArrayDeHelados();
    foreach ($helados as $h) {
        if($h->Sabor() == $sabor)
        {
            $retorno = "Precio del sabor " . $sabor . " mas IVA (cantidad " . $cantidad . "): " 
                            . $h->PrecioMasIva() * $cantidad; 
            break;
        }
    }
    echo $retorno;
}