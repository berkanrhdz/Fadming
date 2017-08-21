<?php
	session_start();
  require("conectar_basedatos.php");

  $identificador = $_SESSION['identificador'];
	$consulta = "SELECT FINC.NOMBRE, COUNT(*), FINC.IMAGEN
							 FROM FINCA FINC, HUERTO HUER, USUARIO USU
               WHERE ((FINC.CODIGO = HUER.CODIGO_FINCA) AND (FINC.CODIGO_USUARIO = USU.ID_USUARIO) AND (USU.ID_USUARIO = '$identificador'))
               GROUP BY FINC.NOMBRE;";

	$resultado_consulta = mysql_query($consulta);
	while($fila = mysql_fetch_row($resultado_consulta)) {
		$imagen_base64 = base64_encode($fila[2]); // Codificación de la imagen a base64.
		$informacion[] = array('nombre' => $fila[0],
	                         'numero_huertos' => $fila[1],
												   'imagen' => $imagen_base64);
	}
	echo json_encode($informacion);
?>
