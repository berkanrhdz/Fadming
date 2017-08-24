// DOCUMENTO JAVASCRIPT DE fincas.php

// DECLARACIÓN DE VARIABLES GLOBALES.
var meses_año = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];

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
								insertar_finca_formato(i, valor.codigo, valor.nombre, valor.dia_anio, valor.mes, valor.numero_huertos, valor.numero_plantas, valor.imagen);
						});
						var maxSlide = $('#slide-fincas .informacion-finca').length;
						iniciar_slide(maxSlide);
        }
    });
}

function insertar_finca_formato(indice, codigo, nombre, dia_anio, mes, numero_huertos, numero_plantas, imagen) {
	var formato_finca1, formato_finca2, formato_finca, formato_imagen;
	var dia = dia_anio.substr(0, 2);
	var mes = meses_año[mes - 1];
	var anio = dia_anio.substr(3, 4);
	var formato_fecha = "Registrada el " + dia + " de " + mes + " de " + anio;
	if (imagen != null) {
		formato_imagen = "<img src='data:image/png;base64," + imagen + "'>";
	}
	else {
		formato_imagen = "<img src='images/finca_defecto.png'>";
	}
	if (indice == 0) {
		var formato_nombre_tipo = "<div id='" + codigo + "' class='tipo-planta-nombre'>Tipos de plantas en " + nombre.toProperCase() + "</div>";
		document.getElementById('titulo-tipos-plantas').innerHTML = formato_nombre_tipo
		obtener_tipos_plantas(codigo);
		formato_finca1 = "<div class='informacion-finca' id='finca-" + (indice + 1) + "'>";
	}
	else {
		formato_finca1 = "<div class='informacion-finca' id='finca-" + (indice + 1) + "' style='display: none;'>";
	}
	var formato_finca2 = "<div class='contenedor-nombre-finca'>" +
	                        "<div class='nombre-finca' id='" + codigo + "'><b>" + nombre.toUpperCase() + "</b><text>" + formato_fecha + "</text></div>" +
	                     "</div>" +
	                     "<div class='contenedor-imagen-finca'>" +
	                        "<div id='imagen-finca'>" + formato_imagen + "</div>" +
	                     "</div>" +
	                     "<div class='contenedor-datos-finca'>" +
	                         "<div class='contenedor-numero-huertos'>" +
	                        		 "<div id='numero-huertos'>HUERTOS EN LA FINCA: " + numero_huertos + "</div>" +
	                         "</div>" +
	                         "<div class='contenedor-numero-plantas'>" +
	                             "<div id='numero-plantas'>NÚMERO TOTAL DE PLANTAS: " + numero_plantas + "</div>" +
	                         "</div>" +
	                         "<div class='contenedor-numero-usuarios'>" +
	                             "<div id='numero-usuarios'><b>NÚMERO DE USUARIOS</b></div>" +
	                         "</div>" +
	                      "</div>" +
												"<div class='contenedor-eliminar-finca'>" +
													"<div id='boton-eliminar-finca' onclick='eliminar_finca(" + codigo + ")'>Eliminar finca</div>" +
												"</div>" +
	                   "</div>";
	formato_finca = formato_finca1 + formato_finca2;
	document.getElementById('fichas-finca').innerHTML += formato_finca;
}

function iniciar_slide(maxSlide) {
	var contadorSlideActual = 1;
	var contadorSlideAnterior, codigoFinca, nombreFinca;
	$("#flecha-izquierda").click(function() {
		contadorSlideAnterior = contadorSlideActual
		contadorSlideActual--;
		if (contadorSlideActual < 1) {
			contadorSlideActual = maxSlide;
			contadorSlideAnterior = 1;
		}
		$('#finca-' + contadorSlideAnterior).slideUp(function() {
			$('#finca-' + contadorSlideActual).slideDown();
			codigoFinca = $('#finca-' + contadorSlideActual + ' .nombre-finca').attr('ID');
			nombreFinca = $('#' + codigoFinca + ' b').text();
			var formato_nombre_tipo = "<div id='" + codigoFinca + "' class='tipo-planta-nombre'>Tipos de plantas en " + nombreFinca.toProperCase() + "</div>";
			document.getElementById('titulo-tipos-plantas').innerHTML = formato_nombre_tipo
			document.getElementById('tipos-plantas').innerHTML = "";
			obtener_tipos_plantas(codigoFinca);
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
			codigoFinca = $('#finca-' + contadorSlideActual + ' .nombre-finca').attr('ID');
			nombreFinca = $('#' + codigoFinca + ' b').text();
			var formato_nombre_tipo = "<div id='" + codigoFinca + "' class='tipo-planta-nombre'>Tipos de plantas en " + nombreFinca.toProperCase() + "</div>";
			document.getElementById('titulo-tipos-plantas').innerHTML = formato_nombre_tipo
			document.getElementById('tipos-plantas').innerHTML = "";
			obtener_tipos_plantas(codigoFinca);
		});
	});
}

function almacenar_finca() {
	var nombre = document.getElementById('nombre_finca').value;
	document.getElementById("boton-anadir-finca").value = "Añadiendo...";
	$.ajax({
				type: 'POST',
				url: 'http://localhost/Fadming/Web/php/almacenar_finca.php',
				dataType: 'json',
				data: "nombre="+nombre,
				success: interaccion_anadir_finca()
		});
}

function interaccion_anadir_finca() {
	setTimeout(function(){
			document.getElementById("boton-anadir-finca").value = "Añadida";
	}, 1500);
	setTimeout(function() {
			location.reload();
	}, 2000);
}

function obtener_tipos_plantas(codigoFinca) {
	$.ajax({
        type: 'POST',
        url: 'http://localhost/Fadming/Web/php/obtener_tipos_plantas_finca.php',
				dataType: 'json',
				data: 'finca='+codigoFinca,
				success: function(datos) {
						$(datos).each(function(i, valor) {
								insertar_tipos_formato(valor.nombre);
						});
        }
    });
}

function insertar_tipos_formato(nombre) {
	var formato_tipo = "<div class='tipo-planta'>" + nombre.toUpperCase() + "</div>";
	document.getElementById('tipos-plantas').innerHTML += formato_tipo;
}

function almacenar_tipo_planta() {
	var nombre = document.getElementById('nombre_tipo').value.toProperCase();
	var codigo = $('.tipo-planta-nombre').attr('ID');
	document.getElementById("boton-anadir-tipo").value = "Añadiendo...";
	$.ajax({
				type: 'POST',
				url: 'http://localhost/Fadming/Web/php/almacenar_tipo_planta.php',
				dataType: 'json',
				data: "nombre="+nombre+'&finca='+codigo,
				success: interaccion_anadir_tipo(codigo)
		});
}

function interaccion_anadir_tipo(codigo) {
	setTimeout(function(){
			document.getElementById("boton-anadir-tipo").value = "Añadido";
	}, 1500);
	setTimeout(function() {
			document.getElementById("boton-anadir-tipo").value = "Añadir tipo";
			document.getElementById('nombre_tipo').value = "";
			document.getElementById('tipos-plantas').innerHTML = "";
			obtener_tipos_plantas(codigo);
	}, 2500);
}

function eliminar_finca(codigo) {
	document.getElementById("boton-eliminar-finca").innerHTML = "Eliminando...";
	$.ajax({
				type: 'POST',
				url: 'http://localhost/Fadming/Web/php/eliminar_finca.php',
				dataType: 'json',
				data: "finca="+codigo,
				success: interaccion_eliminar_finca()
		});
}

function interaccion_eliminar_finca() {
	setTimeout(function(){
			document.getElementById("boton-eliminar-finca").innerHTML = "Eliminada";
	}, 1500);
	setTimeout(function() {
			location.reload();
	}, 2000);
}

String.prototype.toProperCase = function () {
    return this.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
};
