<?php
	session_start();
  require("conectar_basedatos.php");

  $identificador = 1;//$_SESSION['identificador'];
	$consulta = "SELECT FINC.CODIGO, FINC.NOMBRE, FINC.IMAGEN
							 FROM FINCA FINC
               WHERE (CODIGO_USUARIO = '$identificador')
               ORDER BY NOMBRE ASC";
	$resultado_consulta = mysql_query($consulta);
	while($fila = mysql_fetch_row($resultado_consulta)) {
		if (!is_null($fila[2])) {
			$imagen = base64_encode($fila[2]); // Codificación de la imagen a base64.
		}
		else {
			$imagen = null;
		}
		$codigo_finca = $fila[0];
		$consulta_huertos = "SELECT COUNT(*)
												 FROM HUERTO
												 WHERE (CODIGO_FINCA = '$codigo_finca')
												 LIMIT 1;";
		$resultado_consulta_huertos = mysql_query($consulta_huertos);
		$datos_huertos = mysql_fetch_row($resultado_consulta_huertos);
		$numero_huertos = $datos_huertos[0];
		if ($numero_huertos != 0) {
			$consulta_plantas = "SELECT COUNT(PLAN.CODIGO)
													 FROM FINCA FINC, HUERTO HUER, PLANTA PLAN
													 WHERE ((FINC.CODIGO = HUER.CODIGO_FINCA) AND (HUER.CODIGO = PLAN.CODIGO_HUERTO) AND (HUER.CODIGO_FINCA = '$codigo_finca'))
													 LIMIT 1;";
			$resultado_consulta_plantas = mysql_query($consulta_plantas);
			$datos_plantas = mysql_fetch_row($resultado_consulta_plantas);
			$numero_plantas = $datos_plantas[0];
		}
		else {
			$numero_plantas = 0;
		}
		$informacion[] = array('nombre' => $fila[1],
	                         'numero_huertos' => $numero_huertos,
													 'numero_plantas' => $numero_plantas,
												   'imagen' => $imagen);
	}
	echo json_encode($informacion);
?>
