<?php
  require("conectar_basedatos.php");

  $planta  = $_POST['planta'];
	$estados = $_POST['estados'];
	$consulta = "UPDATE `PLANTA`
							 SET `ESTADOS`= '$estados'
							 WHERE (`CODIGO` = '$planta');";

	mysql_query($consulta);
?>
