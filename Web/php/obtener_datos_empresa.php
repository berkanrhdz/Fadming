<?php
	session_start();
  require("conectar_basedatos.php");

  $codigo_empresa = $_SESSION['empresa'];
	$consulta = "SELECT NOMBRE, DIRECCION, POBLACION, CODIGO_POSTAL, TELEFONO, LOGO
							 FROM EMPRESA
							 WHERE (CODIGO = '$codigo_empresa');";

	$consulta_administrador = "SELECT USU.NOMBRE_USUARIO
							 							 FROM USUARIO USU, EMPRESA EMP
							               WHERE ((USU.EMPRESA = EMP.CODIGO) AND (EMP.CODIGO = '$codigo_empresa'))
							               LIMIT 1;";

	$resultado_consulta = mysql_query($consulta);
	$datos = mysql_fetch_row($resultado_consulta);
	$resultado_consulta_administrador = mysql_query($consulta_administrador);
	$datos_administrador = mysql_fetch_row($resultado_consulta_administrador);

	$imagen_base64  = base64_encode($datos[5]); // Codificación de la imagen a base64.
	$informacion[] = array('nombre'=> $datos[0],
												 'direccion'=> $datos[1],
												 'poblacion'=> $datos[2],
												 'cp'=> $datos[3],
												 'telefono'=> $datos[4],
												 'administrador'=> $datos_administrador[0],
												 'imagen'=> $imagen_base64);
	echo json_encode($informacion);
?>
