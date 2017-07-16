<?php
	session_start();
  require("conectar_basedatos.php");

	$numero_fila = 0;
  $identificador = 1;//$_SESSION['identificador'];
	$consulta = "SELECT FIN.NOMBRE, HUER.CODIGO, PLAN.NOMBRE
							 FROM FINCA FIN, EMPRESA EMP, USUARIO USU, HUERTO HUER, PLANTA PLAN
							 WHERE ((PLAN.CODIGO_HUERTO = HUER.CODIGO) AND (HUER.CODIGO_FINCA = FIN.CODIGO)
							 AND (FIN.CODIGO_EMPRESA = EMP.CODIGO) AND (EMP.CODIGO_USUARIO = USU.ID_USUARIO)
							 AND (USU.ID_USUARIO = 1))
							 ORDER BY FIN.NOMBRE ASC, HUER.CODIGO ASC, PLAN.NOMBRE ASC;";

	$resultado_consulta = mysql_query($consulta);
	while($fila = mysql_fetch_row($resultado_consulta)) {
		$nombre_finca = $fila[0];
		echo $nombre_finca;
		/*$informacion[$numero_fila] = array('finca'=> $fila[0],
																			 'huerto'=> $fila[1],
							                         'planta'=> $fila[2]);
		$numero_fila = $numero_fila + 1;*/
	}
	//echo json_encode($informacion);
?>
