<?php
	session_start();
  require("conectar_basedatos.php");

  $identificador = $_SESSION['identificador'];
	$consulta = "SELECT NOMBRE, APELLIDOS, CORREO, NOMBRE_USUARIO, DATE_FORMAT(FECHA_REGISTRO, '%d-%m-%Y') FECHA, ROL.TIPO
    			 		 FROM USUARIO USU, ROL ROL
    			     WHERE (USU.ROL = ROL.VALOR) AND (USU.ID_USUARIO = $identificador)";

	$resultado_consulta = mysql_query($consulta);
	$datos = mysql_fetch_array($resultado_consulta);

  if(!is_null($datos[0])) {
      $informacion[] = array('nombre'=> $datos[0],
        					   				 'apellidos'=> $datos[1],
        					           'correo'=> $datos[2],
        					           'usuario'=> $datos[3],
        					           'fecha_registro'=> $datos[4],
        					           'rol'=> $datos[5]);
  }
	echo json_encode($informacion);
?>
