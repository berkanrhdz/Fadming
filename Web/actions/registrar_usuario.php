<?php 

    require("conectar_database.php");

	$nombre      = $_POST['nombre'];
	$apellidos   = $_POST['apellidos'];
	$fecha       = $_POST['fecha-nacimiento'];
	$sexo        = $_POST['sexo'];
	$correo 	 = $_POST['correo'];
    $telefono    = $_POST['telefono'];
    $contrasena  = $_POST['contrasena'];

    $consulta = "INSERT INTO `USUARIO`(`NOMBRE`, `APELLIDOS`, `FECHA_NACIMIENTO`, `SEXO`, `CORREO`, `TELEFONO`, `CONTRASENA`) 
	    	     VALUES ('$nombre','$apellidos','$fecha','$sexo','$correo','$telefono','$contrasena');";

	mysql_query($consulta);

	header("Location: http://localhost/Cafesit/index.php");
	
?> 