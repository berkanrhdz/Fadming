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
		echo "<option value='7'>Huerto con más usuarios con permiso</option>";
		echo "<option value='8'>Huerto con menos usuarios con permiso</option>";
		echo "<option value='9'>Usuario con acceso a más plantas</option>";
		echo "<option value='10'>Usuario con acceso a menos plantas</option>";
		echo "<option value='11'>Usuario con más estados realizados</option>";
		echo "<option value='12'>Usuario con menos estados realizados</option>";
		echo "<option value='13'>Finca con mas plantas en...</option>";
		echo "<option value='14'>Huerto con mas plantas en...</option>";
	}
	else if ($tipo == CLIENTE_PARTICULAR) {
		echo "<option value='1'>Finca con más plantas</option>";
		echo "<option value='2'>Huerto con más plantas</option>";
		echo "<option value='3'>Finca con más plantas finalizadas</option>";
		echo "<option value='4'>Huerto con más plantas finalizadas</option>";
		echo "<option value='5'>Finca con más plantas sin finalizar</option>";
		echo "<option value='6'>Huerto con más plantas sin finalizar</option>";
		echo "<option value='11'>Finca con mas plantas en...</option>";
		echo "<option value='12'>Huerto con mas plantas en...</option>";
	}
?>
