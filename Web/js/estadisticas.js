// DOCUMENTO JAVASCRIPT DE estadisticas.php

// DECLARACIÓN DE CONSTANTES.
const INDIVIDUAL = "select-individual";
const GRUPAL = "select-grupal";
const MAX_SLIDE = 5;
const OPCIONES_SIN_ESTADO_INDIVIDUAL = 10;
const OPCIONES_SIN_ESTADO_GRUPAL = 3;


$(document).ready(function() {
	$("#estadistica #icono-seleccion").fadeIn("fast");
	acciones_slide();
	cargar_graficas(1);
	obtener_estados_usuario();
});

function obtener_estados_usuario() {
	$.ajax({
		type: 'POST',
	  url: 'http://localhost/Fadming/Web/php/obtener_lista_estados.php',
	  dataType: 'json',
		success: function(datos) {
			$(datos).each(function(i, valor) {
				insertar_estado_formato(valor.codigo, valor.nombre);
			});
	  }
	});
}

function insertar_estado_formato(codigo, nombre) {
	var formato_estado = "<option value='" + codigo + "'>" + nombre.toUpperCase() + "</option>";
	document.getElementById('select-estado-individual').innerHTML += formato_estado;
	document.getElementById('select-estado-grupal').innerHTML += formato_estado;
}

function obtener_estadistica(tipo) {
	if (tipo == INDIVIDUAL) {
		var opcion = document.getElementById('select-individual').value;
		if (opcion <= OPCIONES_SIN_ESTADO_INDIVIDUAL) {
			$('.contenedor-select-individual .contenedor-select-estado').fadeOut("fast", function() {
				$('.contenedor-select-individual .contenedor-select-no-estado').animate({'width': '100%'}, "fast");
			});
			enviar_opcion_estadistica_simple(opcion);
		}
		else {
			$('.contenedor-select-individual .contenedor-select-no-estado').animate({'width': '50%'}, "slow", function() {
				$('.contenedor-select-individual .contenedor-select-estado').fadeIn();
				document.getElementById('respuesta-select-individual').innerHTML = "";
				document.getElementById('select-estado-individual').value = "";
			});
		}
	}
	else if (tipo == GRUPAL) {
		var opcion = document.getElementById('select-grupal').value;
		if (opcion <= OPCIONES_SIN_ESTADO_GRUPAL) {
			$('.contenedor-select-grupal .contenedor-select-estado').fadeOut("fast", function() {
				$('.contenedor-select-grupal .contenedor-select-no-estado').animate({'width': '100%'}, "fast");
			});
			enviar_opcion_estadistica_detalle(opcion);
		}
		else {
			$('.contenedor-select-grupal .contenedor-select-no-estado').animate({'width': '50%'}, "slow", function() {
				$('.contenedor-select-grupal .contenedor-select-estado').fadeIn();
				document.getElementById('contenedor-cantidades').innerHTML = "";
				document.getElementById('select-estado-grupal').value = "";
			});
		}
	}
}

function enviar_opcion_estadistica_simple(opcion) {
	if (opcion == null) {
		var opcion = document.getElementById('select-individual').value;
		var estado = document.getElementById('select-estado-individual').value;
	}
	$.ajax({
			type: 'POST',
			url: 'http://localhost/Fadming/Web/php/obtener_estadisticas_simple.php',
			dataType: 'json',
			data: 'opcion='+opcion+'&estado='+estado,
			success: function(datos) {
				$(datos).each(function(i, valor) {
					document.getElementById('respuesta-select-individual').innerHTML = valor.respuesta;
				});
			}
	});
}

function enviar_opcion_estadistica_detalle(opcion) {
	if (opcion == null) {
		var opcion = document.getElementById('select-grupal').value;
		var estado = document.getElementById('select-estado-grupal').value;
	}
	document.getElementById('contenedor-cantidades').innerHTML = "";
	$.ajax({
			type: 'POST',
			url: 'http://localhost/Fadming/Web/php/obtener_estadisticas_detalle.php',
			dataType: 'json',
			data: 'opcion='+opcion+'&estado='+estado,
			success: function(datos) {
				$(datos).each(function(i, valor) {
					insertar_cantidad_formato(valor.nombre, valor.cantidad)
				});
			}
	});
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

function cargar_graficas(opcion) {
	switch (opcion) {
		case 1:
			var chart = { backgroundColor: '#FFFFFF', type: 'column' };
			var title = { text: '-', style: { "color": "#FFFFFF" } };
			var xAxis = { categories: ['Los Pelados', 'Morro Blanco', 'La Tejita'] };
			var yAxis = {
				 title: { text: 'Porcentaje (%)' },
				 plotLines: [{ value: 0, width: 1, color: '#2A2B2A' }]
			};
			var plotOptions = { column: { color: '#F7DB5C', borderColor: '#D8CECB' }};
			var credits = { enabled: false };
			var series = [
			 {
					name: 'Plantas',
					data: [71.0, 43.0, 78.0]
			 },
			];
		break;
	}
	var JSON = {};
	JSON.chart = chart;
	JSON.title = title;
	JSON.xAxis = xAxis;
	JSON.yAxis = yAxis;
	JSON.plotOptions = plotOptions;
	JSON.credits = credits;
	JSON.series = series;
	$('#grafica-' + opcion).highcharts(JSON);
}
