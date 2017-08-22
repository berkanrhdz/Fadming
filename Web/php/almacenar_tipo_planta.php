<?php
  session_start();
  require("conectar_basedatos.php");

  $codigo_finca = $_POST['finca'];
  $nombre = $_POST['nombre'];

  $consulta = "INSERT INTO `TIPOS_PLANTA` (`CODIGO`, `NOMBRE`, `FECHA_REGISTRO`, `CODIGO_FINCA`)
               VALUES (NULL, '$nombre', CURRENT_TIMESTAMP, '$codigo_finca');";

  mysql_query($consulta);
?>
