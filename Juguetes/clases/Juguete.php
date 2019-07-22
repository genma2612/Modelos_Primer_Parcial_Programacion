<?php
require_once('./clases/IParte1.php');
require_once('./clases/IParte2.php');
require_once('./clases/AccesoDatos.php');
class Juguete implements IParte1, IParte2
{
    private $tipo;
    private $precio;
    private $paisOrigen;
    private $pathImagen;

    public function __construct($tipo, $precio, $paisOrigen, $pathImagen="")
    {
        $this->tipo = $tipo;
        $this->precio = $precio;
        $this->paisOrigen = $paisOrigen;
        $this->pathImagen = $pathImagen;
    }

    public function Tipo()
    {
        return $this->tipo;
    }

    public function Pais()
    {
        return $this->paisOrigen;
    }

    public function Precio()
    {
        return $this->precio;
    }

    public function PathImagen()
    {
        return $this->pathImagen;
    }

    public function ToString()
    {   
        return $this->tipo . "-" . $this->precio . "-" . $this->paisOrigen . "-" . $this->pathImagen;

    }

    public function Agregar(){
        try{
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
            $consulta =$objetoAccesoDato->RetornarConsulta("INSERT INTO juguetes (tipo, precio, pais, foto)"
                                                        . "VALUES(:tipo, :precio, :pais, :foto)"); 
            $consulta->bindValue(':tipo', $this->tipo, PDO::PARAM_STR);
            $consulta->bindValue(':precio', $this->precio, PDO::PARAM_STR);
            $consulta->bindValue(':pais', $this->paisOrigen, PDO::PARAM_STR);
            $consulta->bindValue(':foto', $this->pathImagen, PDO::PARAM_STR);
            $consulta->execute();
            return true;
        }
        catch (PDOException $e)
        {
            return false;
        }
    }

    public static function Traer(){
        $juguetes = array();
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM juguetes");
        $consulta->execute(); 
        $resultado = $consulta->fetchall();
		foreach ($resultado as $fila) {
                $toy = new Juguete($fila[1],$fila[2],$fila[3],$fila[4]);
                array_push($juguetes, $toy);
            }            
        return $juguetes;                                   
    }

    public function CalcularIVA(){
        return ($this->precio * 1.21);
    }

    public function Verificar($arrayDeJuguetes){
        $retorno = true;
        foreach ($arrayDeJuguetes as $j) {
            if($this->tipo == $j->tipo && $this->paisOrigen == $j->paisOrigen)
            {
                $retorno = false;
                break;
            }
        }
        return $retorno;
    }

    public static function MostrarLog()
    {
        $retorno = "";
        $juguetes = array();
        $f = fopen("./archivos/juguetes_sin_foto.txt", "r");
        while(!feof($f))
        {
            $tempString = fgets($f);
            if($tempString == "")
                continue;
            $retorno .= $tempString . "<br>";
        }
        echo $retorno;
    }

    public function Modificar()
    {
        $retorno = false;
        if(!$this->Verificar(Juguete::Traer()))
        {
            try{
                $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
                $consulta =$objetoAccesoDato->RetornarConsulta("UPDATE juguetes SET precio = :precio, foto = :foto WHERE tipo = :tipo AND pais = :pais"); 
                $consulta->bindValue(':tipo', $this->tipo, PDO::PARAM_STR);
                $consulta->bindValue(':pais', $this->paisOrigen, PDO::PARAM_STR);
                $consulta->bindValue(':precio', $this->precio, PDO::PARAM_STR);
                $consulta->bindValue(':foto', $this->pathImagen, PDO::PARAM_STR);
                $consulta->execute();
                $retorno = true;
            }
            catch (PDOException $e)
            {
            }
        }
        return $retorno;
    }
}
