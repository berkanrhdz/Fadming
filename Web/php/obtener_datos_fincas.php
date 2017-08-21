<?php
	session_start();
  require("conectar_basedatos.php");

  $identificador = $_SESSION['identificador'];
	$consulta = "SELECT FINC.NOMBRE, FINC.IMAGEN
							 FROM FINCA FINC
               WHERE (CODIGO_USUARIO = '$identificador')
               ORDER BY NOMBRE ASC";

	$resultado_consulta = mysql_query($consulta);
	while($fila = mysql_fetch_row($resultado_consulta)) {
		if (!is_null($fila[1])) {
			$imagen = base64_encode($fila[1]); // Codificación de la imagen a base64.
		}
		else {
			$imagen = null;
		}
		$informacion[] = array('nombre' => $fila[0],
	                         'numero_huertos' => 5,
												   'imagen' => $imagen);
	}
	echo json_encode($informacion);
?>
