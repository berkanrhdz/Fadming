// DOCUMENTO JAVASCRIPT DE empresas.php

$(document).ready(function() {
	interaccion_nueva_empresa();
});

function interaccion_nueva_empresa() {
	$(".contenedor-boton").hover(
  		function() {
    		$(this).css('background-color', '#F7DB5C');
    		$(this).css('border', '1.575px solid #2A2B2A');
    		$(this).css('cursor', 'pointer');
    		$(this).css('font-size', '1.15em');
    		$(this).css('height', '11.75%');
  		}, function() {
  			$(this).css('height', '12%');
    		$(".contenedor-boton").css('background-color', 'transparent');
    		$(".contenedor-boton").css('border', '1px solid #2A2B2A');
    		$(".contenedor-boton").css('font-size', '1.0em');
  		}
	);
}