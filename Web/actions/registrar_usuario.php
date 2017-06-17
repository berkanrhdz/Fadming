<?php 

    require("conectar_basedatos.php");

	$nombre      = $_POST['nombre'];
	$apellido1   = $_POST['apellido1'];
	$apellido2   = $_POST['apellido2'];
	$dni         = $_POST['dni'];
	$telefono 	 = $_POST['telefono'];
    $correo      = $_POST['correo'];
    $usuario     = $_POST['usuario'];
    $contrasena  = $_POST['contrasena'];

    $consulta = "INSERT INTO `USUARIO`(`DNI`, `NOMBRE_USUARIO`, `NOMBRE`, `APELLIDO1`, `APELLIDO2`, `CORREO`, `CONTRASENA`, `TELEFONO`, `FECHA_REGISTRO`, `CIF_EMPRESA`, `ROL`) 
    			 VALUES ('$dni', '$usuario', '$nombre', '$apellido1', '$apellido2', '$correo', '$contrasena', '$telefono', CURRENT_TIMESTAMP, NULL, '1');";

	mysql_query($consulta);

	header("Location: http://localhost/GricApp/Web/index.php");
	
?> 