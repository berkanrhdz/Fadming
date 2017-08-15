<?php
	error_reporting(0);
  require("conectar_basedatos.php");
	define('ADMINISTRADOR', '1');

  $rol = $_SESSION['rol'];

	if ($rol == ADMINISTRADOR) {
		echo "<div id='mapa' style='height:63%;'></div>" .
		     "<div class='contenedor-cambiar-contrasena'>" .
		     "<div id='boton-cambiar-contrasena'>Cambiar contraseña de acceso</div>" .
		      	"<div class='contenedor-input-nueva'>" .
		           "<div class='contenedor-input-cambio'>" .
		            	"<div class='contenedor-inputs'>" .
		               		"<input type='submit' id='boton-atras' value=' '></input>" .
		                  "<input id='nueva-contrasena' name='nueva-contrasena' type='password' autocomplete='off' placeholder='Nueva contraseña'></input>" .
		                  "<input id='repetir-nueva-contrasena' name='repetir-nueva-contrasena' type='password' autocomplete='off' placeholder='Repetir contraseña'></input>" .
		                  "<input type='submit' id='boton-nueva-contrasena' value='Actualizar'></input>" .
		              "</div>" .
		           "</div>" .
		       "</div>" .
		    "</div>";
			 }
	else {
		echo "<div id='mapa' style='height:83%;'></div>";
	}
?>
