<?php
  require("conectar_basedatos.php");

  $codigo_huerto = $_POST['huerto'];
  $codigo_usuario = $_POST['usuario'];

  $consulta = "INSERT INTO `HUERTO_PERMISO` (`CODIGO_HUERTO`, `CODIGO_USUARIO`)
               VALUES ('$codigo_huerto', '$codigo_usuario')";

	mysql_query($consulta);
?>
