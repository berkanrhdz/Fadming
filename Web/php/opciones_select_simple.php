<?php
	error_reporting(0);
  require("conectar_basedatos.php");
	define('CLIENTE_PARTICULAR', '1');
	define('CLIENTE_EMPRESA', '2');

  $tipo = $_SESSION['tipo'];

	if ($tipo == CLIENTE_EMPRESA) {
		echo "<option value='1'>Finca con más plantas</option>";
		echo "<option value='2'>Huerto con más plantas</option>";
		echo "<option value='3'>Finca con más plantas finalizadas</option>";
		echo "<option value='4'>Huerto con más plantas finalizadas</option>";
		echo "<option value='5'>Finca con más plantas sin finalizar</option>";
		echo "<option value='6'>Huerto con más plantas sin finalizar</option>";
		echo "<option value='7'>Usuario con acceso a más plantas</option>";
		echo "<option value='8'>Usuario con acceso a menos plantas</option>";
		echo "<option value='9'>Finca con mas plantas en...</option>";
		echo "<option value='10'>Huerto con mas plantas en...</option>";
	}
	else if ($tipo == CLIENTE_PARTICULAR) {

	}
?>
