<?php
  session_start();
  require("conectar_basedatos.php");

	$informacion = [];
  $usuarios_permisos = [];
  $numero_fila = 0;
  $codigo_huerto = $_POST['huerto'];
  $codigo_empresa = $_SESSION['empresa'];
  $consulta_permisos = "SELECT CODIGO_USUARIO
                        FROM HUERTO_PERMISO
                        WHERE (CODIGO_HUERTO = '$codigo_huerto')";

  $resultado_consulta_permisos = mysql_query($consulta_permisos);
  while($fila_permisos = mysql_fetch_row($resultado_consulta_permisos)) {
    $usuarios_permisos[$numero_fila] = $fila_permisos[0];
    $numero_fila++;
  }
  $consulta = "SELECT ID_USUARIO, USU.NOMBRE, APELLIDOS, IMAGEN, ROL.NOMBRE
               FROM USUARIO USU, ROL ROL
               WHERE ((USU.ROL = ROL.VALOR) AND (USU.ROL != 1) AND (EMPRESA = '$codigo_empresa'))
               ORDER BY USU.NOMBRE ASC;";

  $resultado_consulta = mysql_query($consulta);
  while($fila = mysql_fetch_row($resultado_consulta)) {
    $imagen_base64 = base64_encode($fila[3]); // Codificación de la imagen a base64.
		$informacion[] = array('codigo' => $fila[0],
													 'nombre' => $fila[1],
                           'apellidos' => $fila[2],
                           'imagen' => $imagen_base64,
                           'rol' => $fila[4],
                           'permiso' => in_array($fila[0], $usuarios_permisos));
	}
	echo json_encode($informacion);
?>
