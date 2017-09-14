// DOCUMENTO JAVASCRIPT DE estadisticas.php

// DECLARACIÓN DE CONSTANTES.
const INDIVIDUAL = "select-individual";
const GRUPAL = "select-grupal";
const OPCIONES_SIN_ESTADO_INDIVIDUAL = 12;
const OPCIONES_SIN_ESTADO_GRUPAL = 4;
const GRAFICA_INICIAL = 1;

$(document).ready(function() {
	$("#estadistica #icono-seleccion").fadeIn("fast");
	var contenedor_graficas = document.getElementById('nombre-grafica');
	var graficas = contenedor_graficas.getElementsByClassName('nombre');
	acciones_slide(graficas.length);
	mostrar_grafica(GRAFICA_INICIAL);
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

function acciones_slide(numero_graficas) {
	var contador_slide = 1;
	var contador_slide_anterior;
	$("#flecha-izquierda").click(function() {
		contador_slide_anterior = contador_slide;
		contador_slide--;
		if (contador_slide < 1) {
			contador_slide = numero_graficas;
		}
		$('#nombre-grafica-' + contador_slide_anterior).fadeOut("fast", function() {
			$('#nombre-grafica-' + contador_slide).fadeIn("fast");
			document.getElementById('grafica').innerHTML = "";
			mostrar_grafica(contador_slide);
		});
	});
	$("#flecha-derecha").click(function() {
		contador_slide_anterior = contador_slide;
		contador_slide++;
		if (contador_slide > numero_graficas) {
			contador_slide = 1;
		}
		$('#nombre-grafica-' + contador_slide_anterior).fadeOut("fast", function() {
			$('#nombre-grafica-' + contador_slide).fadeIn("fast");
			document.getElementById('grafica').innerHTML = "";
			mostrar_grafica(contador_slide);
		});
	});
}

function mostrar_grafica(opcion) {
	$.ajax({
			type: 'POST',
			url: 'http://localhost/Fadming/Web/php/obtener_estadisticas_grafica.php',
			dataType: 'json',
			data: 'opcion='+opcion,
			success: function(datos) {
				$(datos).each(function(i, valor) {
					cargar_grafica(opcion, valor.categorias, valor.datos);
				});
			}
	});
}

function cargar_grafica(opcion, categorias, datos) {
	var JSON = {};
	switch (opcion) {
		case 1:
			JSON.chart = { backgroundColor: '#FFFFFF', type: 'column' };
			JSON.title = { text: '-', style: { "color": "#FFFFFF" } };
			JSON.xAxis = { categories: categorias };
			JSON.yAxis = { title: { text: 'Porcentaje (%)' }, max: 100, min: 0, plotLines: [{ value: 0, width: 1, color: '#2A2B2A' }] };
			JSON.plotOptions = { column: { color: '#F7DB5C', borderColor: '#D8CECB' }};
			JSON.credits = { enabled: false };
			JSON.series = [ { name: 'Plantas', data: datos } ];
		break;
		case 2:
			JSON.chart = { backgroundColor: '#FFFFFF', type: 'column' };
			JSON.title = { text: '-', style: { "color": "#FFFFFF" } };
			JSON.xAxis = { categories: categorias };
			JSON.yAxis = { title: { text: 'Porcentaje (%)' }, max: 100, min: 0, plotLines: [{ value: 0, width: 1, color: '#2A2B2A' }] };
			JSON.plotOptions = { column: { color: '#F7DB5C', borderColor: '#D8CECB' }};
			JSON.credits = { enabled: false };
			JSON.series = [ { name: 'Plantas', data: datos } ];
		break;
		case 3:
			JSON.chart = { backgroundColor: '#FFFFFF', type: 'area' };
			JSON.title = { text: '-', style: { "color": "#FFFFFF" } };
			JSON.xAxis = { categories: categorias };
			JSON.yAxis = { title: { text: 'Número de Plantas' }, max: 100, min: 0, plotLines: [{ value: 0, width: 1, color: '#2A2B2A' }] };
			JSON.plotOptions = { area: { color: '#F7DB5C', dataLabels: { enabled: true }, enableMouseTracking: true } };
			JSON.credits = { enabled: false };
			JSON.series = [ { name: 'Cantidad', data: datos } ];
		break;
		case 4:
			JSON.chart = { backgroundColor: '#FFFFFF', type: 'pie' };
			JSON.title = { text: '<b>Número total plantas: </b>' + categorias, style: { "color": "#2A2B2A" } };
			JSON.credits = { enabled: false };
			JSON.series = [ { name: 'Cantidad', data: datos } ];
		break;
		case 5:
			JSON.chart = { backgroundColor: '#FFFFFF', type: 'pie' };
			JSON.title = { text: '<b>Número total estados realizados: </b>' + categorias, style: { "color": "#2A2B2A" } };
			JSON.credits = { enabled: false };
			JSON.series = [ { name: 'Cantidad', data: datos } ];
		break;
	}
	$('#grafica').highcharts(JSON);
}
