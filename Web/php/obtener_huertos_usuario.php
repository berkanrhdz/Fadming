<?php
	session_start();
  require("conectar_basedatos.php");

	$numero_fila = 0;
	$codigo_finca = 1;
	$consulta = "SELECT CODIGO, NOMBRE
							 FROM HUERTO
							 WHERE (CODIGO_FINCA = '$codigo_finca')
							 ORDER BY NOMBRE ASC;";

	$resultado_consulta = mysql_query($consulta);
	while($fila = mysql_fetch_row($resultado_consulta)) {
		$informacion[$numero_fila] = array('codigo' => $fila[0],
																			 'nombre' => $fila[1]);
		$numero_fila = $numero_fila + 1;
	}
	echo json_encode($informacion);
?>
