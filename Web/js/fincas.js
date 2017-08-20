// DOCUMENTO JAVASCRIPT DE fincas.php

$(document).ready(function() {
	$("#finca #icono-seleccion").fadeIn("fast");
	obtener_datos_fincas();
});

function obtener_datos_fincas() {
	$.ajax({
        type: 'POST',
        url: 'http://localhost/Fadming/Web/php/obtener_datos_fincas.php',
				dataType: 'json',
				success: function(datos) {
						$(datos).each(function(i, valor) {
								insertar_finca_formato(i, valor.nombre, valor.numero_huertos);
						});
						var maxSlide = $('#slide-fincas .informacion-finca').length;
						iniciar_slide(maxSlide);
        }
    });
}

function insertar_finca_formato(indice, nombre, numero_huertos) {
	var formato_finca1, formato_finca2, formato_finca;
	if (indice == 0) {
		formato_finca1 = "<div class='informacion-finca' id='finca-" + (indice + 1) + "'>";
	}
	else {
		formato_finca1 = "<div class='informacion-finca' id='finca-" + (indice + 1) + "' style='display: none;'>";
	}
	var formato_finca2 = "<div class='contenedor-nombre-finca'>" +
	                          "<div id='nombre-finca'>" + nombre.toUpperCase() + "</div>" +
	                      "</div>" +
	                        "<div class='contenedor-numero-huertos'>" +
	                         		"<div class='numero-huertos'>" +
	                               "<div class='contenedor-icono-huertos'>" +
	                                   "<div id='icono-huertos'></div>" +
	                                   "<div id='titulo-huertos'>NÚMERO DE HUERTOS</div>" +
	                               "</div>" +
	                               "<div id='cantidad-numero-huertos'>" + numero_huertos + "</div>" +
	                            "</div>" +
	                        "</div>" +
	                        "<div class='contenedor-numero-plantas'>" +
	                         		"<div class='numero-plantas'>" +
	                                "<div class='contenedor-icono-plantas'>" +
	                                    "<div id='icono-plantas'></div>" +
	                                    "<div id='titulo-plantas'>NÚMERO DE PLANTAS</div>" +
	                                "</div>" +
	                                "<div id='cantidad-numero-plantas'></div>" +
	                            "</div>" +
	                        "</div>" +
	                        "<div class='contenedor-numero-usuarios'>" +
	                            "<div class='numero-usuarios'>" +
	                             		"<div class='contenedor-icono-usuarios'>" +
	                                    "<div id='icono-usuarios'></div>" +
	                                    "<div id='titulo-usuarios'>NÚMERO DE USUARIOS</div>" +
	                                "</div>" +
	                                "<div id='cantidad-numero-usuarios'></div>" +
	                            "</div>" +
	                        "</div>" +
	                    "</div>";
	formato_finca = formato_finca1 + formato_finca2;
	document.getElementById('slide-fincas').innerHTML += formato_finca;
}

function iniciar_slide(maxSlide) {
	var contadorSlideActual = 1;
	var contadorSlideAnterior;
	$("#flecha-izquierda").click(function() {
		contadorSlideAnterior = contadorSlideActual
		contadorSlideActual--;
		if (contadorSlideActual < 1) {
			contadorSlideActual = maxSlide;
			contadorSlideAnterior = 1;
		}
		$('#finca-' + contadorSlideAnterior).slideUp(function() {
			$('#finca-' + contadorSlideActual).slideDown();
		});
	});
	$("#flecha-derecha").click(function() {
		contadorSlideAnterior = contadorSlideActual;
		contadorSlideActual++;
		if (contadorSlideActual > maxSlide) {
			contadorSlideActual = 1;
			contadorSlideAnterior = maxSlide;
		}
		$('#finca-' + contadorSlideAnterior).slideUp(function() {
			$('#finca-' + contadorSlideActual).slideDown();
		});
	});
}
