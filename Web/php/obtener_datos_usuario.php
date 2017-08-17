<?php
	session_start();
  require("conectar_basedatos.php");

  $identificador = $_SESSION['identificador'];
	$consulta = "SELECT USU.NOMBRE, APELLIDOS, CORREO, NOMBRE_USUARIO, DATE_FORMAT(FECHA_REGISTRO, '%d-%m-%Y') FECHA, ROL.NOMBRE, IMAGEN
    			 		 FROM USUARIO USU, ROL ROL
    			     WHERE (USU.ROL = ROL.VALOR) AND (USU.ID_USUARIO = $identificador);";

	$resultado_consulta = mysql_query($consulta);
	$datos = mysql_fetch_array($resultado_consulta);

	$imagen_base64 = base64_encode($datos[6]); // Codificación de la imagen a base64.
  if(!is_null($datos[0])) {
      $informacion[] = array('nombre'=> $datos[0],
        					   				 'apellidos'=> $datos[1],
        					           'correo'=> $datos[2],
        					           'usuario'=> $datos[3],
        					           'fecha_registro'=> $datos[4],
        					           'rol'=> $datos[5],
													   'imagen'=> $imagen_base64);
  }
	echo json_encode($informacion);
?>
