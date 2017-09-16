<?php
  require("conectar_basedatos.php");
  define('ERROR', '-1');
  define('CORRECTO', '1');

  $respuesta;
	$codigo_planta = $_POST['planta'];
  $nuevo_estado_actual = $_POST['actual'];
  $identificador = $_POST['identificador'];

  $consulta = "UPDATE ESTADO_USUARIO
               SET ESTADOS_REALIZADO = (ESTADOS_REALIZADO + 1), ULTIMO_ESTADO = '$nuevo_estado_actual', FECHA_ULTIMO = CURRENT_TIMESTAMP
               WHERE (CODIGO_USUARIO = '$identificador');";
  mysql_query($consulta);

	$consulta = "UPDATE `PLANTA`
               SET `ESTADO_ACTUAL` = '$nuevo_estado_actual'
               WHERE `CODIGO` = '$codigo_planta';";

  $resultado = mysql_query($consulta);
  if(isset($resultado)) {
    $respuesta = CORRECTO;
  }
  else {
    $respuesta = ERROR;
  }
  echo json_encode($respuesta);
?>
