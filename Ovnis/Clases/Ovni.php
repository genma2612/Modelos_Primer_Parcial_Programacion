<?php

require_once('./clases/IParte2.php');
require_once('./clases/IParte3.php');
require_once('./clases/AccesoDatos.php');

class Ovni
{
    public $tipo;
    public $velocidad;
    public $planetaOrigen;
    public $pathFoto;

    public function __construct($tipo=null, $velocidad=null, $planetaOrigen=null, $pathFoto=null){
        $this->tipo = $tipo;
        $this->velocidad = $velocidad;
        $this->planetaOrigen = $planetaOrigen;
        $this->pathFoto = $pathFoto;
    }

    public function ToJson()
    {
        return json_encode($this);
    }

    public function Agregar()
    {
        try{
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
            $consulta =$objetoAccesoDato->RetornarConsulta("INSERT INTO ovnis (tipo, velocidad, planeta, foto)"
                                                        . "VALUES(:tipo, :velocidad, :planetaOrigen, :path)"); 
            $consulta->bindValue(':tipo', $this->tipo, PDO::PARAM_STR);
            $consulta->bindValue(':velocidad', $this->velocidad, PDO::PARAM_STR);
            $consulta->bindValue(':planetaOrigen', $this->planetaOrigen, PDO::PARAM_STR);
            $consulta->bindValue(':path', $this->pathFoto, PDO::PARAM_STR);
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
        $ovnis = array();
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM ovnis");
        $consulta->execute(); 
        $resultado = $consulta->fetchall();
		foreach ($resultado as $fila) {
                $ovni = new Ovni($fila[1],$fila[2],$fila[3],$fila[4]);
                array_push($ovnis, $ovni);
            }            
        return $ovnis;    
    }

    public function ActivarVelocidadWarp()
    {
        return ($this->velocidad * 10.45);
    }

    public function Modificar()
    {
        try
        {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
            $consulta =$objetoAccesoDato->RetornarConsulta("UPDATE ovnis SET velocidad = :velocidad, foto = :foto WHERE tipo = :tipo AND planeta = :planeta"); 
            $consulta->bindValue(':tipo', $this->tipo, PDO::PARAM_STR);
            $consulta->bindValue(':planeta', $this->planetaOrigen, PDO::PARAM_STR);
            $consulta->bindValue(':velocidad', $this->velocidad, PDO::PARAM_STR);
            $consulta->bindValue(':foto', $this->pathFoto, PDO::PARAM_STR);
            $consulta->execute();
            return true;
        }
        catch (PDOException $e)
        {
            return false;
        }
    }

    public function Existe()
    {
        $retorno = false;
        $ovnis = Ovni::Traer();
        if($usuarios != null)
        {
            foreach ($usuarios as $user) {
                if($user->ToJson() == $this->ToJson())
                {
                    $retorno = true;
                    break;
                }
            }
        }
        return $retorno;
    }


}