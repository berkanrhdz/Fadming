<?php
	session_start();
  require("conectar_basedatos.php");
	define('CLIENTE_PARTICULAR', '1');
	define('CLIENTE_EMPRESA', '2');

	$tipo_usuario = $_SESSION['tipo'];
	$identificador = $_SESSION['identificador'];
	$empresa = $_SESSION['empresa'];
	$opcion = $_POST['opcion'];
	$opcion_estado = $_POST['estado'];

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
				$informacion[$indice] = array('nombre' => "<b>" . $nombre_huerto . "</b>Finca " . $nombre_finca,
			                                'cantidad' => $contador_plantas_no_finalizadas . " / " . $contador_plantas);
				$indice++;
			}
		break;
		case 2:
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
				$contador_plantas_no_finalizadas = 0;
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
							if ($codigos_estados[count($codigos_estados) - 1] != $estado_actual) {
								$contador_plantas_no_finalizadas++;
							}
						}
					}
				}
				$informacion[$indice] = array('nombre' => "<b>" . $nombre_finca,
																			'cantidad' => $contador_plantas_no_finalizadas . " / " . $contador_plantas);
				$indice++;
			}
  	break;
		case 3:
			$consulta = "SELECT FINC.NOMBRE, HUER.NOMBRE, COUNT(*) AS NUM_USUARIOS
									 FROM FINCA FINC, HUERTO_PERMISO PERM, HUERTO HUER
									 WHERE ((HUER.CODIGO = PERM.CODIGO_HUERTO) AND (FINC.CODIGO = HUER.CODIGO_FINCA)
									 AND (PERM.CODIGO_HUERTO IN (SELECT HUER.CODIGO
										 										       FROM FINCA FINC, HUERTO HUER
										 										       WHERE ((FINC.CODIGO = HUER.CODIGO_FINCA) AND (CODIGO_USUARIO IN (SELECT ID_USUARIO
																																																					      FROM USUARIO
																																																					      WHERE (EMPRESA = '$empresa')))))))
									 GROUP BY PERM.CODIGO_HUERTO;";
			$resultado_consulta = mysql_query($consulta);
			while ($fila = mysql_fetch_row($resultado_consulta)) {
				$huerto_formato = "<b>" . $fila[1] . "</b>Finca " . $fila[0];
				$informacion[] = array('nombre' => $huerto_formato,
															 'cantidad' => $fila[2]);
			}
		break;
		case 4:
		$consulta = "SELECT USU.NOMBRE_USUARIO, USU.NOMBRE, USU.APELLIDOS, ESTUSU.ESTADOS_REALIZADO NUM_ESTADOS
								 FROM ESTADO_USUARIO ESTUSU, USUARIO USU
								 WHERE ((USU.ID_USUARIO = ESTUSU.CODIGO_USUARIO)
								 AND (ESTUSU.CODIGO_USUARIO IN (SELECT ID_USUARIO
																								FROM USUARIO
																								WHERE ((EMPRESA = '$empresa') AND (ROL != 1)))))
								 ORDER BY USU.APELLIDOS ASC;";
			$resultado_consulta = mysql_query($consulta);
			while ($fila = mysql_fetch_row($resultado_consulta)) {
				$usuario_formato = "<b>" . $fila[1] . " " . $fila[2] . "</b>" . $fila[0];
				$informacion[] = array('nombre' => $usuario_formato,
															 'cantidad' => $fila[3]);
			}
		break;
		case 5:
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
				$contador_plantas_estado = 0;
				$consulta_huerto = "SELECT CODIGO
														FROM HUERTO
														WHERE CODIGO_FINCA = '$codigo_finca';";
				$resultado_consulta_huerto = mysql_query($consulta_huerto);
				while($fila = mysql_fetch_row($resultado_consulta_huerto)) {
					$codigo_huerto = $fila[0];
					$consulta_estados = "SELECT ESTADOS, ESTADO_ACTUAL
															 FROM PLANTA
															 WHERE ((CODIGO_HUERTO = '$codigo_huerto') AND (ESTADO_ACTUAL IS NOT NULL));";
					$resultado_consulta_estados = mysql_query($consulta_estados);
					while($fila_estados = mysql_fetch_row($resultado_consulta_estados)) {
						$contador_plantas++;
						$estado_actual = $fila_estados[1];
						$estados_plantas_formato = trim($fila_estados[0]);
						$codigos_estados = explode(" ", $estados_plantas_formato);
						if ($opcion_estado == $estado_actual) {
							$contador_plantas_estado++;
						}
					}
				}
				$informacion[$indice] = array('nombre' => "<b>" . $nombre_finca,
																			'cantidad' => $contador_plantas_estado . " / " . $contador_plantas);
				$indice++;
			}
		break;
		case 6:
		  $indice = 0;
			if ($tipo_usuario == CLIENTE_EMPRESA) {
				$consulta = "SELECT FINC.NOMBRE, HUER.CODIGO, HUER.NOMBRE
										 FROM FINCA FINC, HUERTO HUER
										 WHERE ((FINC.CODIGO = HUER.CODIGO_FINCA) AND (CODIGO_USUARIO IN (SELECT ID_USUARIO
																																											FROM USUARIO
																																											WHERE (EMPRESA = '$empresa'))));";
			}
			else if ($tipo_usuario == CLIENTE_PARTICULAR) {
				$consulta = "SELECT FINC.NOMBRE, HUER.CODIGO, HUER.NOMBRE
										 FROM FINCA FINC, HUERTO HUER
										 WHERE ((FINC.CODIGO = HUER.CODIGO_FINCA) AND (CODIGO_USUARIO = '$identificador'));";
			}
			$resultado_consulta = mysql_query($consulta);
			while($fila = mysql_fetch_row($resultado_consulta)) {
				$codigo_huerto = $fila[1];
				$contador_plantas = 0;
				$contador_plantas_estado = 0;
				$consulta_estados = "SELECT ESTADOS, ESTADO_ACTUAL
														 FROM PLANTA
														 WHERE ((CODIGO_HUERTO = '$codigo_huerto') AND (ESTADO_ACTUAL IS NOT NULL));";
				$resultado_consulta_estados = mysql_query($consulta_estados);
				while($fila_estados = mysql_fetch_row($resultado_consulta_estados)) {
					$contador_plantas++;
					$estado_actual = $fila_estados[1];
					$estados_plantas_formato = trim($fila_estados[0]);
					$codigos_estados = explode(" ", $estados_plantas_formato);
					if ($opcion_estado == $estado_actual) {
						$contador_plantas_estado++;
					}
				}
				$formato_huerto = "<b>" . $fila[0] . "</b>Finca " . $fila[2];
				$informacion[$indice] = array('nombre' => $formato_huerto,
																			'cantidad' => $contador_plantas_estado . " / " . $contador_plantas);
				$indice++;
			}
		break;
	}
	echo json_encode($informacion);
?>
