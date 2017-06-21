<?php
	session_start();

    $servername = "localhost";
	$username = "root";
	$password = "";
	$databasename = "GRICAPP_BD";

	// CONEXIÓN SERVIDOR
	$link = mysql_connect($servername, $username, $password, $databasename);
	mysql_set_charset("utf8", $link);
	$conexion = mysql_select_db($databasename, $link);

	if($conexion == false) {
		die("No se ha podido realizar la conexión. ERROR: " . mysql_error());
	}

    $usuario    = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];
 
    $clave = 'gricapp, una aplicación del futuro'; 
    $contrasena_encriptada = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($clave), $contrasena, MCRYPT_MODE_CBC, md5(md5($clave))));

    $consulta = "SELECT ID_USUARIO
	    		 FROM USUARIO
	    		 WHERE ((NOMBRE_USUARIO = '$usuario') AND (CONTRASENA = '$contrasena_encriptada')) 
	    		 LIMIT 1;";

	$resultado_consulta = mysql_query($consulta);
	$datos = mysql_fetch_array($resultado_consulta);
	$identificador = $datos[0];	

	$_SESSION['identificador'] = $identificador;
	$_SESSION['usuario'] = $usuario;    
?> 