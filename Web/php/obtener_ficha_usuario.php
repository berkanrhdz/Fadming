<?php
	session_start();
  require("conectar_basedatos.php");

  $identificador = $_POST['identificador'];
	$consulta = "SELECT NOMBRE, APELLIDOS, CORREO, NOMBRE_USUARIO, DATE_FORMAT(FECHA_REGISTRO, '%d %Y') DIA_ANIO, DATE_FORMAT(FECHA_REGISTRO, '%c') MES, TO_DAYS(CURRENT_TIMESTAMP) - TO_DAYS(FECHA_REGISTRO) AS DIAS, IMAGEN
    			 		 FROM USUARIO
    			     WHERE (ID_USUARIO = $identificador);";

	$resultado_consulta = mysql_query($consulta);
	$datos = mysql_fetch_array($resultado_consulta);

	$imagen_base64 = base64_encode($datos[7]); // Codificación de la imagen a base64.
  if(!is_null($datos[0])) {
      $informacion[] = array('nombre'=> $datos[0],
        					   				 'apellidos'=> $datos[1],
        					           'correo'=> $datos[2],
        					           'usuario'=> $datos[3],
        					           'dia_anio'=> $datos[4],
														 'mes'=> $datos[5],
														 'dias'=> $datos[6],
													   'imagen'=> $imagen_base64);
  }
	echo json_encode($informacion);
?>
