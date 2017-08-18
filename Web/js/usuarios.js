// DOCUMENTO JAVASCRIPT DE usuarios.php

// DECLARACIÓN DE CONSTANTES.
const ROLES_FADMING = 2;
const ROLES_USUARIOS = 3;
const ROLES = 1;
const USUARIOS = 2;

$(document).ready(function() {
	$("#usuario #icono-seleccion").fadeIn("fast");
	obtener_usuarios_empresa(ROLES_USUARIOS);
	acciones_seleccion_tabs();
});

function obtener_usuarios_empresa(tipo) {
	$.ajax({
        type: 'POST',
        url: 'http://localhost/Fadming/Web/php/obtener_usuarios_empresa.php',
				dataType: 'json',
				success: function(datos) {
					insertar_usuarios_roles(datos[0], datos[1], tipo)
        }
    });
}

function insertar_usuarios_roles(roles, usuarios, tipo) {
	var formato_usuario, formato_usuario_1, formato_usuario_2;
	if ((tipo == ROLES_USUARIOS) || (tipo == ROLES)) {
		$(roles).each(function(i, valor) {
			var nombre = valor.nombre;
			var codigo = valor.codigo;
			var formato_rol = "<div class='contenedor-rol-empresa' id='" + codigo + "'>" +
														"<div id='nombre-rol'>" + nombre + "</div>" +
														"<div id='eliminar-rol' onclick='eliminar_rol(" + codigo + ")'>Eliminar</div>" +
												"</div>";
			if (codigo > ROLES_FADMING) {
				document.getElementById('lista-roles').innerHTML += formato_rol;
			}
		});
	}
	if ((tipo == ROLES_USUARIOS) || (tipo == USUARIOS)) {
		$(usuarios).each(function(i, valor) {
			var rol = valor.rol;
			formato_usuario_1 = "<div class='contenedor-usuario-lista'>" +
																"<div id='foto-usuario'><img src='data:image/png;base64," + valor.imagen + "'></div>" +
																"<div id='nombre-completo-usuario' onclick='acceder_ficha_usuario(" + valor.codigo + ")'>" + valor.nombre + " " + valor.apellidos + "</div>" +
																"<div id='rol-usuario-empresa'>" +
																		"<select class='selector-rol' onchange='cambiar_rol_usuario(this.value, " + valor.codigo + ")' required>";
			$(roles).each(function(i, valor) {
				var nombre = valor.nombre;
				var codigo = valor.codigo;
				if (rol == codigo) {
					formato_usuario_1 += "<option value='" + codigo + "' selected>" + nombre.toUpperCase() + "</option>";
				}
				else {
					formato_usuario_1 += "<option value='" + codigo + "'>" + nombre.toUpperCase() + "</option>";
				}
			});
			formato_usuario_2 = "</select></div></div>";
			formato_usuario = formato_usuario_1 + formato_usuario_2;
			document.getElementById('lista-usuarios').innerHTML += formato_usuario;
		});
	}
}

function acciones_seleccion_tabs() {
	$('#seleccion-tab-usuarios').click(function() {
		$(this).css('background-color', '#F7DB5C');
		$(this).css('color', '#2A2B2A');
		$(this).css('font-size', '0.9em');
		$('#seleccion-tab-roles').css('background-color', '#2A2B2A');
		$('#seleccion-tab-roles').css('color', '#FFFFFF');
		$('#seleccion-tab-roles').css('font-size', '0.8em');
		$('.contenedor-gestion-roles').fadeOut("fast", function() {
			$('#lista-usuarios').fadeIn();
		});
	});
	$('#seleccion-tab-roles').click(function() {
		$('#seleccion-tab-usuarios').css('background-color', '#2A2B2A');
		$('#seleccion-tab-usuarios').css('color', '#FFFFFF');
		$('#seleccion-tab-usuarios').css('font-size', '0.8em');
		$(this).css('background-color', '#F7DB5C');
		$(this).css('color', '#2A2B2A');
		$(this).css('font-size', '0.9em');
		$('#lista-usuarios').fadeOut("fast", function() {
			$('.contenedor-gestion-roles').fadeIn();
		});
	});
}

function acceder_ficha_usuario(identificador) {
	alert(identificador);
}

function cambiar_rol_usuario(identificador, rol) {
	$.ajax({
		type: 'POST',
		url: 'http://localhost/Fadming/Web/php/actualizar_rol_usuario.php',
		data: "identificador="+identificador+"&rol="+rol,
		dataType: 'json'
	});
}

function eliminar_rol(codigo) {
	$.ajax({
		type: 'POST',
		url: 'http://localhost/Fadming/Web/php/eliminar_rol.php',
		data: "rol="+codigo,
		dataType: 'json',
		success: $('#lista-roles #' + codigo).fadeOut("fast")
	});
}

function anadir_nuevo_rol() {
	var nombre_rol = document.getElementById('nombre_rol').value.toUpperCase();
	$.ajax({
		type: 'POST',
		url: 'http://localhost/Fadming/Web/php/almacenar_rol_empresa.php',
		data: "nombre="+nombre_rol,
		dataType: 'json',
		success: interaccion_anadir_rol()
	});
}

function interaccion_anadir_rol() {
	document.getElementById("boton_rol").value = "Añadiendo...";
	setTimeout(function(){
			document.getElementById("boton_rol").value = "Añadido";
	}, 1500);
	setTimeout(function() {
			document.getElementById('lista-roles').innerHTML = "";
			obtener_usuarios_empresa(ROLES);
			document.getElementById("boton_rol").value = "Añadir rol";
			document.getElementById("nombre_rol").value = "";
	}, 2500);
}
