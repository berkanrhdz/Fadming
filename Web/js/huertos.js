// DOCUMENTO JAVASCRIPT DE fincas.php

// DECLARACION DE VARIABLES GLOBALES.
var contadorSlideActual = 1;

$(document).ready(function() {
	$("#huerto #icono-seleccion").fadeIn("fast");
	obtener_fincas_usuario();
});

function obtener_fincas_usuario() {
	$.ajax({
        type: 'POST',
        url: 'http://localhost/Fadming/Web/php/obtener_fincas_usuario.php',
				dataType: 'json',
				success: function(datos) {
						$(datos).each(function(i, valor) {
							insertar_finca_formato(i, valor.codigo, valor.nombre);
						});
						var maxSlide = $('#titulo-finca .nombre-finca').length;
						iniciar_slide(maxSlide);
        }
    });
}

function insertar_finca_formato(indice, codigo, nombre) {
	var formato_nombre_finca1, formato_nombre_finca2, formato_nombre_finca;
	if (indice == 0) {
		obtener_huertos_fincas(codigo);
		document.getElementById('titulo-anadir-huerto').innerHTML = "Añadir nuevo huerto a " + nombre.toProperCase();
		formato_nombre_finca1 = "<div class='nombre-finca' id='finca-" + (indice + 1) + "'>";
	}
	else {
		formato_nombre_finca1 = "<div class='nombre-finca' id='finca-" + (indice + 1) + "' style='display: none;'>";
	}
	formato_nombre_finca2 = "<div class='finca' id='" + codigo + "'>" + nombre.toProperCase() + "</div></div>";
	formato_nombre_finca = formato_nombre_finca1 + formato_nombre_finca2;
	document.getElementById('titulo-finca').innerHTML += formato_nombre_finca;
}

function iniciar_slide(maxSlide) {
	var contadorSlideAnterior, codigoFinca, nombreFinca;
	$("#flecha-izquierda").click(function() {
		contadorSlideAnterior = contadorSlideActual
		contadorSlideActual--;
		if (contadorSlideActual < 1) {
			contadorSlideActual = maxSlide;
			contadorSlideAnterior = 1;
		}
		$('#finca-' + contadorSlideAnterior).slideUp("fast", function() {
			$('#finca-' + contadorSlideActual).slideDown("fast");
			$('#usuarios-permisos').fadeOut("fast", function() {
				$('#mensaje-ayuda-permisos').fadeIn("fast");
				document.getElementById('nombre-huerto-permisos').innerHTML = "";
			});
			codigoFinca = $('#finca-' + contadorSlideActual + ' .finca').attr('ID');
			nombreFinca = $('#' + codigoFinca).text();
			document.getElementById('titulo-anadir-huerto').innerHTML = "Añadir nuevo huerto a " + nombreFinca.toProperCase();
			document.getElementById('lista-huertos').innerHTML = "";
			obtener_huertos_fincas(codigoFinca);
		});
	});
	$("#flecha-derecha").click(function() {
		contadorSlideAnterior = contadorSlideActual;
		contadorSlideActual++;
		if (contadorSlideActual > maxSlide) {
			contadorSlideActual = 1;
			contadorSlideAnterior = maxSlide;
		}
		$('#finca-' + contadorSlideAnterior).slideUp("fast", function() {
			$('#finca-' + contadorSlideActual).slideDown("fast");
			$('#usuarios-permisos').fadeOut("fast", function() {
				$('#mensaje-ayuda-permisos').fadeIn("fast");
				document.getElementById('nombre-huerto-permisos').innerHTML = "";
			});
			codigoFinca = $('#finca-' + contadorSlideActual + ' .finca').attr('ID');
			nombreFinca = $('#' + codigoFinca).text();
			document.getElementById('titulo-anadir-huerto').innerHTML = "Añadir nuevo huerto a " + nombreFinca.toProperCase();
			document.getElementById('lista-huertos').innerHTML = "";
			obtener_huertos_fincas(codigoFinca);
		});
	});
}

function obtener_huertos_fincas(codigo_finca) {
	$.ajax({
        type: 'POST',
        url: 'http://localhost/Fadming/Web/php/obtener_huertos_usuario.php',
				dataType: 'json',
				data: "finca="+codigo_finca,
				success: function(datos) {
					if (datos.length == 0) {
						insertar_mensaje_huertos();
						$('#mensaje-no-huertos').show();
					}
					else {
						$(datos).each(function(i, valor) {
							insertar_huerto_formato(valor.codigo, valor.nombre);
						});
					}
        }
    });
}

function insertar_huerto_formato(codigo, nombre) {
		var formato_huerto = "<div class='huerto' id='" + codigo + "'>" +
														"<div class='nombre-huerto' id='huerto" + codigo + "' onclick='acceder_permisos_huerto(" + codigo + ")'>" + nombre + "</div>" +
														"<div id='eliminar-huerto' onclick='eliminar_huerto(" + codigo + ")'>ELIMINAR</div>" +
												 "</div>";
		document.getElementById('lista-huertos').innerHTML += formato_huerto;
}

function insertar_mensaje_huertos() {
	var formato_mensaje = "<div id='mensaje-no-huertos'>" +
														"<div id='contenedor-mensaje-huertos'><b>No ha añadido ningún huerto a esta finca</b>Agréguelos usando el cuarto de la parte inferior</div>" +
												"</div>";
	document.getElementById('lista-huertos').innerHTML = formato_mensaje;
}

function comprobar_nombre_huerto() {
	if (document.getElementById("nombre_huerto").value.length == 0) { // Comprobación de introducción del nombre del huerto.
		$('#nombre_huerto').css('background-color', '#FADBD8');
		document.getElementById("nombre_huerto").placeholder = "Obligatorio";
	    setTimeout(function() {
	    	document.getElementById("nombre_huerto").placeholder = "Nombre del nuevo huerto";
			$('#nombre_huerto').css('background-color', '#FFFFFF');
		}, 1500);
		return false;
	}
	return true;
}

function anadir_nuevo_huerto() {
	if (comprobar_nombre_huerto()) {
		var codigo_finca = $('#finca-' + contadorSlideActual + ' .finca').attr('ID');
		var nombre_huerto = document.getElementById('nombre_huerto').value.toProperCase();
		$.ajax({
			type: 'POST',
			url: 'http://localhost/Fadming/Web/php/almacenar_huerto.php',
			data: "nombre="+nombre_huerto+"&finca="+codigo_finca,
			dataType: 'json',
			success: interaccion_anadir_rol(codigo_finca)
		});
	}
}

function interaccion_anadir_rol(codigo_finca) {
	document.getElementById("boton_anadir_huerto").value = "Añadiendo...";
	setTimeout(function(){
			document.getElementById("boton_anadir_huerto").value = "Añadido";
	}, 1500);
	setTimeout(function() {
			document.getElementById('lista-huertos').innerHTML = "";
			obtener_huertos_fincas(codigo_finca);
			document.getElementById("boton_anadir_huerto").value = "Añadir huerto";
			document.getElementById("nombre_huerto").value = "";
	}, 2500);
}

function eliminar_huerto(codigo) {
	$.ajax({
		type: 'POST',
		url: 'http://localhost/Fadming/Web/php/eliminar_huerto.php',
		data: "huerto="+codigo,
		dataType: 'json',
		success: interaccion_eliminar_huerto(codigo)
	});
}

function interaccion_eliminar_huerto(codigo) {
	$('#lista-huertos #' + codigo).fadeOut("fast");
}

function acceder_permisos_huerto(codigo) {
	var nombre = $('#huerto' + codigo).text();
	var formato_huerto = "<div id='" + codigo + "' class='nombre-huerto-actual'>" + nombre + "</div>";
	document.getElementById('nombre-huerto-permisos').innerHTML = formato_huerto;
	document.getElementById('usuarios-permisos').innerHTML = "";
	obtener_usuarios_permisos(codigo);
	$('#mensaje-ayuda-permisos').fadeOut("fast", function() {
		$('#usuarios-permisos').fadeIn("fast");
	});
}

function obtener_usuarios_permisos(codigo_huerto) {
	$.ajax({
		type: 'POST',
		url: 'http://localhost/Fadming/Web/php/obtener_permisos_huerto.php',
		data: "huerto="+codigo_huerto,
		dataType: 'json',
		success: function(datos) {
			$(datos).each(function(i, valor) {
				insertar_usuario_formato(valor.codigo, valor.nombre, valor.apellidos, valor.imagen, valor.rol, valor.permiso);
			});
		}
	});
}

function insertar_usuario_formato(codigo, nombre, apellidos, imagen, rol, permiso) {
	var formato_checkbox;
	if (permiso) {
		formato_checkbox = "<input id='" + codigo + "' name='" + codigo + "' type='checkbox' onclick='actualizar_permisos(" + codigo + ")' checked>";
	}
	else {
		formato_checkbox = "<input id='" + codigo + "' name='" + codigo + "' type='checkbox' onclick='actualizar_permisos(" + codigo + ")'>";
	}
	var formato_imagen = "<img src='data:image/png;base64," + imagen + "'>";
	var formato_usuario = "<div class='usuario-empresa'>" +
													"<div id='imagen-usuario'>" + formato_imagen + "</div>" +
													"<div id='nombre-usuario'>" + nombre + " " + apellidos + "</br><b>" + rol.toUpperCase() + "</b></div>" +
													"<div id='checkbox-usuario'>" + formato_checkbox + "</div>" +
											 "</div>";
	document.getElementById('usuarios-permisos').innerHTML += formato_usuario;
}

function actualizar_permisos(codigo_usuario) {
	var codigo_huerto = $('.nombre-huerto-actual').attr('ID');
	if (document.getElementById(codigo_usuario).checked) {
		$.ajax({
			type: 'POST',
			url: 'http://localhost/Fadming/Web/php/almacenar_permiso_huerto.php',
			data: "huerto="+codigo_huerto+"&usuario="+codigo_usuario,
			dataType: 'json'
		});
	}
	else {
		$.ajax({
			type: 'POST',
			url: 'http://localhost/Fadming/Web/php/eliminar_permiso_huerto.php',
			data: "huerto="+codigo_huerto+"&usuario="+codigo_usuario,
			dataType: 'json'
		});
	}
}

String.prototype.toProperCase = function () {
    return this.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
};
