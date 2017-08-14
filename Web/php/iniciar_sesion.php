<?php
	session_start();
	require("conectar_basedatos.php");
	define('ERROR_LOGIN', '-1');
	define('LOGIN_CORRECTO', '1');

  $usuario    = $_POST['usuario'];
  $contrasena = $_POST['contrasena'];

  $clave = 'gricapp, una aplicación del futuro';
  $contrasena_encriptada = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($clave), $contrasena, MCRYPT_MODE_CBC, md5(md5($clave))));

  $consulta = "SELECT ID_USUARIO, TIPO, EMPRESA
	    		     FROM USUARIO
	    		     WHERE ((NOMBRE_USUARIO = '$usuario') AND (CONTRASENA = '$contrasena_encriptada'))
	    		     LIMIT 1;";

	$resultado_consulta = mysql_query($consulta);
	$datos = mysql_fetch_array($resultado_consulta);
	if(!is_null($datos[0])) {
		$informacion[] = array('respuesta'=> LOGIN_CORRECTO);
		$_SESSION['identificador'] = $datos[0];
		$_SESSION['usuario'] = $usuario;
		$_SESSION['tipo'] = $datos[1];
		$_SESSION['empresa'] = $datos[2];
	}
	else {
		$informacion[] = array('respuesta'=> ERROR_LOGIN);
	}
	echo json_encode($informacion);
?>
