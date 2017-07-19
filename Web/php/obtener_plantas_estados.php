<?php
	session_start();
  require("conectar_basedatos.php");

	$array_estados = array();
	$numero_fila = 0;
	$informacion = new stdClass();
	$codigo_planta = $_POST['planta'];
	$consulta = "SELECT NOMBRE, ESTADOS
							 FROM PLANTA
							 WHERE (CODIGO = '$codigo_planta')
							 ORDER BY NOMBRE ASC;";

	$resultado_consulta = mysql_query($consulta);
	$fila = mysql_fetch_row($resultado_consulta);
	$informacion->planta = $fila[0];
	$codigos_estados = explode(" ", $fila[1]);
	$where_consulta = " WHERE (CODIGO = '$codigos_estados[0]')";
	for ($i = 1; $i < count($codigos_estados); $i++) {
		$where_consulta = $where_consulta . " OR (CODIGO = '$codigos_estados[$i]')";
	}
	$consulta_estados = "SELECT CODIGO, NOMBRE
							 				 FROM ESTADO";
  $consulta_estados = $consulta_estados . $where_consulta . " ORDER BY NOMBRE ASC;";
	$resultado_consulta_estados = mysql_query($consulta_estados);
	while ($fila = mysql_fetch_row($resultado_consulta_estados)) {
		$array_codigos_estados[$numero_fila] = array('codigo' => $fila[0],
																	               'nombre' => $fila[1]);
		array_push($array_estados, $array_codigos_estados[$numero_fila]);
	  $numero_fila = $numero_fila + 1;
	}
	$informacion->estados = $array_estados;
	echo json_encode($informacion);
?>
