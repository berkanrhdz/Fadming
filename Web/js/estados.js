// DOCUMENTO JAVASCRIPT DE estados.php

$(document).ready(function() {
	mostrar_lista_estados();
	interaccion_nuevo_grupos();
});

function mostrar_lista_estados() {
	$.ajax({
        type: 'POST',
        url: 'http://localhost/GricApp/Web/php/mostrar_lista_estados.php',
				dataType: 'json',
				success: function(datos) {
						$(datos).each(function(i, valor) {
								insertar_estado_formato(i + 1, valor.nombre, valor.descripcion);
						});
        }
    });
}

function insertar_estado_formato(indice, nombre, descripcion) { // Funcion para dar el formato a los estados.
		var formato = "<div class='estado' id='estado-" + indice + "'>" +
	               		"<div class='contenedor-nombre-estado'><div id='nombre-estado'>" + nombre + "</div></div>" +
	                  "<div class='contenedor-descripcion-estado'><div id='descripcion-estado'>" + descripcion + "</div></div>" +
	               "</div>";
		document.getElementById('lista').innerHTML += formato;
}

function interaccion_nuevo_grupos() {
		$("#boton-titulo-nuevo").click(function() {
				setTimeout(function(){
					$(".contenedor-informacion-nuevo").fadeIn();
				}, 500);
				$(".contenedor-informacion-nuevo").animate({'height': '75.7%'}, "slow");
				$(".contenedor-informacion-grupos").css("display", "none");
		});
		$("#boton-titulo-grupos").click(function() {
				$(".contenedor-informacion-nuevo").animate({'height': '0%'}, "slow");
				setTimeout(function(){
					 $(".contenedor-informacion-nuevo").css("display", "none");
				}, 500);
				$(".contenedor-informacion-grupos").animate({'height': '75.7%'}, "slow");
				$(".contenedor-informacion-grupos").fadeIn();
		});
}
