<?php
require_once('./clases/Juguete.php');
$juguetes = Juguete::Traer();
//var_dump($juguetes);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tabla de Juguetes</title>
</head>
<body>
    <table border="1">
    <tr><td>TIPO</td><td>PRECIO</td><td>PAIS</td><td>FOTO</td></tr>
      <?php
      foreach($juguetes as $toy)
      {
          ?> <tr>
              <td>
                <?php echo $toy->Tipo();?>
              </td>
              <td>
                <?php echo $toy->Precio(); ?>
              </td>
              <td>
                <?php echo $toy->Pais(); ?>
              </td>
              <td>
              <img src="<?php if($toy->PathImagen() == "") { echo "./juguetes/imagenes/default.png";} 
                                else echo $toy->PathImagen(); ?>" height="100" width="100">
              </td>
          </tr>
          <?php
      }
    ?>
    </table>
</body>
</html>