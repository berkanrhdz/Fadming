<?php
	session_start();
  require("conectar_basedatos.php");

	$numero_fila    = 0;
  $identificador = 1;//$_SESSION['identificador'];
	$consulta = "SELECT `NOMBRE`, `DESCRIPCION`
						   FROM `ESTADO`
							 WHERE `CODIGO_USUARIO` = '$identificador';";

	$resultado_consulta = mysql_query($consulta);
	while($fila = mysql_fetch_row($resultado_consulta)) {
		$informacion[$numero_fila] = array('nombre'=> $fila[0],
							                         'descripcion'=> $fila[1]);
		$numero_fila = $numero_fila + 1;
	}
	echo json_encode($informacion);
?>
