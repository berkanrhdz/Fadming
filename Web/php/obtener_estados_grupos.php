<?php
	session_start();
  require("conectar_basedatos.php");

	$numero_fila = 0;
	$informacion;
	$codigo_planta = $_POST['planta'];
	$consulta = "SELECT ESTADOS
							 FROM PLANTA
							 WHERE (CODIGO = '$codigo_planta')
							 ORDER BY NOMBRE ASC;";

	$resultado_consulta = mysql_query($consulta);
	$fila = mysql_fetch_row($resultado_consulta);
	$codigos_estados = explode(" ", $fila[0]);
	$where_consulta = " WHERE (CODIGO = '$codigos_estados[0]')";
	for ($i = 1; $i < count($codigos_estados); $i++) {
		$where_consulta = $where_consulta . " OR (CODIGO = '$codigos_estados[$i]')";
	}
	$consulta_estados = "SELECT CODIGO, NOMBRE
							 				 FROM ESTADO";
  $consulta_estados = $consulta_estados . $where_consulta . " ORDER BY NOMBRE ASC;";
	$resultado_consulta_estados = mysql_query($consulta_estados);
	while ($fila = mysql_fetch_row($resultado_consulta_estados)) {
		$informacion[$numero_fila] = array('codigo' => $fila[0],
																       'nombre' => $fila[1]);
	  $numero_fila = $numero_fila + 1;
	}
	echo json_encode($informacion);
?>