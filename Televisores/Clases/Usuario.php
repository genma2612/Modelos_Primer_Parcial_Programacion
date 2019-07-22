<?php

class Usuario implements \JsonSerializable //Para que json_encode pueda utilizar private properties
{
    private $email;
    private $clave;

    public function jsonSerialize() //Para que json_encode pueda utilizar private properties
    {
        $vars = get_object_vars($this);
        return $vars;
    }
    
    public function ToJson()
    {
        return json_encode($this);
    }

    public function GuardarEnArchivo()
    {
        $archivo = "./archivos/usuarios.json";
        $retorno = new stdClass();
        $retorno->exito = false;
        $retorno->mensaje = "No se pudo guardar: ";
        if(is_dir("./archivos"))
        {
            if(file_exists($archivo))
            {
                clearstatcache();
                if(!filesize($archivo))
                {
                    $f = fopen($archivo, "w");
                    fwrite($f, $this->ToJson());
                    fclose($f);
                }
                else
                {
                    $usuarios = Usuario::TraerTodos();
                    array_push($usuarios, $this);
                    $f = fopen($archivo, "w");
                    fwrite($f, Usuario::GenerarArrayJsonValido($usuarios));
                    fclose($f);
                }
                $retorno->exito = true;
                $retorno->mensaje = "Guardado correctamente";
            }
            else
            {
                $retorno->mensaje .= "No existe el archivo.";
            }
        }
        else
        {
            $retorno->mensaje .= "No existe el directorio.";
        }
        return json_encode($retorno);
    }

    private static function GenerarArrayJsonValido($array)
    {
        $cadena = "[";
        foreach ($array as $obj) {
            $cadena .= $obj->ToJson() . ",\r\n";
        }
        return substr_replace($cadena, "]", -3);
    }

    public static function TraerTodos()
    {
        $archivo = "./archivos/usuarios.json";
        $usuarios = null;
        clearstatcache();
        if(filesize($archivo))
        {
            $usuarios = array();
            $json = json_decode(file_get_contents($archivo)); //no requiere fopen (y por ende, ni close duh)
            if(is_array($json))
            {
                foreach ($json as $obj) {
                    array_push($usuarios, new usuario($obj->email, $obj->clave));
                }
            }
            else
            {
                array_push($usuarios, new usuario($json->email, $json->clave));
            }
           
            /* para lineas en un txt comun
            //$f = fopen($archivo, "r");
            while(!feof($f))
            {
                $tempString = fgets($f);
                if($tempString == "")
                    continue;
                $tempArray = explode(" - ", $tempString);
                array_push($usuarios, new Usuario(trim($tempArray[0]), trim($tempArray[1])));
            }
            */
            //fclose($f);
        }
        return $usuarios;
    }

    public static function VerificarExistencia($usuario)
    {
        $archivo = "./archivos/usuarios.json";
        $retorno = false;
        if(is_dir("./archivos"))
        {
            if(file_exists($archivo))
            {
                $usuarios = Usuario::TraerTodos();
                if($usuarios != null)
                {
                    foreach ($usuarios as $user) {
                        if($user == $usuario)
                        {
                            $retorno = true;
                            break;
                        }
                    }
                }
            }
        }
        return $retorno;

    }

    public function __construct($email=null, $clave=null){
        $this->email = $email;
        $this->clave = $clave;
    }


}

