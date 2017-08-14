<?php
    session_start();
    require("conectar_basedatos.php");

    $codigo_empresa    = $_SESSION['empresa'];
    $nueva_contrasena  = $_POST['contrasena'];

    $clave = 'gricapp, una aplicación del futuro';
    $contrasena_encriptada = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($clave), $nueva_contrasena, MCRYPT_MODE_CBC, md5(md5($clave))));

    $consulta = "UPDATE EMPRESA
    			       SET CONTRASENA = '$contrasena_encriptada'
	    		       WHERE CODIGO = '$codigo_empresa';";

    mysql_query($consulta);
?>
