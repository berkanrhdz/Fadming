<?php
	session_start();
  require("conectar_basedatos.php");

	$numero_fila = 0;
	$codigo_empresa = $_POST['empresa'];

	$consulta = "SELECT NOMBRE, VALOR
							 FROM ROL
							 WHERE ((CODIGO_EMPRESA = '$codigo_empresa') OR (CODIGO_EMPRESA = -1))
							 ORDER BY NOMBRE ASC;";

	$resultado_consulta = mysql_query($consulta);
	while($fila = mysql_fetch_row($resultado_consulta)) {
		$array_roles[$numero_fila] = array('codigo' => $fila[1],
																			 'nombre' => $fila[0]);
		$numero_fila = $numero_fila + 1;
	}

	$numero_fila = 0;
	$consulta = "SELECT ID_USUARIO, NOMBRE, APELLIDOS, IMAGEN, ROL
							 FROM USUARIO
							 WHERE (EMPRESA = '$codigo_empresa')
							 ORDER BY APELLIDOS ASC;";

	$resultado_consulta = mysql_query($consulta);
	while ($fila = mysql_fetch_row($resultado_consulta)) {
		$imagen_base64 = base64_encode($fila[3]); // Codificación de la imagen a base64.
		$array_usuarios[$numero_fila] = array('codigo' => $fila[0],
																                   'nombre' => $fila[1],
																							   	 'apellidos' => $fila[2],
																								   'imagen' => $imagen_base64,
																							     'rol' => $fila[4]);
	  $numero_fila = $numero_fila + 1;
	}
	$informacion[0] = $array_roles;
	$informacion[1] = $array_usuarios;

	echo json_encode($informacion);
?>
