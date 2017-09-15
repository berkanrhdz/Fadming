<?php
	session_start();
  require("conectar_basedatos.php");

	$identificador = $_POST['identificador'];
	$consulta = "SELECT ULTIMO_ESTADO
							 FROM ESTADO_USUARIO
							 WHERE (CODIGO_USUARIO = '$identificador');";

	$resultado_consulta = mysql_query($consulta);
	$datos = mysql_fetch_array($resultado_consulta);
	if (is_null($datos[0])) {
		$consulta = "SELECT USU.NOMBRE, USU.APELLIDOS, USU.CORREO, USU.NOMBRE_USUARIO, DATE_FORMAT(USU.FECHA_REGISTRO, '%d %Y') DIA_ANIO, DATE_FORMAT(USU.FECHA_REGISTRO, '%c') MES, USU.IMAGEN
								 FROM USUARIO USU
								 WHERE (ID_USUARIO = '$identificador');";

		$resultado_consulta = mysql_query($consulta);
		$datos = mysql_fetch_array($resultado_consulta);
		$imagen_base64 = base64_encode($datos[6]); // Codificación de la imagen a base64.
		$ultimo_estado = null;
		$dias_ultimo = null;
	}
	else {
		$consulta = "SELECT USU.NOMBRE, USU.APELLIDOS, USU.CORREO, USU.NOMBRE_USUARIO, DATE_FORMAT(USU.FECHA_REGISTRO, '%d %Y') DIA_ANIO, DATE_FORMAT(USU.FECHA_REGISTRO, '%c') MES, EST.NOMBRE, TO_DAYS(CURRENT_TIMESTAMP) - TO_DAYS(ESTUSU.FECHA_ULTIMO) AS DIAS, USU.IMAGEN
								 FROM USUARIO USU, ESTADO_USUARIO ESTUSU, ESTADO EST
								 WHERE ((USU.ID_USUARIO = ESTUSU.CODIGO_USUARIO) AND (ESTUSU.ULTIMO_ESTADO = EST.CODIGO) AND (ID_USUARIO = '$identificador'));";

		$resultado_consulta = mysql_query($consulta);
		$datos = mysql_fetch_array($resultado_consulta);
		$imagen_base64 = base64_encode($datos[8]); // Codificación de la imagen a base64.
		$ultimo_estado = $datos[6];
		$dias_ultimo = $datos[7];
	}
	$informacion[] = array('nombre'=> $datos[0],
												 'apellidos'=> $datos[1],
												 'correo'=> $datos[2],
												 'usuario'=> $datos[3],
												 'dia_anio'=> $datos[4],
												 'mes'=> $datos[5],
												 'ultimo_estado'=> $ultimo_estado,
												 'dias_ultimo'=> $dias_ultimo,
												 'imagen'=> $imagen_base64);
	echo json_encode($informacion);
?>
