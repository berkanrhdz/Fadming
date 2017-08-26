<?php
	session_start();
  require("conectar_basedatos.php");
	define('CLIENTE_PARTICULAR', '1');
	define('CLIENTE_EMPRESA', '2');

	$numero_fila    = 0;
  $identificador = $_SESSION['identificador'];
	$tipo_usuario = $_SESSION['tipo'];
	$empresa = $_SESSION['empresa'];

	if ($tipo_usuario == CLIENTE_EMPRESA) {
		$consulta = "SELECT CODIGO, NOMBRE, DESCRIPCION
							   FROM ESTADO
								 WHERE (CODIGO_USUARIO IN (SELECT ID_USUARIO
																					 FROM USUARIO
																					 WHERE (EMPRESA = '$empresa')))
								 ORDER BY CODIGO ASC;";
	}
	else if ($tipo_usuario == CLIENTE_PARTICULAR) {
		$consulta = "SELECT `CODIGO`, `NOMBRE`, `DESCRIPCION`
							   FROM `ESTADO`
								 WHERE `CODIGO_USUARIO` = '$identificador'
								 ORDER BY CODIGO ASC;";
	}

	$resultado_consulta = mysql_query($consulta);
	while($fila = mysql_fetch_row($resultado_consulta)) {
		$informacion[$numero_fila] = array('codigo'=> $fila[0],
																			 'nombre'=> $fila[1],
							                         'descripcion'=> $fila[2]);
		$numero_fila = $numero_fila + 1;
	}
	echo json_encode($informacion);
?>
