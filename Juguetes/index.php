<?php
require_once('./clases/Juguete.php');

$j = new Juguete("camioncito", 20, "usa", "");
//$j->Agregar();
$array = Juguete::Traer();
$retorno = $j->Verificar($array);
var_dump($array);
if($retorno)
{
    echo "no existe";
}
else
    echo "existe";
//var_dump(Juguete::Traer());

//echo $T->ToJson();