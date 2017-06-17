<?php 
    session_start(); 

    require("conectar_basedatos.php");

    $usuario    = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    $consulta = "SELECT DNI
	    		 FROM USUARIO
	    		 WHERE ((NOMBRE_USUARIO = '$usuario') AND (CONTRASENA = '$contrasena')) 
	    		 LIMIT 1;";

	$resultado_consulta = mysql_query($consulta);
	$datos = mysql_fetch_array($resultado_consulta);
	$dni = $datos[0];

	$_SESSION['dni'] = $dni;

	// ----------- Obtención del resto de información -----------

	$consulta_general = "SELECT NOMBRE, APELLIDO1, APELLIDO2 
	    			 	 FROM USUARIO
	    		     	 WHERE DNI = '$dni'";

	$resultado_consulta_general = mysql_query($consulta_general);
	$datos = mysql_fetch_array($resultado_consulta_general);

	$_SESSION['nombre'] = $datos[0];
	$_SESSION['apellido1'] = $datos[1];
	$_SESSION['apellido2'] = $datos[2];
		    
	header("Location: http://localhost/GricApp/Web/perfil.php");

?> 