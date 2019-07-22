<?php
require_once('./clases/Usuario.php');
require_once('./clases/Televisor.php');

//$T = new Televisor("tubo", 500, "rusia", "");
//$T->Agregar();
var_dump(Televisor::TraerUno("led","Argentina"));
//var_dump(Televisor::Traer());

//echo $T->ToJson();