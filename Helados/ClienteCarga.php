<?php
require_once('./Clases/Cliente.php');
if(isset($_GET['nombre']) && isset($_GET['correo']) && isset($_GET['clave']))
{
    $client = new Cliente($_GET['nombre'], $_GET['correo'], $_GET['clave']);
    Cliente::GuardarEnArchivo($client);
}