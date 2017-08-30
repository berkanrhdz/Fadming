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
			$respuesta = $datos[0];
    break;
    case 2:
			if ($tipo_usuario == CLIENTE_EMPRESA) {
				$consulta = "SELECT HUER.NOMBRE, COUNT(PLAN.CODIGO) AS NUM_PLANTAS
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
				$consulta = "SELECT HUER.NOMBRE, COUNT(PLAN.CODIGO) AS NUM_PLANTAS
										 FROM FINCA FINC, HUERTO HUER, PLANTA PLAN
										 WHERE ((FINC.CODIGO = HUER.CODIGO_FINCA) AND (HUER.CODIGO = PLAN.CODIGO_HUERTO) AND (FINC.CODIGO_USUARIO = '$identificador'))
										 GROUP BY HUER.NOMBRE
										 ORDER BY NUM_PLANTAS DESC
										 LIMIT 1;";
			}
			$resultado_consulta = mysql_query($consulta);
			$datos = mysql_fetch_row($resultado_consulta);
			$respuesta = $datos[0];
    break;
    case 3:
			$nombre_mayor = "";
			$cantidad_mayor = INT_MIN;
			if ($tipo_usuario == CLIENTE_EMPRESA) {
				$consulta = "SELECT HUER.CODIGO, HUER.NOMBRE
									 	 FROM FINCA FINC, HUERTO HUER
									   WHERE ((FINC.CODIGO = HUER.CODIGO_FINCA) AND (CODIGO_USUARIO IN (SELECT ID_USUARIO
                                                                                      FROM USUARIO
                                                                                      WHERE (EMPRESA = '$empresa'))));";
			}
			else if ($tipo_usuario == CLIENTE_PARTICULAR) {
				$consulta = "SELECT HUER.CODIGO, HUER.NOMBRE
									 	 FROM FINCA FINC, HUERTO HUER
									   WHERE ((FINC.CODIGO = HUER.CODIGO_FINCA) AND (CODIGO_USUARIO = '$identificador'));";
			}
			$resultado_consulta = mysql_query($consulta);
			while($fila = mysql_fetch_row($resultado_consulta)) {
				$codigo_huerto = $fila[0];
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
					$nombre_mayor = $fila[1];
				}
				$respuesta = $nombre_mayor;
			}
  	break;
		case 4:
			$nombre_mayor = "";
			$cantidad_mayor = INT_MIN;
			if ($tipo_usuario == CLIENTE_EMPRESA) {
				$consulta = "SELECT HUER.CODIGO, HUER.NOMBRE
										 FROM FINCA FINC, HUERTO HUER
										 WHERE ((FINC.CODIGO = HUER.CODIGO_FINCA) AND (CODIGO_USUARIO IN (SELECT ID_USUARIO
																																											FROM USUARIO
																																											WHERE (EMPRESA = '$empresa'))));";
			}
			else if ($tipo_usuario == CLIENTE_PARTICULAR) {
				$consulta = "SELECT HUER.CODIGO, HUER.NOMBRE
										 FROM FINCA FINC, HUERTO HUER
										 WHERE ((FINC.CODIGO = HUER.CODIGO_FINCA) AND (CODIGO_USUARIO = '$identificador'));";
			}
			$resultado_consulta = mysql_query($consulta);
			while($fila = mysql_fetch_row($resultado_consulta)) {
				$codigo_huerto = $fila[0];
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
					$nombre_mayor = $fila[1];
				}
				$respuesta = $nombre_mayor;
			}
		break;
	}
	$informacion = array('respuesta' => $respuesta);
	echo json_encode($informacion);
?>
