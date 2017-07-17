<?php
	session_start();
  require("conectar_basedatos.php");

	$numero_fila = 0;
  $identificador = 1;//$_SESSION['identificador'];
	$consulta = "SELECT FIN.CODIGO, FIN.NOMBRE
							 FROM FINCA FIN, EMPRESA EMP, USUARIO USU
							 WHERE ((FIN.CODIGO_EMPRESA = EMP.CODIGO) AND (EMP.CODIGO_USUARIO = USU.ID_USUARIO)
							 AND (USU.ID_USUARIO = '$identificador'))
							 ORDER BY FIN.NOMBRE ASC;";

	$resultado_consulta = mysql_query($consulta);
	while($fila = mysql_fetch_row($resultado_consulta)) {
		$informacion[$numero_fila] = array('codigo' => $fila[0],
																			 'nombre' => $fila[1]);
		$numero_fila = $numero_fila + 1;
	}
	echo json_encode($informacion);
?>
