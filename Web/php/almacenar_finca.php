<?php
  session_start();
  require("conectar_basedatos.php");

  $identificador = $_SESSION['identificador'];
  $nombre = $_POST['nombre'];

  $consulta = "INSERT INTO `FINCA` (`CODIGO`, `NOMBRE`, `FECHA_REGISTRO`, `IMAGEN`, `CODIGO_USUARIO`)
               VALUES (NULL, '$nombre', CURRENT_TIMESTAMP, NULL, '$identificador');";

  mysql_query($consulta);
?>
