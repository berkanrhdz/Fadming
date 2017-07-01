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
    		$('#boton-nueva-empresa').css('color', '#2A2B2A');
    		$(this).css('height', '11.75%');
  		}, function() {
  			$(this).css('height', '12%');
    		$(this).css('background-color', '#2A2B2A');
    		$(this).css('border', '1px solid #2A2B2A');
    		$(this).css('font-size', '1.0em');
    		$('#boton-nueva-empresa').css('color', '#FFFFFF');
  		}
	);
}