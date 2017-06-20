<?php 

    require("conectar_basedatos.php");

	$nombre      = $_POST['nombre'];
	$apellidos   = $_POST['apellidos'];
    $correo      = $_POST['correo'];
    $usuario     = $_POST['usuario'];
    $contrasena  = $_POST['contrasena'];

    $consulta = "INSERT INTO `USUARIO`(`ID_USUARIO`, `NOMBRE`, `APELLIDOS`, `CORREO`, `NOMBRE_USUARIO`, `CONTRASENA`, `FECHA_REGISTRO`, `CIF_EMPRESA`, `ROL`) 
    			 VALUES (NULL, '$nombre', '$apellidos', '$correo', '$usuario', '$contrasena', CURRENT_TIMESTAMP, NULL, '1');";

	mysql_query($consulta);	
?> 