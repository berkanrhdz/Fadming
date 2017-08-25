<?php
  require("conectar_basedatos.php");

	$numero_fila = 0;
	$informacion;
	$codigo_planta = $_POST['planta'];
	$consulta = "SELECT ESTADOS, ESTADO_ACTUAL
							 FROM PLANTA
							 WHERE (CODIGO = '$codigo_planta');";

	$resultado_consulta = mysql_query($consulta);
	$fila = mysql_fetch_row($resultado_consulta);
  $estado_actual = $fila[1];
  $estados_plantas_formato = trim($fila[0]);
	$codigos_estados = explode(" ", $estados_plantas_formato);
	for ($i = 0; $i < count($codigos_estados); $i++) {
    $codigo = $codigos_estados[$i];
    $consulta_estados = "SELECT CODIGO, NOMBRE
  							 				 FROM ESTADO
                         WHERE (CODIGO = '$codigo')";
    $resultado_consulta_estados = mysql_query($consulta_estados);
    $datos = mysql_fetch_row($resultado_consulta_estados);
    if ($datos[0] == $estado_actual) {
      $actual = true;
    }
    else {
      $actual = false;
    }
    $informacion[$numero_fila] = array('codigo' => $datos[0],
                                       'nombre' => $datos[1],
                                       'actual' => $actual);
    $numero_fila = $numero_fila + 1;
	}
	echo json_encode($informacion);
?>
