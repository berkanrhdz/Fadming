<?php
	session_start();
  require("conectar_basedatos.php");
	define('CLIENTE_PARTICULAR', '1');
	define('CLIENTE_EMPRESA', '2');

	$tipo_usuario = $_SESSION['tipo'];
	$identificador = $_SESSION['identificador'];
	$empresa = $_SESSION['empresa'];
	$opcion = $_POST['opcion'];

	switch ($opcion) {
    case 1:
		$indice = 0;
		if ($tipo_usuario == CLIENTE_EMPRESA) {
			$consulta = "SELECT HUER.CODIGO, HUER.NOMBRE, FINC.NOMBRE
									 FROM FINCA FINC, HUERTO HUER
									 WHERE ((FINC.CODIGO = HUER.CODIGO_FINCA) AND (CODIGO_USUARIO IN (SELECT ID_USUARIO
																																										FROM USUARIO
																																										WHERE (EMPRESA = '$empresa'))));";
		}
		else if ($tipo_usuario == CLIENTE_PARTICULAR) {
			$consulta = "SELECT HUER.CODIGO, HUER.NOMBRE, FINC.NOMBRE
									 FROM FINCA FINC, HUERTO HUER
									 WHERE ((FINC.CODIGO = HUER.CODIGO_FINCA) AND (CODIGO_USUARIO = '$identificador'));";
		}
		$resultado_consulta = mysql_query($consulta);
		while($fila = mysql_fetch_row($resultado_consulta)) {
			$codigo_huerto = $fila[0];
			$nombre_huerto = $fila[1];
			$nombre_finca = $fila[2];
			$contador_plantas = 0;
			$contador_plantas_no_finalizadas = 0;
			$consulta_estados = "SELECT ESTADOS, ESTADO_ACTUAL
													 FROM PLANTA
													 WHERE (CODIGO_HUERTO = '$codigo_huerto');";
			$resultado_consulta_estados = mysql_query($consulta_estados);
			while($fila_estados = mysql_fetch_row($resultado_consulta_estados)) {
				$estado_actual = $fila_estados[1];
				$contador_plantas++;
				if (!is_null($estado_actual)) {
					$estados_plantas_formato = trim($fila_estados[0]);
					$codigos_estados = explode(" ", $estados_plantas_formato);
					if ($codigos_estados[count($codigos_estados) - 1] != $estado_actual) {
						$contador_plantas_no_finalizadas++;
					}
				}
			}
			$contador_plantas_no_finalizadas;
			$informacion[$indice] = array('nombre' => $nombre_huerto . " | Finca " . $nombre_finca,
		                                'cantidad' => $contador_plantas_no_finalizadas);
			$indice++;
		}
		break;
	}
	echo json_encode($informacion);
?>
