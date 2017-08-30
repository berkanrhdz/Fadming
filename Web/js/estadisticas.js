// DOCUMENTO JAVASCRIPT DE estadisticas.php

// DECLARACIÓN DE CONSTANTES.
const INDIVIDUAL = "select-individual";
const GRUPAL = "select-grupal";

$(document).ready(function() {
	$("#estadistica #icono-seleccion").fadeIn("fast");
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
