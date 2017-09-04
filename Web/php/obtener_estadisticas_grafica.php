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
				$consulta = "SELECT FINC.CODIGO, FINC.NOMBRE
										 FROM FINCA FINC
										 WHERE CODIGO_USUARIO IN (SELECT ID_USUARIO
																							FROM USUARIO
																							WHERE (EMPRESA = '$empresa'));";
			}
			else if ($tipo_usuario == CLIENTE_PARTICULAR) {
				$consulta = "SELECT FINC.CODIGO, FINC.NOMBRE
										 FROM FINCA FINC
										 WHERE CODIGO_USUARIO = '$identificador';";
			}
			$resultado_consulta = mysql_query($consulta);
			while($fila = mysql_fetch_row($resultado_consulta)) {
				$codigo_finca = $fila[0];
				$nombre_finca = $fila[1];
				$contador_plantas = 0;
				$contador_plantas_finalizadas = 0;
				$consulta_huerto = "SELECT CODIGO
														FROM HUERTO
														WHERE CODIGO_FINCA = '$codigo_finca';";
				$resultado_consulta_huerto = mysql_query($consulta_huerto);
				while($fila = mysql_fetch_row($resultado_consulta_huerto)) {
					$codigo_huerto = $fila[0];
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
							if ($codigos_estados[count($codigos_estados) - 1] == $estado_actual) {
								$contador_plantas_finalizadas++;
							}
						}
					}
				}
				$categorias[$indice] = $nombre_finca;
				$datos[$indice] = round((($contador_plantas_finalizadas * 100) / $contador_plantas), 2);
				$indice++;
			}
		break;
		case 2:
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
				$contador_plantas_finalizadas = 0;
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
						if ($codigos_estados[count($codigos_estados) - 1] == $estado_actual) {
							$contador_plantas_finalizadas++;
						}
					}
				}
				$categorias[$indice] = "<b>" . $nombre_huerto . "</b><br>Finca " . $nombre_finca;
				$datos[$indice] = round((($contador_plantas_finalizadas * 100) / $contador_plantas), 2);
				$indice++;
			}
		break;
		case 3:
			$indice = 0;
			if ($tipo_usuario == CLIENTE_EMPRESA) {
				$consulta = "SELECT DATE_FORMAT(PLAN.FECHA_REGISTRO, '%c %Y') MES_ANIO_ORDER, DATE_FORMAT(PLAN.FECHA_REGISTRO, '%b %Y') MES_ANIO, COUNT(*)
										 FROM FINCA FINC, HUERTO HUER, PLANTA PLAN
										 WHERE ((FINC.CODIGO = HUER.CODIGO_FINCA) AND (HUER.CODIGO = PLAN.CODIGO_HUERTO)
										 AND CODIGO_USUARIO IN (SELECT ID_USUARIO
				   				 	 										    FROM USUARIO
				   																  WHERE (EMPRESA = '$empresa')))
										 GROUP BY MES_ANIO
										 ORDER BY MES_ANIO_ORDER ASC;";
			}
			else if ($tipo_usuario == CLIENTE_PARTICULAR) {
				$consulta = "SELECT DATE_FORMAT(PLAN.FECHA_REGISTRO, '%c %Y') MES_ANIO_ORDER, DATE_FORMAT(PLAN.FECHA_REGISTRO, '%b %Y') MES_ANIO, COUNT(*)
										 FROM FINCA FINC, HUERTO HUER, PLANTA PLAN
										 WHERE ((FINC.CODIGO = HUER.CODIGO_FINCA) AND (HUER.CODIGO = PLAN.CODIGO_HUERTO)
										 AND (CODIGO_USUARIO = '$identificador'))
										 GROUP BY MES_ANIO
										 ORDER BY MES_ANIO_ORDER ASC;";
			}
			$resultado_consulta = mysql_query($consulta);
			while($fila = mysql_fetch_row($resultado_consulta)) {
				$categorias[$indice] = $fila[1];
				$datos[$indice] = round($fila[2], 2);
				$indice++;
			}
		break;
		case 4:
			$indice = 0;
			$categorias = 0;
			if ($tipo_usuario == CLIENTE_EMPRESA) {
				$consulta = "SELECT FINC.CODIGO, FINC.NOMBRE
										 FROM FINCA FINC
										 WHERE CODIGO_USUARIO IN (SELECT ID_USUARIO
																							FROM USUARIO
																							WHERE (EMPRESA = '$empresa'));";
			}
			else if ($tipo_usuario == CLIENTE_PARTICULAR) {
				$consulta = "SELECT FINC.CODIGO, FINC.NOMBRE
										 FROM FINCA FINC
										 WHERE CODIGO_USUARIO = '$identificador';";
			}
			$resultado_consulta = mysql_query($consulta);
			while($fila = mysql_fetch_row($resultado_consulta)) {
				$codigo_finca = $fila[0];
				$nombre_finca = $fila[1];
				$consulta_plantas = "SELECT COUNT(*)
														 FROM FINCA FINC, HUERTO HUER, PLANTA PLAN
														 WHERE ((FINC.CODIGO = HUER.CODIGO_FINCA) AND (HUER.CODIGO = PLAN.CODIGO_HUERTO)
														 AND (FINC.CODIGO = '$codigo_finca'));";
				$resultado_consulta_plantas = mysql_query($consulta_plantas);
				$fila = mysql_fetch_row($resultado_consulta_plantas);
				$categorias += $fila[0];
				$datos[$indice] = array('name' => $nombre_finca, 'y' => round($fila[0], 2));
				$indice++;
			}
		break;
	}
	$informacion = array('categorias' => $categorias,
											 'datos' => $datos);
	echo json_encode($informacion);
?>
