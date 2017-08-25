<?php
  require("conectar_basedatos.php");

  $planta  = $_POST['planta'];
	$actual = $_POST['actual'];
  if ($actual == -1) {
    $consulta = "UPDATE `PLANTA`
  							 SET `ESTADO_ACTUAL`= NULL
  							 WHERE (`CODIGO` = '$planta');";
  }
  else {
    $consulta = "UPDATE `PLANTA`
  							 SET `ESTADO_ACTUAL`= '$actual'
  							 WHERE (`CODIGO` = '$planta');";
  }
	mysql_query($consulta);
?>
