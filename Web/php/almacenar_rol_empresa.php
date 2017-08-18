<?php
  session_start();
  require("conectar_basedatos.php");

  $codigo_empresa = $_SESSION['empresa'];
  $nombre = $_POST['nombre'];

  $consulta = "INSERT INTO `ROL` (`NOMBRE`, `VALOR`, `CODIGO_EMPRESA`)
               VALUES ('$nombre', NULL, '$codigo_empresa');";

	mysql_query($consulta);
?>
