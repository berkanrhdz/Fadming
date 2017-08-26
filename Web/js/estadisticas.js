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
}
