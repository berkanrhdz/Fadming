<?php 

    require("conectar_basedatos.php");

	$nombre      = $_POST['nombre'];
	$apellidos   = $_POST['apellidos'];
	$usuario     = $_POST['usuario'];
	$correo 	 = $_POST['correo'];
    $contrasena  = $_POST['contrasena'];

    $clave = 'gricapp, una aplicación del futuro'; 
    $contrasena_encriptada = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($clave), $contrasena, MCRYPT_MODE_CBC, md5(md5($clave))));

    $consulta = "INSERT INTO `USUARIO`(`ID_USUARIO`, `NOMBRE`, `APELLIDOS`, `CORREO`, `NOMBRE_USUARIO`, `CONTRASENA`, `FECHA_REGISTRO`, `CIF_EMPRESA`, `ROL`) 
	    	     VALUES (NULL, '$nombre', '$apellidos', '$correo', '$usuario', '$correo', '$contrasena_encriptada', CURRENT_TIMESTAMP, NULL, '1');";

	mysql_query($consulta);	
?> 