<?php
  require("conectar_basedatos.php");

	$codigo_finca = $_POST['finca'];
	$consulta = "SELECT NOMBRE
							 FROM TIPOS_PLANTA
							 WHERE (CODIGO_FINCA = '$codigo_finca')
							 ORDER BY NOMBRE ASC;";

	$resultado_consulta = mysql_query($consulta);
	while($fila = mysql_fetch_row($resultado_consulta)) {
		$informacion[] = array('nombre' => $fila[0]);
	}
	echo json_encode($informacion);
?>
