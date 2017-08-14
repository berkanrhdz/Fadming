<?php
	session_start();
  require("conectar_basedatos.php");

  $codigo_empresa = $_SESSION['empresa'];
	$consulta = "SELECT NOMBRE, LOGO
							 FROM EMPRESA
							 WHERE (CODIGO = '$codigo_empresa');";

	$resultado_consulta = mysql_query($consulta);
	$datos = mysql_fetch_row($resultado_consulta);
	$imagen_base64  = base64_encode($datos[1]); // Codificación de la imagen a base64.
	$informacion[] = array('nombre'=> $datos[0],
												 'imagen'=> $imagen_base64);
	echo json_encode($informacion);
?>
