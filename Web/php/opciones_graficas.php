<?php
	error_reporting(0);
  require("conectar_basedatos.php");
	define('CLIENTE_PARTICULAR', '1');
	define('CLIENTE_EMPRESA', '2');

  $tipo = $_SESSION['tipo'];

	if ($tipo == CLIENTE_EMPRESA) {
		echo "<div class='nombre' id='nombre-grafica-1'>Porcentaje de plantas finalizadas por finca</div>";
		echo "<div class='nombre' id='nombre-grafica-2' style='display: none'>Porcentaje de plantas finalizadas por huerto</div>";
		echo "<div class='nombre' id='nombre-grafica-3' style='display: none'>Plantas añadidas por meses</div>";
		echo "<div class='nombre' id='nombre-grafica-4' style='display: none'>Plantas por finca respecto al total</div>";
		echo "<div class='nombre' id='nombre-grafica-5' style='display: none'>Estados realizados por usuario respecto al total</div>";
	}
	else if ($tipo == CLIENTE_PARTICULAR) {
		echo "<div class='nombre' id='nombre-grafica-1'>Porcentaje de plantas finalizadas por finca</div>";
		echo "<div class='nombre' id='nombre-grafica-2' style='display: none'>Porcentaje de plantas finalizadas por huerto</div>";
		echo "<div class='nombre' id='nombre-grafica-3' style='display: none'>Plantas añadidas por meses</div>";
		echo "<div class='nombre' id='nombre-grafica-4' style='display: none'>Plantas por finca respecto al total</div>";
	}
?>
