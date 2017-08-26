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
		switch (opcion) {
			case '1':
				
			break;
		}
	}
}
