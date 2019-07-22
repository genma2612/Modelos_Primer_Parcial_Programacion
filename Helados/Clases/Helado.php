<?php

//require_once('./clases/AccesoDatos.php');

interface IVendible{
    public function PrecioMasIva();
}


class Helado implements IVendible
{
    private $sabor;
    private $precio;
    
    public function Sabor()
    {
        return $this->sabor;
    }

    public static function RetornarArrayDeHelados()
    {
        $H1 = new Helado("vainilla", 5);
        $H2 = new Helado("chocolate", 4);
        $H3 = new Helado("frutilla", 6);
        $H4 = new Helado("limon", 2);
        $H5 = new Helado("americana", 3);
        return array($H1, $H2, $H3, $H4, $H5);
    }

    public static function TraerHelados()
    {
        $archivo = "./heladosArchivo/helados.txt";
        $f = fopen($archivo, "r");
        $helados = array();
        while(!feof($f))
        {
            $tempString = fgets($f);
            if($tempString == "")
                continue;
            $tempArray = explode("-", $tempString);
            array_push($helados, new Helado(trim($tempArray[0]), trim($tempArray[1])));
        }
        fclose($f);
        return $helados;
    }

    public static function VerificarHelado($sabor)
    {
        $retorno = false;
        $helados = Helado::TraerHelados();
        foreach ($helados as $ice) {
            if($ice->Sabor() == $sabor)
            {
                $retorno = true;
                break;
            }
        }
        return $retorno;
    }

    public function PrecioMasIva()
    {
        return $this->precio * 1.21;
    }

    public function __construct($sabor, $precio)
    {
        $this->sabor = $sabor;
        $this->precio = $precio;
    } 

}

