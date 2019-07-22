<?php
require_once('./clases/IParte2.php');
require_once('./clases/IParte3.php');
require_once('./clases/IParte4.php');
require_once('./clases/AccesoDatos.php');

class Televisor implements IParte2, IParte3, IParte4
{
    public $tipo;
    public $precio;
    public $paisOrigen;
    public $path;
    
    public function ToJson()
    {
        return json_encode($this);
    }


    public function __construct($tipo=null, $precio=null, $paisOrigen=null, $path=null){
        $this->tipo = $tipo;
        $this->precio = $precio;
        $this->paisOrigen = $paisOrigen;
        $this->path = $path;
    }

    public function Agregar()
    {
        try{
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
            $consulta =$objetoAccesoDato->RetornarConsulta("INSERT INTO televisores (tipo, precio, pais, foto)"
                                                        . "VALUES(:tipo, :precio, :paisOrigen, :path)"); 
            $consulta->bindValue(':tipo', $this->tipo, PDO::PARAM_STR);
            $consulta->bindValue(':precio', $this->precio, PDO::PARAM_STR);
            $consulta->bindValue(':paisOrigen', $this->paisOrigen, PDO::PARAM_STR);
            $consulta->bindValue(':path', $this->path, PDO::PARAM_STR);
            $consulta->execute();
            return true;
        }
        catch (PDOException $e)
        {
            return false;
        }

    }

    public static function Traer()
    {
        $televisores = array();
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM televisores");
        $consulta->execute(); 
        $resultado = $consulta->fetchall();
		foreach ($resultado as $fila) {
                $tele = new Televisor($fila[1],$fila[2],$fila[3],$fila[4]);
                array_push($televisores, $tele);
            }            
        return $televisores;    
    }

    public static function TraerUno($tipo, $paisOrigen)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("SELECT * from televisores WHERE tipo = :tipo AND pais = :pais"); 
        $consulta->bindValue(':tipo', $tipo, PDO::PARAM_STR);
        $consulta->bindValue(':pais', $paisOrigen, PDO::PARAM_STR);
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
        if($resultado != null)
            return new Televisor($resultado['tipo'], $resultado['precio'], $resultado['pais'], $resultado['foto']);
    }

    public function CalcularIVA()
    {
        return ($this->precio * 1.21);
    }


    public function Modificar()
    {
        try
        {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
            $consulta =$objetoAccesoDato->RetornarConsulta("UPDATE televisores SET precio = :precio, foto = :foto WHERE tipo = :tipo AND pais = :pais"); 
            $consulta->bindValue(':tipo', $this->tipo, PDO::PARAM_STR);
            $consulta->bindValue(':pais', $this->paisOrigen, PDO::PARAM_STR);
            $consulta->bindValue(':precio', $this->precio, PDO::PARAM_STR);
            $consulta->bindValue(':foto', $this->path, PDO::PARAM_STR);
            $consulta->execute();
            return true;
        }
        catch (PDOException $e)
        {
            return false;
        }
    }

    public function Eliminar()
    {
        try
        {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
            $consulta =$objetoAccesoDato->RetornarConsulta("DELETE from televisores WHERE tipo = :tipo AND pais = :pais"); 
            $consulta->bindValue(':tipo', $this->tipo, PDO::PARAM_STR);
            $consulta->bindValue(':pais', $this->paisOrigen, PDO::PARAM_STR);
            $consulta->execute();
            return true;
        }
        catch (PDOException $e)
        {
            return false;
        }
    }

}

