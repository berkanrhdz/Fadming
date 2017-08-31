// DOCUMENTO JAVASCRIPT DE estadisticas.php

// DECLARACIÓN DE CONSTANTES.
const INDIVIDUAL = "select-individual";
const GRUPAL = "select-grupal";
const MAX_SLIDE = 5;

$(document).ready(function() {
	$("#estadistica #icono-seleccion").fadeIn("fast");
	acciones_slide();
});

function obtener_estadistica(tipo) {
	if (tipo == INDIVIDUAL) {
		var opcion = document.getElementById('select-individual').value;
		$.ajax({
				type: 'POST',
				url: 'http://localhost/Fadming/Web/php/obtener_estadisticas_simple.php',
				dataType: 'json',
				data: 'opcion='+opcion,
				success: function(datos) {
					$(datos).each(function(i, valor) {
						document.getElementById('respuesta-select-individual').innerHTML = valor.respuesta;
					});
				}
		});
	}
	else if (tipo == GRUPAL) {
		var opcion = document.getElementById('select-grupal').value;
		$.ajax({
				type: 'POST',
				url: 'http://localhost/Fadming/Web/php/obtener_estadisticas_detalle.php',
				dataType: 'json',
				data: 'opcion='+opcion,
				success: function(datos) {
					$(datos).each(function(i, valor) {
						insertar_cantidad_formato(valor.nombre, valor.cantidad)
					});
				}
		});
	}
}

function insertar_cantidad_formato(nombre, cantidad) {
	var formato_cantidad = "<div class='indicador-cantidad'>" +
														"<div id='nombre-indicador'>" + nombre + "</div>" +
													  "<div id='cantidad-indicador'>" + cantidad + "</div>" +
												 "</div>";
	document.getElementById('contenedor-cantidades').innerHTML += formato_cantidad;
}

function acciones_slide() {
	var contador_slide = 1;
	var contador_slide_anterior;
	$("#flecha-izquierda").click(function() {
		contador_slide_anterior = contador_slide;
		contador_slide--;
		if (contador_slide < 1) {
			contador_slide = MAX_SLIDE;
		}
		$('#nombre-grafica-' + contador_slide_anterior).fadeOut("fast", function() {
			$('#grafica-' + contador_slide_anterior).fadeOut("fast", function() {
				$('#grafica-' + contador_slide).fadeIn("fast");
			});
			$('#nombre-grafica-' + contador_slide).fadeIn("fast");
		});
	});
	$("#flecha-derecha").click(function() {
		contador_slide_anterior = contador_slide;
		contador_slide++;
		if (contador_slide > MAX_SLIDE) {
			contador_slide = 1;
		}
		$('#nombre-grafica-' + contador_slide_anterior).fadeOut("fast", function() {
			$('#grafica-' + contador_slide_anterior).fadeOut("fast", function() {
				$('#grafica-' + contador_slide).fadeIn("fast");
			});
			$('#nombre-grafica-' + contador_slide).fadeIn("fast");
		});
	});
}
