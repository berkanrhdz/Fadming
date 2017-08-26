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
			$consulta = "SELECT ESTADOS, ESTADO_ACTUAL
									 FROM PLANTA
									 WHERE (CODIGO = '$codigo_planta');";

			$resultado_consulta = mysql_query($consulta);
			while($fila = mysql_fetch_row($resultado_consulta)) {
				$estado_actual = $fila[1];
				$estados_plantas_formato = trim($fila[0]);
				$codigos_estados = explode(" ", $estados_plantas_formato);
			}
  	break;
	}
	$informacion = array('respuesta' => $respuesta);
	echo json_encode($informacion);
?>
