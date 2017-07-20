<?php
	session_start();
  require("conectar_basedatos.php");

	$numero_fila_estados = 0;
	$numero_fila_grupos = 0;
	$identificador = $_SESSION['identificador'];
	$consulta_estados = "SELECT CODIGO, NOMBRE
							         FROM ESTADO
							         WHERE (CODIGO_USUARIO = '$identificador')
							         ORDER BY NOMBRE ASC;";

	$resultado_consulta = mysql_query($consulta_estados);
	while ($fila = mysql_fetch_row($resultado_consulta)) {
		$array_estados[$numero_fila_estados] = array('codigo' => $fila[0],
																                 'nombre' => $fila[1]);
	  $numero_fila_estados = $numero_fila_estados + 1;
	}

	$consulta_grupos = "SELECT NOMBRE, ESTADOS
							        FROM GRUPOS_ESTADOS
							        WHERE (CODIGO_USUARIO = '$identificador')
							        ORDER BY NOMBRE ASC;";

	$resultado_consulta = mysql_query($consulta_grupos);
	while ($fila = mysql_fetch_row($resultado_consulta)) {
		$array_grupos[$numero_fila_grupos] = array('nombre' => $fila[0],
																			         'estados' => $fila[1]);
		$numero_fila_grupos = $numero_fila_grupos + 1;
	}
	$informacion[0] = $array_estados;
	$informacion[1] = $array_grupos;
	echo json_encode($informacion);
?>
