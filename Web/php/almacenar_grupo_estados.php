<?php
  session_start();
  require("conectar_basedatos.php");

  $identificador = $_SESSION['identificador'];
	$nombre        = $_POST['nombre'];
	$estados       = $_POST['estados'];

  $consulta = "INSERT INTO `GRUPOS_ESTADOS` (`CODIGO`, `NOMBRE`, `ESTADOS`, `FECHA_REGISTRO`, `CODIGO_USUARIO`)
               VALUES (NULL, '$nombre', '$estados', CURRENT_TIMESTAMP, '$identificador');";

	mysql_query($consulta);
?>
