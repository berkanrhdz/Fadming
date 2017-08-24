// DOCUMENTO JAVASCRIPT DE plantas.php

$(document).ready(function() {
	$("#planta #icono-seleccion").fadeIn("fast");
	obtener_fincas_usuario();
	validar_selector_finca();
	generar_codigos_qr();
	obtener_estados_grupos();
	accion_boton_anadir_estado();
});

function obtener_fincas_usuario() {
	$.ajax({
        type: 'POST',
        url: 'http://localhost/Fadming/Web/php/obtener_fincas_usuario.php',
				dataType: 'json',
				success: function(datos) {
						$(datos).each(function(i, valor) {
							insertar_finca_formato(valor.codigo, valor.nombre);
						});
        }
    });
}

function insertar_finca_formato(codigo, nombre) {
		var formato_finca = "<option value='" + codigo + "'>" + nombre + "</option>";
		document.getElementById('selector-finca').innerHTML += formato_finca;
}

function validar_selector_finca() {
	document.getElementById('selector-finca').onchange = function() {
		document.getElementById('seleccion-plantas').innerHTML = "";
		$('.contenedor-anadir-gestionar').fadeOut();
		document.getElementById('selector-huerto').innerHTML = "<option value='' disabled selected hidden>Seleccione un huerto...</option>";
		obtener_huertos_usuario(document.getElementById('selector-finca').value);
		$(".contenedor-seleccion-huerto").slideDown();
	};
}

function obtener_huertos_usuario(codigo_finca) {
	$.ajax({
        type: 'POST',
        url: 'http://localhost/Fadming/Web/php/obtener_huertos_usuario.php',
				dataType: 'json',
				data: "finca="+codigo_finca,
				success: function(datos) {
					$(datos).each(function(i, valor) {
						insertar_huerto_formato(valor.codigo, valor.nombre);
					});
        }
    });
}

function insertar_huerto_formato(codigo, nombre) {
		var formato_huerto = "<option value='" + codigo + "'>" + nombre + "</option>";
		document.getElementById('selector-huerto').innerHTML += formato_huerto;
}

function validar_selector_huertos() {
	document.getElementById('seleccion-plantas').innerHTML = "";
	$('.contenedor-anadir-gestionar').fadeOut(function() {
		$('.contenedor-mensaje-cargando').fadeIn();
	});
	setTimeout(function() {
		$('.contenedor-mensaje-cargando').fadeOut(function() {
			obtener_plantas_usuario(document.getElementById('selector-huerto').value);
			$('#seleccion-plantas').fadeIn();
			var posicion = document.getElementById('selector-huerto').selectedIndex;
			var nombre = document.getElementById('selector-huerto')[posicion].innerHTML;
			document.getElementById('titulo-anadir-planta').innerHTML = "Añadir plantas a " + nombre;
			document.getElementById('select-planta').innerHTML = "<option value='' disabled selected hidden>Tipo de planta</option>";
			obtener_tipos_plantas(document.getElementById('selector-finca').value);
			$('.contenedor-anadir-gestionar').fadeIn();
		});
	}, 1100);
}

function obtener_plantas_usuario(codigo_huerto) {
	$.ajax({
        type: 'POST',
        url: 'http://localhost/Fadming/Web/php/obtener_plantas_usuario.php',
				dataType: 'json',
				data: "huerto="+codigo_huerto,
				success: function(datos) {
					$(datos).each(function(i, valor) {
						insertar_planta_formato(valor.codigo, valor.nombre);
					});
        }
    });
}

function insertar_planta_formato(codigo, nombre) {
		var formato_planta = "<div class='planta'>" +
														"<div id='codigo-planta'>CÓDIGO: " + codigo + "</div>" +
														"<div id='nombre-planta'>" + nombre + "</div>" +
														"<div class='contenedor-checkbox'>" +
																"<input class='checkbox-planta' id='" + codigo + "' type='checkbox'></input>" +
														"</div>" +
												 "</div>";
		document.getElementById('seleccion-plantas').innerHTML += formato_planta;
}

function marcar_todos_checkbox() {
	$("#seleccion-plantas .contenedor-checkbox .checkbox-planta").each(function(){
		if (this.type == 'checkbox') {
			this.checked = 1;
		}
  });
}

function obtener_tipos_plantas(codigo_finca) {
	$.ajax({
        type: 'POST',
        url: 'http://localhost/Fadming/Web/php/obtener_tipos_plantas_finca.php',
				dataType: 'json',
				data: "finca="+codigo_finca,
				success: function(datos) {
					$(datos).each(function(i, valor) {
						insertar_tipo_formato(valor.nombre);
					});
        }
    });
}

function insertar_tipo_formato(nombre) {
	var formato_tipo = "<option value='" + nombre + "'>" + nombre + "</option>";
	document.getElementById('select-planta').innerHTML += formato_tipo;
}

function validar_anadir_planta(nombre, cantidad) {
	var texto_anterior = document.getElementById('titulo-anadir-planta').innerHTML;
	if (nombre.length == 0) { // Comprobación de introducción del nombre.
		$('#titulo-anadir-planta').css('background-color', '#9E3232');
		document.getElementById('titulo-anadir-planta').innerHTML = "Debe seleccionar un tipo de planta";
			setTimeout(function() {
				document.getElementById('titulo-anadir-planta').innerHTML = texto_anterior;
			$('#titulo-anadir-planta').css('background-color', '#2A2B2A');
		}, 1500);
		return false;
	}
	else if (cantidad.length == 0) { // Comprobación de introducción de la cantidad.
		$('#titulo-anadir-planta').css('background-color', '#9E3232');
		document.getElementById('titulo-anadir-planta').innerHTML = "Debe añadir una cantidad";
			setTimeout(function() {
				document.getElementById('titulo-anadir-planta').innerHTML = texto_anterior;
			$('#titulo-anadir-planta').css('background-color', '#2A2B2A');
		}, 1500);
		return false;
	}
	else if (!(/^\d*$/.test(cantidad))) {
		$('#titulo-anadir-planta').css('background-color', '#9E3232');
		document.getElementById('titulo-anadir-planta').innerHTML = "Formato de cantidad incorrecto";
			setTimeout(function() {
				document.getElementById('titulo-anadir-planta').innerHTML = texto_anterior;
			$('#titulo-anadir-planta').css('background-color', '#2A2B2A');
		}, 1500);
		return false;
	}
	return true;
}

function anadir_planta() {
	var codigo_huerto = document.getElementById('selector-huerto').value;
	var nombre = document.getElementById('select-planta').value;
	var cantidad = document.getElementById('cantidad-planta').value;
	if (validar_anadir_planta(nombre, cantidad)) {
		document.getElementById("boton-anadir-planta").value = "Añadiendo...";
		$.ajax({
        type: 'POST',
        url: 'http://localhost/Fadming/Web/php/almacenar_planta.php',
				dataType: 'json',
				data: "huerto="+codigo_huerto+"&nombre="+nombre+"&cantidad="+cantidad,
				success: interaccion_anadir_planta(codigo_huerto, cantidad)
    });
	}
}

function interaccion_anadir_planta(codigo_huerto, cantidad) {
	setTimeout(function() {
		if (cantidad > 1) {
			document.getElementById("boton-anadir-planta").value = "Añadidas";
		}
		else if (cantidad == 1) {
			document.getElementById("boton-anadir-planta").value = "Añadida";
		}
	}, 1000);
	setTimeout(function() {
			document.getElementById('seleccion-plantas').innerHTML = "";
			obtener_plantas_usuario(codigo_huerto);
			document.getElementById("boton-anadir-planta").value = "Añadir planta";
			document.getElementById('select-planta').innerHTML = "<option value='' disabled selected hidden>Tipo de planta</option>";
			document.getElementById('cantidad-planta').value = "";
	}, 1500);
}

function gestionar_estados_planta(codigo) {
	$("#nombre-planta-seleccionada").css('display', 'none');
	document.getElementById('nombre-seleccionada').innerHTML = "";
	$("#nombre-planta-seleccionada").css('width', '0%');
	$("#nombre-planta-seleccionada").fadeIn();
	$('.contenedor-mensaje-explicacion').slideUp();
	setTimeout(function() {
		document.getElementById('nombre-seleccionada').innerHTML = document.getElementById('nombre-planta-' + identificador).innerHTML;
	}, 800);
	$("#nombre-planta-seleccionada").animate({'width': '100%'}, "slow");
	document.getElementById('estados-planta-seleccionada').innerHTML = "";
	setTimeout(function() {
		$('.seleccion-estados-planta-seleccionada').slideDown();
		obtener_planta_estados(codigo);
	}, 1000);
}

function obtener_planta_estados(codigo_planta) {
	$.ajax({
        type: 'POST',
        url: 'http://localhost/Fadming/Web/php/obtener_plantas_estados.php',
				dataType: 'json',
				data: "planta="+codigo_planta,
				success: function(datos) {
					$(datos).each(function(i, valor) {
						insertar_estados_formato(valor.codigo, valor.nombre);
					});
        }
    });
}

function insertar_estados_formato(codigo, nombre) {
		var formato_estado = "<div class='estado-planta' id='" + codigo + "'>" + nombre + "</div>";
		document.getElementById('estados-planta-seleccionada').innerHTML += formato_estado;
}

function obtener_estados_grupos() {
	$.ajax({
        type: 'POST',
        url: 'http://localhost/Fadming/Web/php/obtener_estados_grupos.php',
				dataType: 'json',
				success: function(datos) {
					insertar_estados_grupos(datos[0], datos[1]);
        }
    });
}

function insertar_estados_grupos(estados, grupos) {
		$(estados).each(function(i, valor) {
			var formato_option_select = "<option value='" + valor.codigo + "'>" + valor.nombre + "</option>";
			document.getElementById('estados-select').innerHTML += formato_option_select;
		});
		$(grupos).each(function(i, valor) {
			var formato_option_select = "<option value='" + valor.estados + "'>" + valor.nombre + "</option>";
			document.getElementById('grupos-select').innerHTML += formato_option_select;
		});
}

function accion_boton_anadir_estado() {
	$('#boton_anadir_estado').click(function() {
		document.getElementById("boton_anadir_estado").childNodes[0].nodeValue = "Añadiendo...";
		var valor_select = document.getElementById('selector-estado').value;
		if (valor_select != "") {
			var identificador_planta = document.getElementById('nombre-seleccionada').innerHTML;
			var array_identificador_planta = identificador_planta.split(' ');
 			var codigo = array_identificador_planta[0];
			var estados_planta = "";
			contenedor_estados = document.getElementById('estados-planta-seleccionada').getElementsByClassName('estado-planta');
			for (i = 0; i < contenedor_estados.length; i++) {
				identificador = $(contenedor_estados[i]).attr('ID');
				if (i != (contenedor_estados.length - 1)) {
					estados_planta += identificador + " ";
				}
				else {
					estados_planta += identificador;
				}
			}
			estados_planta = estados_planta + " " + valor_select;
			insertar_estados_plantas(codigo, estados_planta);
		}
	});
}

function insertar_estados_plantas(planta, estados) {
		$.ajax({
			type: 'POST',
		  url: 'http://localhost/Fadming/Web/php/actualizar_estados_planta.php',
		  success: anadir_nuevo_estado(planta),
		  data: "planta="+planta+"&estados="+estados,
		  dataType: 'json'
		});
}

function anadir_nuevo_estado(codigo_planta) {
		setTimeout(function(){
				document.getElementById("boton_anadir_estado").childNodes[0].nodeValue = "Añadido";
		}, 1500);
		setTimeout(function(){
			  document.getElementById("estados-planta-seleccionada").innerHTML = "";
				obtener_planta_estados(codigo_planta);
				document.getElementById("boton_anadir_estado").childNodes[0].nodeValue = "Añadir";
		}, 2500);
}


function generar_codigos_qr() {
	$('#boton_generar_codigo').click(function() {
		$('#codigo-qr').css('display', 'none');
		$('.contenedor-botones-imprimir').css('display', 'none');
		$('.contenedor-mensaje-cargando-qr').slideDown();
		setTimeout(function() {
			$('.contenedor-mensaje-cargando-qr').fadeOut();
		}, 1500);
		setTimeout(function() {
			$('#codigo-qr').fadeIn();
			$('.contenedor-botones-imprimir').fadeIn();
			document.getElementById('codigo-qr').innerHTML = "";
			var nombre_identificador = document.getElementById('nombre-seleccionada').innerHTML;
			var nombre_identificador_espacios = nombre_identificador.split(' ');
			var identificador_planta = nombre_identificador_espacios[0];
			var codigo_qr = kjua({text: identificador_planta});
			var codigo_qr_valido = new Image();
			document.getElementById('codigo-qr').appendChild(codigo_qr);
			var crossorigin = $('#codigo-qr img').attr('crossorigin');
			var src         = $('#codigo-qr img').attr('src');
			codigo_qr_valido.crossorigin = crossorigin;
			codigo_qr_valido.src         = src;
			document.getElementById('codigo-qr').innerHTML = "";
			document.getElementById('codigo-qr').appendChild(codigo_qr_valido);
			var nombre_imagen = identificador_planta.replace(" ", "_").toLowerCase();
			var a = "<a href='" + src + "' download='" + nombre_imagen + "'>Descargar código QR</a>";
			document.getElementById('boton_descargar_imagen').innerHTML = a;
			var p = $('#boton_descargar_imagen a').attr('href');
		}, 2000);
	});
}
