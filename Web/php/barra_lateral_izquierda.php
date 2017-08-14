<?php
	error_reporting(0);
  require("conectar_basedatos.php");
	define('CLIENTE_PARTICULAR', '1');
	define('CLIENTE_EMPRESA', '2');

  $tipo = $_SESSION['tipo'];

	if ($tipo == CLIENTE_EMPRESA) {
		echo "<div class='fila-acceso' id='empresa'>" .
						"<a href='empresas.php'><div id='icono-empresa'></div><div class='nombre-acceso' id='texto-empresa'>Empresas</div></a>" .
				 "</div>" .
				 "<div class='fila-acceso' id='usuario'>" .
				 		"<div id='icono-usuario'></div><div class='nombre-acceso' id='texto-usuario'>Usuarios</div>" .
				 "</div>" .
				 "<div class='fila-acceso' id='estado'>" .
				 		"<a href='estados.php'><div id='icono-estado'></div><div class='nombre-acceso' id='texto-estado'>Estados</div></a>" .
				 "</div>" .
				 "<div class='fila-acceso' id='finca'>" .
				 	  "<div id='icono-finca'></div><div class='nombre-acceso' id='texto-finca'>Fincas</div>" .
				 "</div>" .
				 "<div class='fila-acceso' id='huerto'>" .
				 		"<div id='icono-huerto'></div><div class='nombre-acceso' id='texto-huerto'>Huertos</div>" .
				 "</div>" .
				 "<div class='fila-acceso' id='planta'>" .
				 		"<a href='plantas.php'><div id='icono-planta'></div><div class='nombre-acceso' id='texto-planta'>Plantas</div></a>" .
				 "</div>";
			 }
	else if ($tipo == CLIENTE_PARTICULAR) {
		echo "<div class='fila-acceso' id='estado'>" .
					  "<a href='estados.php'><div id='icono-estado'></div><div class='nombre-acceso' id='texto-estado'>Estados</div></a>" .
				 "</div>" .
				 "<div class='fila-acceso' id='finca'>" .
					  "<div id='icono-finca'></div><div class='nombre-acceso' id='texto-finca'>Fincas</div>" .
				 "</div>" .
				 "<div class='fila-acceso' id='huerto'>" .
					  "<div id='icono-huerto'></div><div class='nombre-acceso' id='texto-huerto'>Huertos</div>" .
				 "</div>" .
				 "<div class='fila-acceso' id='planta'>" .
					  "<a href='plantas.php'><div id='icono-planta'></div><div class='nombre-acceso' id='texto-planta'>Plantas</div></a>" .
				 "</div>";
	}
?>
