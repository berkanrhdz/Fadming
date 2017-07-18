<?php
	session_start();
  require("conectar_basedatos.php");

	$numero_fila = 0;
	$codigo_planta = 9;//$_POST['planta'];
	$consulta = "SELECT NOMBRE, ESTADOS
							 FROM PLANTA
							 WHERE (CODIGO = '$codigo_planta')
							 ORDER BY NOMBRE ASC;";

	$resultado_consulta = mysql_query($consulta);
	while($fila = mysql_fetch_row($resultado_consulta)) {
		$informacion[$numero_fila] = array('planta' => $fila[0],
																			 'estados' => $fila[1]);
		$numero_fila = $numero_fila + 1;
	}
	echo json_encode($informacion);
?>
