<?php
require_once('./clases/Televisor.php');
$televisores = Televisor::Traer();
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
    <tr><td>TIPO</td><td>PRECIO</td><td>PRECIO MAS IVA</td><td>PAIS</td><td>FOTO</td></tr>
      <?php
      foreach($televisores as $tele)
      {
          ?> <tr>
              <td>
                <?php echo $tele->tipo;?>
              </td>
              <td>
                <?php echo $tele->precio; ?>
              </td>
              <td>
                <?php echo $tele->CalcularIVA(); ?>
              </td>
              <td>
                <?php echo $tele->paisOrigen; ?>
              </td>
              <td>
               <img src="<?php if($tele->path == "") { echo "./televisores/imagenes/default.png";} 
                                else echo $tele->path; ?>" height="100" width="100">
              </td>
          </tr>
          <?php
      }
    ?>
    </table>
</body>
</html>