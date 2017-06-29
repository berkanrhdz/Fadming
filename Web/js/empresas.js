// DOCUMENTO JAVASCRIPT DE empresas.php

$(document).ready(function() {
	interaccion_nueva_empresa();
});

function interaccion_nueva_empresa() {
	$(".contenedor-boton").hover(
  		function() {
    		$(this).css('background-color', '#F7DB5C');
    		$(this).css('border', '1.5px solid #2A2B2A');
    		$(this).css('cursor', 'pointer');
    		$(this).css('font-size', '1.15em');
    		$("#boton-nueva-empresa").animate({'width': '62%'}, "1250");
  		}, function() {
    		setTimeout(function(){ 
				$("#boton-nueva-empresa").animate({'width': '98.5%'}, "1250");
			}, 350);
    		setTimeout(function(){ 
    			$(".contenedor-boton").css('background-color', 'transparent');
    			$(".contenedor-boton").css('border', '1px solid #2A2B2A');
    			$(".contenedor-boton").css('font-size', '1.0em');
			}, 1000);
  		}
	);
}