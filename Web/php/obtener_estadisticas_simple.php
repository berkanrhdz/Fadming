<?php
	session_start();
  require("conectar_basedatos.php");
	define('CLIENTE_PARTICULAR', '1');
	define('CLIENTE_EMPRESA', '2');
	define('INT_MIN', -1);

	$tipo_usuario = $_SESSION['tipo'];
	$identificador = $_SESSION['identificador'];
	$empresa = $_SESSION['empresa'];
	$opcion = $_POST['opcion'];
	$opcion_estado = $_POST['estado'];

	switch ($opcion) {
    case 1:
			if ($tipo_usuario == CLIENTE_EMPRESA) {
				$consulta = "SELECT FINC.NOMBRE, COUNT(PLAN.CODIGO) AS NUM_PLANTAS
										 FROM FINCA FINC, HUERTO HUER, PLANTA PLAN
  								 	 WHERE ((FINC.CODIGO = HUER.CODIGO_FINCA) AND (HUER.CODIGO = PLAN.CODIGO_HUERTO)
										 AND (FINC.CODIGO_USUARIO IN (SELECT ID_USUARIO
                                                  FROM USUARIO
                                                  WHERE (EMPRESA = '$empresa'))))
										 GROUP BY FINC.NOMBRE
                     ORDER BY NUM_PLANTAS DESC
                     LIMIT 1;";
		  }
		  else if ($tipo_usuario == CLIENTE_PARTICULAR) {
				$consulta = "SELECT FINC.NOMBRE, COUNT(PLAN.CODIGO) AS NUM_PLANTAS
										 FROM FINCA FINC, HUERTO HUER, PLANTA PLAN
										 WHERE ((FINC.CODIGO = HUER.CODIGO_FINCA) AND (HUER.CODIGO = PLAN.CODIGO_HUERTO) AND (FINC.CODIGO_USUARIO = '$identificador'))
										 GROUP BY FINC.NOMBRE
										 ORDER BY NUM_PLANTAS DESC
										 LIMIT 1;";
			}
			$resultado_consulta = mysql_query($consulta);
			$datos = mysql_fetch_row($resultado_consulta);
			$respuesta = "<b>" . $datos[0];
    break;
    case 2:
			if ($tipo_usuario == CLIENTE_EMPRESA) {
				$consulta = "SELECT FINC.NOMBRE, HUER.NOMBRE, COUNT(PLAN.CODIGO) AS NUM_PLANTAS
										 FROM FINCA FINC, HUERTO HUER, PLANTA PLAN
										 WHERE ((FINC.CODIGO = HUER.CODIGO_FINCA) AND (HUER.CODIGO = PLAN.CODIGO_HUERTO)
										 AND (FINC.CODIGO_USUARIO IN (SELECT ID_USUARIO
																									FROM USUARIO
																									WHERE (EMPRESA = '$empresa'))))
										 GROUP BY HUER.NOMBRE
										 ORDER BY NUM_PLANTAS DESC
										 LIMIT 1;";
			}
			else if ($tipo_usuario == CLIENTE_PARTICULAR) {
				$consulta = "SELECT FINC.NOMBRE, HUER.NOMBRE, COUNT(PLAN.CODIGO) AS NUM_PLANTAS
										 FROM FINCA FINC, HUERTO HUER, PLANTA PLAN
										 WHERE ((FINC.CODIGO = HUER.CODIGO_FINCA) AND (HUER.CODIGO = PLAN.CODIGO_HUERTO) AND (FINC.CODIGO_USUARIO = '$identificador'))
										 GROUP BY HUER.NOMBRE
										 ORDER BY NUM_PLANTAS DESC
										 LIMIT 1;";
			}
			$resultado_consulta = mysql_query($consulta);
			$datos = mysql_fetch_row($resultado_consulta);
			$respuesta = "<b>" . $datos[1] . "</b>Finca " . $datos[0];
    break;
    case 3:
			$nombre_mayor = "";
			$cantidad_mayor = INT_MIN;
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
						$estado_actual = $fila_estados[1];
						$estados_plantas_formato = trim($fila_estados[0]);
						$codigos_estados = explode(" ", $estados_plantas_formato);
						if ($codigos_estados[count($codigos_estados) - 1] == $estado_actual) {
							$contador_plantas++;
						}
					}
				}
				if ($contador_plantas >= $cantidad_mayor) {
					$cantidad_mayor = $contador_plantas;
					$nombre_mayor = $nombre_finca;
				}
				$respuesta = "<b>" . $nombre_mayor;
			}
  	break;
		case 4:
			$nombre_mayor = "";
			$cantidad_mayor = INT_MIN;
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
				$consulta_estados = "SELECT ESTADOS, ESTADO_ACTUAL
														 FROM PLANTA
														 WHERE ((CODIGO_HUERTO = '$codigo_huerto') AND (ESTADO_ACTUAL IS NOT NULL));";
				$resultado_consulta_estados = mysql_query($consulta_estados);
				while($fila_estados = mysql_fetch_row($resultado_consulta_estados)) {
					$estado_actual = $fila_estados[1];
					$estados_plantas_formato = trim($fila_estados[0]);
					$codigos_estados = explode(" ", $estados_plantas_formato);
					if ($codigos_estados[count($codigos_estados) - 1] == $estado_actual) {
						$contador_plantas++;
					}
				}
				if ($contador_plantas >= $cantidad_mayor) {
					$cantidad_mayor = $contador_plantas;
					$nombre_mayor = $fila[2];
				}
				$respuesta = "<b>" . $nombre_mayor . "</b>Finca " . $fila[0];
			}
		break;
		case 5:
			$nombre_mayor = "";
			$cantidad_mayor = INT_MIN;
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
						$estado_actual = $fila_estados[1];
						$estados_plantas_formato = trim($fila_estados[0]);
						$codigos_estados = explode(" ", $estados_plantas_formato);
						if ($codigos_estados[count($codigos_estados) - 1] != $estado_actual) {
							$contador_plantas++;
						}
					}
				}
				if ($contador_plantas >= $cantidad_mayor) {
					$cantidad_mayor = $contador_plantas;
					$nombre_mayor = $nombre_finca;
				}
				$respuesta = "<b>" . $nombre_mayor;
			}
		break;
		case 6:
			$nombre_mayor = "";
			$cantidad_mayor = INT_MIN;
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
				$consulta_estados = "SELECT ESTADOS, ESTADO_ACTUAL
														 FROM PLANTA
														 WHERE ((CODIGO_HUERTO = '$codigo_huerto') AND (ESTADO_ACTUAL IS NOT NULL));";
				$resultado_consulta_estados = mysql_query($consulta_estados);
				while($fila_estados = mysql_fetch_row($resultado_consulta_estados)) {
					$estado_actual = $fila_estados[1];
					$estados_plantas_formato = trim($fila_estados[0]);
					$codigos_estados = explode(" ", $estados_plantas_formato);
					if ($codigos_estados[count($codigos_estados) - 1] != $estado_actual) {
						$contador_plantas++;
					}
				}
				if ($contador_plantas >= $cantidad_mayor) {
					$cantidad_mayor = $contador_plantas;
					$nombre_mayor = $fila[2];
				}
				$respuesta = "<b>" . $nombre_mayor . "</b>Finca " . $fila[0];
			}
		break;
		case 7:
			$consulta = "SELECT FINC.NOMBRE, HUER.NOMBRE, COUNT(*) AS NUM_USUARIOS
									 FROM FINCA FINC, HUERTO_PERMISO PERM, HUERTO HUER
									 WHERE ((HUER.CODIGO = PERM.CODIGO_HUERTO) AND (FINC.CODIGO = HUER.CODIGO_FINCA)
									 AND (PERM.CODIGO_HUERTO IN (SELECT HUER.CODIGO
										 										       FROM FINCA FINC, HUERTO HUER
										 										       WHERE ((FINC.CODIGO = HUER.CODIGO_FINCA) AND (CODIGO_USUARIO IN (SELECT ID_USUARIO
																																																					      FROM USUARIO
																																																					      WHERE (EMPRESA = '$empresa')))))))
									 GROUP BY PERM.CODIGO_HUERTO
									 ORDER BY NUM_USUARIOS DESC
									 LIMIT 1;";
			$resultado_consulta = mysql_query($consulta);
			$datos = mysql_fetch_row($resultado_consulta);
			$respuesta = "<b>" . $datos[1] . "</b>Finca " . $datos[0];
		break;
		case 8:
			$consulta = "SELECT FINC.NOMBRE, HUER.NOMBRE, COUNT(*) AS NUM_USUARIOS
									 FROM FINCA FINC, HUERTO_PERMISO PERM, HUERTO HUER
									 WHERE ((HUER.CODIGO = PERM.CODIGO_HUERTO) AND (FINC.CODIGO = HUER.CODIGO_FINCA)
									 AND (PERM.CODIGO_HUERTO IN (SELECT HUER.CODIGO
																							 FROM FINCA FINC, HUERTO HUER
																							 WHERE ((FINC.CODIGO = HUER.CODIGO_FINCA) AND (CODIGO_USUARIO IN (SELECT ID_USUARIO
																																																								FROM USUARIO
																																																								WHERE (EMPRESA = '$empresa')))))))
									 GROUP BY PERM.CODIGO_HUERTO
									 ORDER BY NUM_USUARIOS ASC
									 LIMIT 1;";
			$resultado_consulta = mysql_query($consulta);
			$datos = mysql_fetch_row($resultado_consulta);
			$respuesta = "<b>" . $datos[1] . "</b>Finca " . $datos[0];
		break;
		case 9:
			$consulta = "SELECT USU.NOMBRE_USUARIO, USU.NOMBRE, USU.APELLIDOS, COUNT(*) AS NUM_HUERTOS
									 FROM HUERTO_PERMISO PERM, USUARIO USU
									 WHERE ((USU.ID_USUARIO = PERM.CODIGO_USUARIO)
									 AND (PERM.CODIGO_HUERTO IN (SELECT HUER.CODIGO
										 													 FROM FINCA FINC, HUERTO HUER
																							 WHERE ((FINC.CODIGO = HUER.CODIGO_FINCA) AND (CODIGO_USUARIO IN (SELECT ID_USUARIO
															   						 																																		FROM USUARIO
															   																																						    WHERE (EMPRESA = '$empresa')))))))
									 GROUP BY PERM.CODIGO_USUARIO
									 ORDER BY NUM_HUERTOS DESC
									 LIMIT 1;";
			$resultado_consulta = mysql_query($consulta);
			$datos = mysql_fetch_row($resultado_consulta);
			$respuesta = "<b>" . $datos[1] . " " . $datos[2] . "</b>" . $datos[0];
		break;
		case 10:
			$consulta = "SELECT USU.NOMBRE_USUARIO, USU.NOMBRE, USU.APELLIDOS, COUNT(*) AS NUM_HUERTOS
									 FROM HUERTO_PERMISO PERM, USUARIO USU
									 WHERE ((USU.ID_USUARIO = PERM.CODIGO_USUARIO)
									 AND (PERM.CODIGO_HUERTO IN (SELECT HUER.CODIGO
																							 FROM FINCA FINC, HUERTO HUER
																							 WHERE ((FINC.CODIGO = HUER.CODIGO_FINCA) AND (CODIGO_USUARIO IN (SELECT ID_USUARIO
																																																								FROM USUARIO
																																																								WHERE (EMPRESA = '$empresa')))))))
									 GROUP BY PERM.CODIGO_USUARIO
									 ORDER BY NUM_HUERTOS ASC
									 LIMIT 1;";
			$resultado_consulta = mysql_query($consulta);
			$datos = mysql_fetch_row($resultado_consulta);
			$respuesta = "<b>" . $datos[1] . " " . $datos[2] . "</b>" . $datos[0];
		break;
		case 11:
			$consulta = "SELECT USU.NOMBRE_USUARIO, USU.NOMBRE, USU.APELLIDOS, ESTUSU.ESTADOS_REALIZADO NUM_ESTADOS
									 FROM ESTADO_USUARIO ESTUSU, USUARIO USU
									 WHERE ((USU.ID_USUARIO = ESTUSU.CODIGO_USUARIO)
									 AND (ESTUSU.CODIGO_USUARIO IN (SELECT ID_USUARIO
							   																  FROM USUARIO
							   																  WHERE ((EMPRESA = '$empresa') AND (ROL != 1)))))
									 ORDER BY NUM_ESTADOS DESC
									 LIMIT 1;";
			$resultado_consulta = mysql_query($consulta);
			$datos = mysql_fetch_row($resultado_consulta);
			$respuesta = "<b>" . $datos[1] . " " . $datos[2] . "</b>" . $datos[0];
		break;
		case 12:
		$consulta = "SELECT USU.NOMBRE_USUARIO, USU.NOMBRE, USU.APELLIDOS, ESTUSU.ESTADOS_REALIZADO NUM_ESTADOS
								 FROM ESTADO_USUARIO ESTUSU, USUARIO USU
								 WHERE ((USU.ID_USUARIO = ESTUSU.CODIGO_USUARIO)
								 AND (ESTUSU.CODIGO_USUARIO IN (SELECT ID_USUARIO
																								FROM USUARIO
																								WHERE ((EMPRESA = '$empresa') AND (ROL != 1)))))
								 ORDER BY NUM_ESTADOS ASC
								 LIMIT 1;";
			$resultado_consulta = mysql_query($consulta);
			$datos = mysql_fetch_row($resultado_consulta);
			$respuesta = "<b>" . $datos[1] . " " . $datos[2] . "</b>" . $datos[0];
		break;
		case 13:
			$nombre_mayor = "";
			$cantidad_mayor = INT_MIN;
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
						$estado_actual = $fila_estados[1];
						$estados_plantas_formato = trim($fila_estados[0]);
						$codigos_estados = explode(" ", $estados_plantas_formato);
						if ($opcion_estado == $estado_actual) {
							$contador_plantas++;
						}
					}
				}
				if ($contador_plantas >= $cantidad_mayor) {
					$cantidad_mayor = $contador_plantas;
					$nombre_mayor = $nombre_finca;
				}
				$respuesta = "<b>" . $nombre_mayor;
			}
		break;
		case 14:
			$nombre_mayor = "";
			$cantidad_mayor = INT_MIN;
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
				$consulta_estados = "SELECT ESTADOS, ESTADO_ACTUAL
														 FROM PLANTA
														 WHERE ((CODIGO_HUERTO = '$codigo_huerto') AND (ESTADO_ACTUAL IS NOT NULL));";
				$resultado_consulta_estados = mysql_query($consulta_estados);
				while($fila_estados = mysql_fetch_row($resultado_consulta_estados)) {
					$estado_actual = $fila_estados[1];
					$estados_plantas_formato = trim($fila_estados[0]);
					$codigos_estados = explode(" ", $estados_plantas_formato);
					if ($opcion_estado == $estado_actual) {
						$contador_plantas++;
					}
				}
				if ($contador_plantas >= $cantidad_mayor) {
					$cantidad_mayor = $contador_plantas;
					$nombre_mayor = $fila[2];
				}
				$respuesta = "<b>" . $nombre_mayor . "</b>Finca " . $fila[0];
			}
		break;
	}
	$informacion = array('respuesta' => $respuesta);
	echo json_encode($informacion);
?>
