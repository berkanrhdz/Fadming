<?php
	session_start();
  require("conectar_basedatos.php");

  $codigo_empresa = $_SESSION['empresa'];

	$consulta = "SELECT USU.ID_USUARIO
							 FROM USUARIO USU, EMPRESA EMP
							 WHERE ((USU.EMPRESA = EMP.CODIGO) AND (EMP.CODIGO = '$codigo_empresa'))
							 LIMIT 1;";

	$resultado_consulta = mysql_query($consulta);
	$datos = mysql_fetch_row($resultado_consulta);
	$administrador = $datos[0];

	$consulta = "SELECT COUNT(*)
							 FROM FINCA
							 WHERE (CODIGO_USUARIO = '$administrador');";

	$resultado_consulta = mysql_query($consulta);
	$datos = mysql_fetch_row($resultado_consulta);
	$numero_fincas = $datos[0];

	$consulta = "SELECT COUNT(*)
							 FROM FINCA FINC, HUERTO HUER
							 WHERE ((FINC.CODIGO = HUER.CODIGO_FINCA) AND (FINC.CODIGO_USUARIO = $administrador));";

	$resultado_consulta = mysql_query($consulta);
	$datos = mysql_fetch_row($resultado_consulta);
	$numero_huertos = $datos[0];

	$consulta = "SELECT COUNT(*)
							 FROM FINCA FINC, HUERTO HUER, PLANTA PLAN
							 WHERE ((FINC.CODIGO = HUER.CODIGO_FINCA) AND (HUER.CODIGO = PLAN.CODIGO_HUERTO)
							 AND (FINC.CODIGO_USUARIO = '$administrador'));";

	$resultado_consulta = mysql_query($consulta);
	$datos = mysql_fetch_row($resultado_consulta);
	$numero_plantas = $datos[0];

	$consulta = "SELECT COUNT(*)
							 FROM USUARIO
							 WHERE (EMPRESA = '$codigo_empresa');";

	$resultado_consulta = mysql_query($consulta);
	$datos = mysql_fetch_row($resultado_consulta);
	$numero_usuarios = $datos[0];

	$consulta = "SELECT PLAN.NOMBRE, COUNT(*) AS COUNT
							 FROM FINCA FINC, HUERTO HUER, PLANTA PLAN
							 WHERE ((FINC.CODIGO = HUER.CODIGO_FINCA) AND (HUER.CODIGO = PLAN.CODIGO_HUERTO)
							 AND (FINC.CODIGO_USUARIO = '$administrador'))
							 GROUP BY NOMBRE
							 ORDER BY COUNT DESC
							 LIMIT 1;";

	$resultado_consulta = mysql_query($consulta);
	$datos = mysql_fetch_row($resultado_consulta);
	$planta_comun = $datos[0];
	if (is_null($planta_comun)) {
		$planta_comun = "-";
	}

	$consulta = "SELECT FINC.NOMBRE, COUNT(*) AS COUNT
							 FROM FINCA FINC, HUERTO HUER, PLANTA PLAN
							 WHERE ((FINC.CODIGO = HUER.CODIGO_FINCA) AND (HUER.CODIGO = PLAN.CODIGO_HUERTO) AND (FINC.CODIGO_USUARIO = '$administrador'))
							 GROUP BY FINC.NOMBRE
							 ORDER BY COUNT DESC
							 LIMIT 1;";

	$resultado_consulta = mysql_query($consulta);
	$datos = mysql_fetch_row($resultado_consulta);
	$finca_mayor = $datos[0];
	if (is_null($finca_mayor)) {
		$finca_mayor = "-";
	}

	$consulta = "SELECT HUER.NOMBRE, COUNT(*) AS COUNT
							 FROM FINCA FINC, HUERTO HUER, PLANTA PLAN
							 WHERE ((FINC.CODIGO = HUER.CODIGO_FINCA) AND (HUER.CODIGO = PLAN.CODIGO_HUERTO) AND (FINC.CODIGO_USUARIO = '$administrador'))
							 GROUP BY HUER.NOMBRE
							 ORDER BY COUNT DESC
							 LIMIT 1;";

	$resultado_consulta = mysql_query($consulta);
	$datos = mysql_fetch_row($resultado_consulta);
	$huerto_mayor = $datos[0];
	if (is_null($huerto_mayor)) {
		$huerto_mayor = "-";
	}

	$informacion[] = array('n_fincas'=> $numero_fincas,
												 'n_huertos'=> $numero_huertos,
												 'n_plantas'=> $numero_plantas,
											 	 'n_usuarios'=> $numero_usuarios,
											 	 'planta_comun'=> $planta_comun,
											   'finca_mayor'=> $finca_mayor,
											 	 'huerto_mayor'=> $huerto_mayor);

	echo json_encode($informacion);
?>
