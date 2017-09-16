<?php
  define('PERMISO', 1);
  define('NO_PERMISO', -1);
  require("conectar_basedatos.php");

	$numero_fila = 0;
	$informacion = [];
  $huertos_permiso = [];
  $codigo_usuario = $_POST['usuario'];
	$codigo_planta = $_POST['planta'];

  $consulta = "SELECT ROL
               FROM USUARIO
               WHERE (ID_USUARIO = '$codigo_usuario');";

  $resultado_consulta = mysql_query($consulta);
  $datos = mysql_fetch_array($resultado_consulta);
  $rol_usuario = $datos[0];
  if ($rol_usuario != 1) {
    $consulta = "SELECT CODIGO_HUERTO
                 FROM HUERTO_PERMISO
                 WHERE (CODIGO_USUARIO = '$codigo_usuario');";

  	$resultado_consulta = mysql_query($consulta);
    while ($fila = mysql_fetch_row($resultado_consulta)) {
      $huertos_permiso[$numero_fila] = $fila[0];
      $numero_fila++;
    }

    $consulta = "SELECT CODIGO_HUERTO
                 FROM PLANTA
                 WHERE (CODIGO = '$codigo_planta');";

    $resultado_consulta = mysql_query($consulta);
    $datos = mysql_fetch_array($resultado_consulta);
  }

  if (in_array($datos[0], $huertos_permiso) || ($rol_usuario == 1)) {
    $numero_fila = 0;
    $consulta = "SELECT ESTADOS, ESTADO_ACTUAL
  							 FROM PLANTA
  							 WHERE (CODIGO = '$codigo_planta');";

  	$resultado_consulta = mysql_query($consulta);
  	$fila = mysql_fetch_row($resultado_consulta);
  	$codigos_estados = explode(" ", $fila[0]);
    $estado_actual = $fila[1];
  	$where_consulta = " WHERE (CODIGO = '$codigos_estados[0]')";
  	for ($i = 1; $i < count($codigos_estados); $i++) {
  		$where_consulta = $where_consulta . " OR (CODIGO = '$codigos_estados[$i]')";
  	}
  	$consulta_estados = "SELECT CODIGO, NOMBRE, DESCRIPCION
  							 				 FROM ESTADO";
    $consulta_estados = $consulta_estados . $where_consulta . ";";
  	$resultado_consulta_estados = mysql_query($consulta_estados);
  	while ($fila = mysql_fetch_row($resultado_consulta_estados)) {
      if ($fila[0] == $estado_actual) {
        $estados[$numero_fila] = array('codigo' => $fila[0],
    																   'nombre' => $fila[1],
                                       'descripcion' => $fila[2],
                                       'actual' => true);
      }
      else {
        $estados[$numero_fila] = array('codigo' => $fila[0],
                                       'nombre' => $fila[1],
                                       'descripcion' => $fila[2],
                                       'actual' => false);
      }
  	  $numero_fila = $numero_fila + 1;
  	}
    $informacion[0] = array('respuesta' => PERMISO);
    $informacion[1] = array('estados' => $estados);
  }
  else {
    $informacion[0] = array('respuesta' => NO_PERMISO);
  }
	echo json_encode($informacion);
?>
