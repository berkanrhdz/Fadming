<?php
	error_reporting(0);
  require("conectar_basedatos.php");
	define('CLIENTE_PARTICULAR', '1');
	define('CLIENTE_EMPRESA', '2');

  $tipo = $_SESSION['tipo'];

	if ($tipo == CLIENTE_EMPRESA) {
		echo "<option value='1'>Cantidad de plantas no finalizadas por huerto</option>";
		echo "<option value='2'>Cantidad de plantas no finalizadas por finca</option>";
		echo "<option value='3'>Cantidad de usuarios con permisos por huerto</option>";
		echo "<option value='4'>Cantidad de plantas por finca en...</option>";
		echo "<option value='5'>Cantidad de plantas por huerto en...</option>";
	}
	else if ($tipo == CLIENTE_PARTICULAR) {
		echo "<option value='1'>Cantidad de plantas no finalizadas por huerto</option>";
		echo "<option value='2'>Cantidad de plantas no finalizadas por finca</option>";
		echo "<option value='4'>Cantidad de plantas por finca en...</option>";
		echo "<option value='5'>Cantidad de plantas por huerto en...</option>";
	}
?>
