<?php

include_once "./Clases/Ovni.php";

$o = new Ovni("Gris", 999, "Marte","");
//var_dump($o); die;
echo $o->ToJson();