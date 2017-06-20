<?php 

    require("conectar_basedatos.php");

	$nombre      = 'Eduardo';//$_POST['nombre'];
	$apellidos   = 'Escobar Alberto';//$_POST['apellidos'];
    $correo      = 'eduescal13@gmail.com';//$_POST['correo'];
    $usuario     = 'eduescal13';//$_POST['usuario'];
    $contrasena  = 'admin';//$_POST['contrasena'];

    $consulta = "INSERT INTO `USUARIO`(`ID_USUARIO`, `NOMBRE`, `APELLIDOS`, `CORREO`, `NOMBRE_USUARIO`, `CONTRASENA`, `FECHA_REGISTRO`, `CIF_EMPRESA`, `ROL`) 
    			 VALUES ('$nombre', '$apellidos', '$correo', '$usuario', '$contrasena', CURRENT_TIMESTAMP, NULL, '1');";

	mysql_query($consulta);	
?> 