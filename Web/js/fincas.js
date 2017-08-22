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
								insertar_finca_formato(i, valor.codigo, valor.nombre, valor.numero_huertos, valor.numero_plantas, valor.imagen);
						});
						var maxSlide = $('#slide-fincas .informacion-finca').length;
						iniciar_slide(maxSlide);
        }
    });
}

function insertar_finca_formato(indice, codigo, nombre, numero_huertos, numero_plantas, imagen) {
	var formato_finca1, formato_finca2, formato_finca, formato_imagen;
	if (imagen != null) {
		formato_imagen = "<img src='data:image/png;base64," + imagen + "'>";
	}
	else {
		formato_imagen = "<img src='images/finca_defecto.png'>";
	}
	if (indice == 0) {
		document.getElementById('titulo-tipos-plantas').innerHTML = "Tipos de plantas en " + nombre;
		obtener_tipos_plantas(codigo);
		formato_finca1 = "<div class='informacion-finca' id='finca-" + (indice + 1) + "'>";
	}
	else {
		formato_finca1 = "<div class='informacion-finca' id='finca-" + (indice + 1) + "' style='display: none;'>";
	}
	var formato_finca2 = "<div class='contenedor-nombre-finca'>" +
	                        "<div class='nombre-finca' id='" + codigo + "'>" + nombre.toUpperCase() + "</div>" +
	                     "</div>" +
	                     "<div class='contenedor-imagen-finca'>" +
	                        "<div id='imagen-finca'>" + formato_imagen + "</div>" +
	                     "</div>" +
	                     "<div class='contenedor-datos-finca'>" +
	                         "<div class='contenedor-numero-huertos'>" +
	                        		 "<div id='numero-huertos'><b>NÚMERO DE HUERTOS</b> " + numero_huertos + "</div>" +
	                         "</div>" +
	                         "<div class='contenedor-numero-plantas'>" +
	                             "<div id='numero-plantas'><b>NÚMERO DE PLANTAS</b>" + numero_plantas + "</div>" +
	                         "</div>" +
	                         "<div class='contenedor-numero-usuarios'>" +
	                             "<div id='numero-usuarios'><b>NÚMERO DE USUARIOS</b></div>" +
	                         "</div>" +
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
			nombreFinca = $('#' + codigoFinca).text();
			document.getElementById('titulo-tipos-plantas').innerHTML = "Tipos de plantas en " + nombreFinca.toProperCase();
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
			nombreFinca = $('#' + codigoFinca).text();
			document.getElementById('titulo-tipos-plantas').innerHTML = "Tipos de plantas en " + nombreFinca.toProperCase();
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
			document.getElementById("boton-anadir-finca").value = "Añadir finca";
			document.getElementById('fichas-finca').innerHTML = "";
			obtener_datos_fincas();
	}, 2500);
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
	var codigo = $('#fichas-finca .nombre-finca').attr('ID');
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

String.prototype.toProperCase = function () {
    return this.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
};
