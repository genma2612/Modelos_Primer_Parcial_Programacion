<?php

//require_once('./clases/AccesoDatos.php');

class Cliente
{
    private $nombre;
    private $correo;
    private $clave;
    
    public function ToString()
    {
        return $this->nombre . "-" . $this->correo . "-" . $this->clave;
    }

    public static function GuardarEnArchivo($cliente)
    {
        $archivo = "./clientes/clientesActuales.txt";
        if(!is_dir("./clientes"))
        {
            mkdir("./clientes");
        }
        $f = fopen($archivo, "a");
        fwrite($f, $cliente->ToString() . "\r\n");
        fclose($f);
    }

    public function __construct($nombre, $correo, $clave)
    {
        $this->nombre = $nombre;
        $this->correo = $correo;
        $this->clave = $clave;
    } 

}

