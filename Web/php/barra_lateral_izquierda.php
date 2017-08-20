<?php
	error_reporting(0);
  require("conectar_basedatos.php");
	define('CLIENTE_PARTICULAR', '1');
	define('CLIENTE_EMPRESA', '2');
	define('ADMINISTRADOR', '1');

  $tipo = $_SESSION['tipo'];
	$rol  = $_SESSION['rol'];

	if ($tipo == CLIENTE_EMPRESA) {
		if ($rol == ADMINISTRADOR) {
			echo "<div class='fila-acceso' id='empresa'>" .
							"<a href='empresas.php'><div id='icono-empresa'></div><div class='nombre-acceso' id='texto-empresa'>Empresa</div><div id='icono-seleccion'></div></a>" .
					 "</div>" .
					 "<div class='fila-acceso' id='usuario'>" .
					 		"<a href='usuarios.php'><div id='icono-usuario'></div><div class='nombre-acceso' id='texto-usuario'>Usuarios</div><div id='icono-seleccion'></div></a>" .
					 "</div>" .
					 "<div class='fila-acceso' id='estado'>" .
					 		"<a href='estados.php'><div id='icono-estado'></div><div class='nombre-acceso' id='texto-estado'>Estados</div><div id='icono-seleccion'></div></a>" .
					 "</div>" .
					 "<div class='fila-acceso' id='finca'>" .
					 		"<a href='fincas.php'><div id='icono-finca'></div><div class='nombre-acceso' id='texto-finca'>Fincas</div><div id='icono-seleccion'></div></a>" .
					 "</div>" .
					 "<div class='fila-acceso' id='huerto'>" .
					 		"<div id='icono-huerto'></div><div class='nombre-acceso' id='texto-huerto'>Huertos</div>" .
					 "</div>" .
					 "<div class='fila-acceso' id='planta'>" .
					 		"<a href='plantas.php'><div id='icono-planta'></div><div class='nombre-acceso' id='texto-planta'>Plantas</div><div id='icono-seleccion'></div></a>" .
					 "</div>";
		}
		else {
			echo "<div class='fila-acceso' id='empresa'>" .
							"<a href='empresas.php'><div id='icono-empresa'></div><div class='nombre-acceso' id='texto-empresa'>Empresas</div><div id='icono-seleccion'></div></a>" .
					 "</div>" .
					 "<div class='fila-acceso' id='estado'>" .
							"<a href='estados.php'><div id='icono-estado'></div><div class='nombre-acceso' id='texto-estado'>Estados</div><div id='icono-seleccion'></div></a>" .
					 "</div>" .
					 "<div class='fila-acceso' id='finca'>" .
					 		"<a href='fincas.php'><div id='icono-finca'></div><div class='nombre-acceso' id='texto-finca'>Fincas</div><div id='icono-seleccion'></div></a>" .
					 "</div>" .
					 "<div class='fila-acceso' id='huerto'>" .
							"<div id='icono-huerto'></div><div class='nombre-acceso' id='texto-huerto'>Huertos</div>" .
					 "</div>" .
					 "<div class='fila-acceso' id='planta'>" .
							"<a href='plantas.php'><div id='icono-planta'></div><div class='nombre-acceso' id='texto-planta'>Plantas</div><div id='icono-seleccion'></div></a>" .
					 "</div>";
		}
	}
	else if ($tipo == CLIENTE_PARTICULAR) {
		echo "<div class='fila-acceso' id='estado'>" .
					  "<a href='estados.php'><div id='icono-estado'></div><div class='nombre-acceso' id='texto-estado'>Estados</div><div id='icono-seleccion'></div></a>" .
				 "</div>" .
				 "<div class='fila-acceso' id='finca'>" .
				 		"<a href='fincas.php'><div id='icono-finca'></div><div class='nombre-acceso' id='texto-finca'>Fincas</div><div id='icono-seleccion'></div></a>" .
				 "</div>" .
				 "<div class='fila-acceso' id='huerto'>" .
					  "<div id='icono-huerto'></div><div class='nombre-acceso' id='texto-huerto'>Huertos</div>" .
				 "</div>" .
				 "<div class='fila-acceso' id='planta'>" .
					  "<a href='plantas.php'><div id='icono-planta'></div><div class='nombre-acceso' id='texto-planta'>Plantas</div><div id='icono-seleccion'></div></a>" .
				 "</div>";
	}
?>
