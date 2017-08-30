<?php
	error_reporting(0);
  require("conectar_basedatos.php");
	define('CLIENTE_PARTICULAR', '1');
	define('CLIENTE_EMPRESA', '2');

  $tipo = $_SESSION['tipo'];

	if ($tipo == CLIENTE_EMPRESA) {
		echo "<option value='1'>Cantidad de plantas no completadas por huerto</option>";
	}
	else if ($tipo == CLIENTE_PARTICULAR) {

	}
?>
