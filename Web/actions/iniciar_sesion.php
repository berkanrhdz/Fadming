<?php 
    session_start(); 

    require("conectar_database.php");

    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];

    if(filter_var($correo, FILTER_VALIDATE_EMAIL)) { // Comprobamos si se ha introducido un correo.

    	$consulta = "SELECT IDENTIFICADOR 
	    			 FROM USUARIO
	    		     WHERE ((CORREO = '$correo') AND (CONTRASENA = '$contrasena')) 
	    			 LIMIT 1;";

		$resultado_consulta = mysql_query($consulta);
		$datos = mysql_fetch_array($resultado_consulta);
		$identificador = $datos[0];

		$_SESSION['id-usuario'] = $identificador;

		// ----------- Obtención del resto de información -----------

		$consulta_general = "SELECT NOMBRE, APELLIDOS, date_format(FECHA_NACIMIENTO, '%d-%m-%Y'), TELEFONO, SEXO 
	    			 		 FROM USUARIO
	    		     		 WHERE IDENTIFICADOR = '$identificador'";

	    $resultado_consulta_general = mysql_query($consulta_general);
		$datos = mysql_fetch_array($resultado_consulta_general);

		$_SESSION['nombre-completo'] = $datos[0] . " " . $datos[1];
		$_SESSION['fecha'] = $datos[2];
		$_SESSION['telefono'] = $datos[3];
		$_SESSION['correo'] = $correo;
		$_SESSION['sexo'] = $datos[4];

		$consulta_comentarios = "SELECT COUNT(*), date_format(MAX(FECHA), '%d-%m-%Y') 
								 FROM VALORACION 
								 WHERE ID_USUARIO = '$identificador'";

		$resultado_consulta_comentarios = mysql_query($consulta_comentarios);
		$datos = mysql_fetch_array($resultado_consulta_comentarios);

		$_SESSION['numero-comentarios'] = $datos[0];
		$_SESSION['ultimo-comentario'] = $datos[1];
		    
		header("Location: http://localhost/Cafesit/perfil_personal.php");
	}
	else {
		echo "No ha introducido una dirección de correo"; 
	}

?> 