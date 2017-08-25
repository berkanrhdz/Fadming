<?php
  require("conectar_basedatos.php");

  $planta  = $_POST['planta'];
	$estados = $_POST['estados'];
  $estados_formato = trim($estados);
	$consulta = "UPDATE `PLANTA`
							 SET `ESTADOS`= '$estados_formato'
							 WHERE (`CODIGO` = '$planta');";

	mysql_query($consulta);
?>
