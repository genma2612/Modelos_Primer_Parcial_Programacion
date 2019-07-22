<?php
require_once('./Clases/Televisor.php'); 

$televisores = Televisor::Traer();
$televisoresAMostrar = array();

$tipoSet = isset($_POST['tipo']) ? $_POST["tipo"] : null;
$paisSet = isset($_POST['paisOrigen']) ? $_POST["paisOrigen"] : null;
$ambosSet = $tipoSet && $paisSet;

if($ambosSet)
{
    $tipo = $_POST['tipo'];
    $pais = $_POST['paisOrigen'];
    foreach ($televisores as $tele) {
        if($tele->tipo == $tipo && $tele->paisOrigen == $pais)
        {
            array_push($televisoresAMostrar, $tele);
        }
    }
}
if($tipoSet == true && $paisSet == false)
{
    $tipo = $_POST['tipo'];
    foreach ($televisores as $tele) {
        if($tele->tipo == $tipo)
        {
            array_push($televisoresAMostrar, $tele);
        }
    }
}
if($tipoSet == false && $paisSet == true)
{
    $pais = $_POST['paisOrigen'];
    foreach ($televisores as $tele) {
        if($tele->paisOrigen == $pais)
        {
            array_push($televisoresAMostrar, $tele);
        }
    }
}
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
      foreach($televisoresAMostrar as $tele)
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