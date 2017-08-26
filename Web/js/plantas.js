// DOCUMENTO JAVASCRIPT DE plantas.php

// DECLARACIÓN DE CONSTANTES.
const SIN_ESTADO_ACTUAL = -1;
const ID_ACTUAL = "nombre-estado-actual";
const MARGEN_IZQUIERDO_INICIAL = 15;
const MARGEN_SUPERIOR_INICIAL = 25;
const TAMANO_LETRA = 12;

// DECLARACIÓN DE VARIABLES GLOBALES.
var plantas_seleccionadas = [];
var documentoPDF;

$(document).ready(function() {
	$("#planta #icono-seleccion").fadeIn("fast");
	obtener_fincas_usuario();
	validar_selector_finca();
	obtener_estados_grupos();
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
		document.getElementById('nombre-seleccionada').innerHTML = "";
		$('.contenedor-boton-descargar').hide();
		$(".estados-botones-seleccionada").fadeOut(function() {
			$("#nombre-planta-seleccionada").fadeOut();
			$("#nombre-planta-seleccionada").css('width', '0%');
			$('.contenedor-mensaje-explicacion').slideDown();
		});
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
	document.getElementById('nombre-seleccionada').innerHTML = "";
	$('.contenedor-boton-descargar').hide();
	$(".estados-botones-seleccionada").fadeOut(function() {
		$("#nombre-planta-seleccionada").fadeOut();
		$("#nombre-planta-seleccionada").css('width', '0%');
		$('.contenedor-mensaje-explicacion').slideDown();
	});
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
		var formato_planta = "<div class='planta' id='planta-" + codigo + "'>" +
														"<div id='codigo-planta'>CÓDIGO: " + codigo + "</div>" +
														"<div class='nombre-planta' id='nombre-planta-" + codigo + "'>" + nombre + "</div>" +
														"<div class='contenedor-checkbox'>" +
																"<input class='checkbox-planta' id='" + codigo + "' type='checkbox'></input>" +
														"</div>" +
												 "</div>";
		document.getElementById('seleccion-plantas').innerHTML += formato_planta;
}

function opciones_checkbox(opcion) {
	$("#seleccion-plantas .contenedor-checkbox .checkbox-planta").each(function() {
		if (this.type == 'checkbox') {
			this.checked = opcion;
		}
  });
}

function borrar_planta() {
	$("#seleccion-plantas .contenedor-checkbox .checkbox-planta").each(function() {
		if (this.checked) {
			var codigo_planta = this.id;
			$.ajax({
						type: 'POST',
						url: 'http://localhost/Fadming/Web/php/eliminar_planta.php',
						dataType: 'json',
						data: "planta="+codigo_planta,
						success: $('#planta-' + codigo_planta).fadeOut("fast")
				});
		}
	});
}

function gestionar_estados_planta() {
	plantas_seleccionadas = [];
	$("#seleccion-plantas .contenedor-checkbox .checkbox-planta").each(function() {
		if (this.checked) {
			var codigo_planta = this.id;
			plantas_seleccionadas.push(codigo_planta);
		}
	});
	if (plantas_seleccionadas.length != 0) {
		document.getElementById('estados-planta-seleccionada').innerHTML = "";
		$('.contenedor-boton-descargar').hide();
		animacion_gestionar_estados();
	}
}

function animacion_gestionar_estados() {
	document.getElementById('nombre-seleccionada').innerHTML = "";
	$("#nombre-planta-seleccionada").css('width', '0%');
	$('.contenedor-mensaje-explicacion').slideUp(function() {
		$("#nombre-planta-seleccionada").show(function() {
			$("#nombre-planta-seleccionada").animate({'width': '100%'}, "slow", function() {
				if (plantas_seleccionadas.length == 1) {
					document.getElementById('nombre-seleccionada').innerHTML = "CÓDIGO " + plantas_seleccionadas[0] + " | " + document.getElementById('nombre-planta-' + plantas_seleccionadas[0]).innerHTML;
					obtener_planta_estados(plantas_seleccionadas[0]);
				}
				else if (plantas_seleccionadas.length > 1) {
					document.getElementById('nombre-seleccionada').innerHTML = "SELECCIÓN MÚLTIPLE | " + plantas_seleccionadas.length + " plantas";
				}
			});
			$(".estados-botones-seleccionada").slideDown();
		});
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
			document.getElementById('select-planta').value = "";
			document.getElementById('cantidad-planta').value = "";
	}, 1500);
}

function obtener_planta_estados(codigo_planta) {
	$.ajax({
        type: 'POST',
        url: 'http://localhost/Fadming/Web/php/obtener_plantas_estados.php',
				dataType: 'json',
				data: "planta="+codigo_planta,
				success: function(datos) {
					$(datos).each(function(i, valor) {
						insertar_estados_formato(valor.codigo, valor.nombre, valor.actual);
					});
        }
    });
}

function insertar_estados_formato(codigo, nombre, actual) {
	var formato_estado;
	if (actual) {
		formato_estado = "<div class='estado-planta' id='estado-" + codigo + "'>" +
												"<div class='flechas-orden'>" +
													"<div id='flecha-arriba' onclick='mover_arriba_estado(" + codigo + ")'></div>" +
													"<div id='flecha-abajo' onclick='mover_abajo_estado(" + codigo + ")'></div>" +
												"</div>" +
												"<div class='nombre-estado' id='nombre-estado-actual'>" + nombre.toUpperCase() + "</div>" +
												"<div id='eliminar-estado-actual' onclick='eliminar_individual_estado(" + codigo + ")'></div>" +
										 "</div>";
	}
	else {
		formato_estado = "<div class='estado-planta' id='estado-" + codigo + "'>" +
												"<div class='flechas-orden'>" +
													"<div id='flecha-arriba' onclick='mover_arriba_estado(" + codigo + ")'></div>" +
													"<div id='flecha-abajo' onclick='mover_abajo_estado(" + codigo + ")'></div>" +
												"</div>" +
												"<div class='nombre-estado' id='nombre-estado'>" + nombre + "</div>" +
												"<div id='marcar-actual' onclick='marcar_estado_actual(" + codigo + ")'>ACTUAL</div>" +
												"<div id='eliminar-estado' onclick='eliminar_individual_estado(" + codigo + ")'></div>" +
										 "</div>";
	}
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

function marcar_estado_actual(nuevo_estado) {
	actualizar_estado_actual(nuevo_estado);
	document.getElementById('estados-planta-seleccionada').innerHTML = "";
	setTimeout(function() {
		obtener_planta_estados(plantas_seleccionadas[0]);
	}, 10);
}

function mover_arriba_estado(codigo_estado) {
	var estados_planta = [];
	var nuevo_estados_planta = "";
	var estado, posicion_estado, estado_anterior;
	contenedor_estados = document.getElementById('estados-planta-seleccionada').getElementsByClassName('estado-planta');
	for (i = 0; i < contenedor_estados.length; i++) {
		var identificador_completo = $(contenedor_estados[i]).attr('ID');
		var codigo = identificador_completo.substr(7, identificador_completo.length);
		estados_planta[i] = codigo;
		if (codigo == codigo_estado) {
			posicion_estado = i;
		}
	}
	if (posicion_estado != 0) {
		estado_anterior = estados_planta[posicion_estado - 1];
		estados_planta[posicion_estado - 1] = estados_planta[posicion_estado];
		estados_planta[posicion_estado] = estado_anterior;
		for (i = 0; i < estados_planta.length; i++) {
			if (i == (estados_planta.length - 1)) {
				nuevo_estados_planta += estados_planta[i];
			}
			else {
				nuevo_estados_planta += estados_planta[i] + " ";
			}
		}
		actualizar_estados_plantas(nuevo_estados_planta);
		document.getElementById('estados-planta-seleccionada').innerHTML = "";
		setTimeout(function() {
			obtener_planta_estados(plantas_seleccionadas[0]);
		}, 10);
	}
}

function mover_abajo_estado(codigo_estado) {
	var estados_planta = [];
	var nuevo_estados_planta = "";
	var estado, posicion_estado, estado_anterior;
	contenedor_estados = document.getElementById('estados-planta-seleccionada').getElementsByClassName('estado-planta');
	for (i = 0; i < contenedor_estados.length; i++) {
		var identificador_completo = $(contenedor_estados[i]).attr('ID');
		var codigo = identificador_completo.substr(7, identificador_completo.length);
		estados_planta[i] = codigo;
		if (codigo == codigo_estado) {
			posicion_estado = i;
		}
	}
	if (posicion_estado != (estados_planta.length - 1)) {
		estado_anterior = estados_planta[posicion_estado + 1];
		estados_planta[posicion_estado + 1] = estados_planta[posicion_estado];
		estados_planta[posicion_estado] = estado_anterior;
		for (i = 0; i < estados_planta.length; i++) {
			if (i == (estados_planta.length - 1)) {
				nuevo_estados_planta += estados_planta[i];
			}
			else {
				nuevo_estados_planta += estados_planta[i] + " ";
			}
		}
		actualizar_estados_plantas(nuevo_estados_planta);
		document.getElementById('estados-planta-seleccionada').innerHTML = "";
		setTimeout(function() {
			obtener_planta_estados(plantas_seleccionadas[0]);
		}, 10);
	}
}

function accion_boton_anadir_estado() {
	var valor_select = document.getElementById('select-estado').value;
	if (valor_select != "") {
		var estados_planta = "";
		document.getElementById('boton-anadir-estado').value = "Añadiendo...";
		contenedor_estados = document.getElementById('estados-planta-seleccionada').getElementsByClassName('estado-planta');
		for (i = 0; i < contenedor_estados.length; i++) {
			var identificador_completo = $(contenedor_estados[i]).attr('ID');
			var codigo = identificador_completo.substr(7, identificador_completo.length);
			if (i != (contenedor_estados.length - 1)) {
				estados_planta += codigo + " ";
			}
			else {
				estados_planta += codigo;
			}
		}
		if ((plantas_seleccionadas.length > 1) || ((plantas_seleccionadas.length == 1) && (estados_planta.length == 0))) {
			var codigos = valor_select.split(" ");
			actualizar_estado_actual(codigos[0]);
		}
		estados_planta = estados_planta + " " + valor_select;
		actualizar_estados_plantas(estados_planta);
		anadir_nuevo_estado(plantas_seleccionadas[0]);
	}
	else {
		$('#select-estado').css('background-color', '#FADBD8');
		setTimeout(function() {
			$('#select-estado').css('background-color', '#FFFFFF');
		}, 1000);
	}
}

function actualizar_estados_plantas(estados) {
	for (i = 0; i < plantas_seleccionadas.length; i++) {
		$.ajax({
			type: 'POST',
		  url: 'http://localhost/Fadming/Web/php/actualizar_estados_planta.php',
		  data: "planta="+plantas_seleccionadas[i]+"&estados="+estados,
		  dataType: 'json',
		});
	}
}

function actualizar_estado_actual(estado_actual) {
	for (i = 0; i < plantas_seleccionadas.length; i++) {
		$.ajax({
			type: 'POST',
		  url: 'http://localhost/Fadming/Web/php/actualizar_estado_actual.php',
		  data: "planta="+plantas_seleccionadas[i]+"&actual="+estado_actual,
		  dataType: 'json',
		});
	}
}

function anadir_nuevo_estado(codigo_planta) {
		setTimeout(function(){
				document.getElementById('boton-anadir-estado').value = "Añadido";
		}, 1000);
		setTimeout(function(){
			  document.getElementById("estados-planta-seleccionada").innerHTML = "";
				obtener_planta_estados(codigo_planta);
				document.getElementById('boton-anadir-estado').value = "Añadir";
		}, 2000);
}

function eliminar_individual_estado(codigo_borrar) {
	var estados_planta = "";
	contenedor_estados = document.getElementById('estados-planta-seleccionada').getElementsByClassName('estado-planta');
	for (i = 0; i < contenedor_estados.length; i++) {
		var identificador_completo = $(contenedor_estados[i]).attr('ID');
		var codigo = identificador_completo.substr(7, identificador_completo.length);
		if (codigo != codigo_borrar) {
			if (i != (contenedor_estados.length - 1)) {
				estados_planta += codigo + " ";
			}
			else {
				estados_planta += codigo;
			}
		}
	}
	if (estados_planta != "") {
		var id_estado = $('#estado-' + codigo_borrar + ' .nombre-estado').attr('id');
		if (id_estado == ID_ACTUAL) {
			var codigos = estados_planta.split(" ");
			actualizar_estado_actual(codigos[0]);
		}
		actualizar_estados_plantas(estados_planta);
		document.getElementById('estados-planta-seleccionada').innerHTML = "";
		setTimeout(function() {
			obtener_planta_estados(plantas_seleccionadas[0]);
		}, 10);
	}
	else {
		actualizar_estados_plantas(estados_planta);
		actualizar_estado_actual(SIN_ESTADO_ACTUAL);
		document.getElementById('estados-planta-seleccionada').innerHTML = "";
	}
}

function eliminar_todo_estados() {
	document.getElementById('boton-eliminar-todo').value = "Borrando...";
	actualizar_estados_plantas("");
	actualizar_estado_actual(SIN_ESTADO_ACTUAL);
	borrar_todo_estado(plantas_seleccionadas[0]);
}

function borrar_todo_estado(codigo_planta) {
		setTimeout(function(){
				document.getElementById('boton-eliminar-todo').value = "Borrado";
				document.getElementById('estados-planta-seleccionada').innerHTML = "";
		}, 1000);
		setTimeout(function(){
				document.getElementById('boton-eliminar-todo').value = "Borrar todo";
		}, 2000);
}

function accion_generar_qr() {
	$('.contenedor-boton-descargar').fadeOut(function() {
		$('.contenedor-mensaje-qr').fadeIn();
		 generarCodigosQR();
	});
	setTimeout(function() {
		$('.contenedor-mensaje-qr').fadeOut(function() {
			$('.contenedor-boton-descargar').fadeIn();
		});
	}, 1300);
}

function generarCodigosQR() {
	documentoPDF = new jsPDF();
	documentoPDF.setFontSize(TAMANO_LETRA);
	var margen_izquierdo = MARGEN_IZQUIERDO_INICIAL;
	var margen_superior = MARGEN_SUPERIOR_INICIAL;
	for (i = 0; i < plantas_seleccionadas.length; i++) {
		var codigoQR = kjua({text: plantas_seleccionadas[i]});
		if (((i % 3) == 0) && (i != 0)) { // Cambio de fila dentro del PDF. 3 códigos por fila.
			if ((i % 9) == 0) { // Cambio de página dentro del PDF. 9 códigos por página.
				documentoPDF.addPage();
				margen_superior = MARGEN_SUPERIOR_INICIAL;
				margen_izquierdo = MARGEN_IZQUIERDO_INICIAL;
			}
			else {
				margen_superior = margen_superior + 70;
				margen_izquierdo = MARGEN_IZQUIERDO_INICIAL;
			}
		}
		documentoPDF.rect(margen_izquierdo, margen_superior, 60, 70);
		margen_izquierdo = margen_izquierdo + 5;
		margen_superior = margen_superior + 5;
		documentoPDF.addImage(codigoQR.src, 'PNG', margen_izquierdo, margen_superior, 50, 50, null, 'FAST');
		formato_codigo = document.getElementById('nombre-planta-' + plantas_seleccionadas[i]).innerHTML.toUpperCase() + ' ' + plantas_seleccionadas[i];
		documentoPDF.text(margen_izquierdo + (21 - formato_codigo.length), margen_superior + 58, formato_codigo);
		margen_izquierdo = margen_izquierdo + 55;
		margen_superior = margen_superior - 5;
	}
}

function descargarPDF() {
	var posicion = document.getElementById('selector-huerto').selectedIndex;
	var nombreHuerto = document.getElementById('selector-huerto')[posicion].innerHTML;
	var nombrePDF = nombreHuerto.replace(/\s/g,""); // Obtenemos el nombre del huerto como nombre del archivo PDF.
	documentoPDF.save(nombrePDF + '.pdf'); // Generamos un fichero PDF.
}
