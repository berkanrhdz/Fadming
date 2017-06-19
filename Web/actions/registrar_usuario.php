<?php 

    require("conectar_basedatos.php");

	$nombre      = 'Eduardo';//$_POST['nombre'];
	$apellidos   = 'Escobar Alberto';//$_POST['apellidos'];
    $correo      = 'eduescal13@gmail.com';//$_POST['correo'];
    $usuario     = 'eduescal13';//$_POST['usuario'];
    $contrasena  = 'admin';//$_POST['contrasena'];

    $consulta = "INSERT INTO `USUARIO`(`IDENTIFICADOR`, `NOMBRE_USUARIO`, `NOMBRE`, `APELLIDOS`, `CORREO`, `CONTRASENA`, `FECHA_REGISTRO`, `CIF_EMPRESA`, `ROL`) 
    			 VALUES ($usuario', '$nombre', '$apellidos', '$correo', '$contrasena', '$telefono', CURRENT_TIMESTAMP, NULL, '1');";

	mysql_query($consulta);

	header("Location: http://localhost/GricApp/Web/index.php");
	
?> 