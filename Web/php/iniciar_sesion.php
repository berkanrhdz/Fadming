<?php 
    session_start(); 

    require("conectar_basedatos.php");

    $usuario    = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    $consulta = "SELECT ID_USUARIO
	    		 FROM USUARIO
	    		 WHERE ((USUARIO = '$usuario') AND (CONTRASENA = '$contrasena')) 
	    		 LIMIT 1;";

	$resultado_consulta = mysql_query($consulta);
	$datos = mysql_fetch_array($resultado_consulta);
	$identificador = $datos[0];

	$_SESSION['identificador'] = $identificador;

	// ----------- Obtención del resto de información -----------

	$consulta_general = "SELECT NOMBRE_USUARIO
	    			 	 FROM USUARIO
	    		     	 WHERE ID_USUARIO = '$identificador'";

	$resultado_consulta_general = mysql_query($consulta_general);
    $datos = mysql_fetch_array($resultado_consulta_general);

    $_SESSION['usuario'] = $datos[0];
		    
	header("Location: http://localhost/GricApp/Web/perfil.php");
?> 