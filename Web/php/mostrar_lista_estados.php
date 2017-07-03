<?php
	session_start();
  require("conectar_basedatos.php");

  $identificador = 1;//$_SESSION['identificador'];
	$consulta = "SELECT `NOMBRE`, `DESCRIPCION`
						   FROM `ESTADO`
							 WHERE `CODIGO_USUARIO` = '$identificador';";

	$resultado_consulta = mysql_query($consulta);
	$datos = mysql_fetch_array($resultado_consulta);

  if(!is_null($datos[0])) {
      $informacion[] = array('nombre'=> $datos[0],
        					   				 'descripcion'=> $datos[1]);
  }
	echo json_encode($informacion);
?>
