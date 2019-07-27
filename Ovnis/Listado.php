<?php
require_once('./clases/Ovni.php');
$ovnis = Ovni::Traer();
//var_dump($televisores);die;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tabla de Televisores</title>
</head>
<body>
    <table border="1">
    <tr><td>TIPO</td><td>VELOCIDAD</td><td>VELOCIDAD WARP</td><td>PLANETA</td><td>FOTO</td></tr>
      <?php
      foreach($ovnis as $ovni)
      {
          ?> <tr>
              <td>
                <?php echo $ovni->tipo;?>
              </td>
              <td>
                <?php echo $ovni->velocidad; ?>
              </td>
              <td>
                <?php echo $ovni->ActivarVelocidadWarp(); ?>
              </td>
              <td>
                <?php echo $ovni->planetaOrigen; ?>
              </td>
              <td>
               <img src="<?php if($ovni->pathFoto == "") { echo "./ovnis/imagenes/default.png";} 
                                else echo $ovni->pathFoto; ?>" height="100" width="100">
              </td>
          </tr>
          <?php
      }
    ?>
    </table>
</body>
</html>