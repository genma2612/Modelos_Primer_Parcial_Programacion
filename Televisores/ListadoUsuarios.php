<?php
require_once('./Clases/Usuario.php');
$retorno = Usuario::TraerTodos();
echo json_encode($retorno);