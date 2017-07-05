<?php
  session_start();
  require("conectar_basedatos.php");

  $identificador = $_SESSION['identificador'];
	$nombre        = $_POST['nombre'];
	$descripcion   = $_POST['descripcion'];

  $consulta = "INSERT INTO `ESTADO` (`CODIGO`, `NOMBRE`, `DESCRIPCION`, `FECHA_REGISTRO`, `CODIGO_USUARIO`)
               VALUES (NULL, '$nombre', '$descripcion', CURRENT_TIMESTAMP, '$identificador');";

	mysql_query($consulta);
?>
