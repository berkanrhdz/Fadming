<?php
  require("conectar_basedatos.php");

  $codigo_huerto = $_POST['huerto'];
  $nombre = $_POST['nombre'];
  $cantidad = $_POST['cantidad'];

  $consulta = "INSERT INTO `PLANTA` (`CODIGO`, `NOMBRE`, `FECHA_REGISTRO`, `ESTADOS`, `ESTADO_ACTUAL`, `CODIGO_HUERTO`)
               VALUES (NULL, '$nombre', CURRENT_TIMESTAMP, '', NULL, '$codigo_huerto')";

  for ($i = 0; $i < $cantidad; $i++) {
    mysql_query($consulta);
  }
?>
