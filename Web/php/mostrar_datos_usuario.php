<?php
	session_start();
    require("conectar_basedatos.php");

    $identificador = 1;//$_SESSION['identificador'];

    $consulta = "SELECT `NOMBRE`, `APELLIDOS`, `CORREO`, `NOMBRE_USUARIO`, `CONTRASENA`, `FECHA_REGISTRO`, `CIF_EMPRESA`, `ROL` 
    			 FROM `USUARIO` 
    			 WHERE `ID_USUARIO` = $identificador;";

	$resultado_consulta = mysql_query($consulta);	
	$datos = mysql_fetch_array($resultado_consulta);

	echo $datos[0];

    /*if(is_null($datos[0])) {
        $informacion[] = array('imagen'=> 'no_disponible');
    }
    else {
        $imagen_base64  = base64_encode($datos[1]); // Codificación de la imagen a base64.
        $informacion[] = array('nombre'=> $datos[0], 'imagen'=> $imagen_base64);
    }
		
	echo json_encode($informacion); */
?> 