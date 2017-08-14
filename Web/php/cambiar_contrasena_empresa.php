<?php
    session_start();
    require("conectar_basedatos.php");

    $identificador     = $_SESSION['identificador'];
    $nueva_contrasena  = $_POST['nueva-contrasena'];

    $clave = 'gricapp, una aplicación del futuro';
    $contrasena_encriptada = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($clave), $nueva_contrasena, MCRYPT_MODE_CBC, md5(md5($clave))));

    if(empty($nueva_contrasena) == false) {
    	$consulta = "UPDATE EMPRESA
    			         SET CONTRASENA = '$contrasena_encriptada'
	    		         WHERE ID_USUARIO = '$identificador';";
    }
    else {
        echo "No ha introducido una nueva contraseña";
    }
	mysql_query($consulta);
?>
