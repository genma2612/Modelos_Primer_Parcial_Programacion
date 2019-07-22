<?php
require_once('./Clases/Helado.php');

$array = Helado::RetornarArrayDeHelados();
var_dump($array);
$h = new Helado("cielo", 10);
echo $h->PrecioMasIva();