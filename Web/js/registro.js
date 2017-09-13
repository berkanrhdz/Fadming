// DOCUMENTO JAVASCRIPT DE index.php

// DECLARACIÓN DE CONSTANTES.
const CLIENTE_PARTICULAR = 1;
const CLIENTE_EMPRESA = 2;
const ADMINISTRADOR = 1;
const TRABAJADOR = 2;
const DATOS_CORRECTO = 1;
const DATOS_ERROR = -1;

// DECLARACIÓN DE VARIABLES GLOBALES.
var datos_empresa = [];

$(document).ready(function() {
	marcar_opciones_empresa();
});

function comprobar_datos_personales() { // Función para la validación del formulario de registro.
	var contrasena = document.getElementById("contrasena").value;
	var repetir_contrasena = document.getElementById("repetir-contrasena").value;
	if (document.getElementById("nombre").value.length == 0) { // Comprobación de introducción del nombre.
		$('#nombre').css('background-color', '#FADBD8');
		document.getElementById("nombre").placeholder = "Obligatorio";
	    setTimeout(function() {
	    	document.getElementById("nombre").placeholder = "Nombre";
			$('#nombre').css('background-color', '#FFFFFF');
		}, 1500);
		return false;
	}
	else if (document.getElementById("apellidos").value.length == 0) { // Comprobación de introducción de los apellidos.
		$('#apellidos').css('background-color', '#FADBD8');
		document.getElementById("apellidos").placeholder = "Obligatorio";
		setTimeout(function() {
		    document.getElementById("apellidos").placeholder = "Apellidos";
			$("#apellidos").css('background-color', '#FFFFFF');
		}, 1500);
		return false;
	}
	else if (document.getElementById("usuario").value.length == 0) { // Comprobación de introducción del nombre de usuario.
		$('#usuario').css('background-color', '#FADBD8');
		document.getElementById("usuario").placeholder = "Obligatorio";
		setTimeout(function() {
			document.getElementById("usuario").placeholder = "Nombre de usuario";
			$("#usuario").css('background-color', '#FFFFFF');
		}, 1500);
		return false;
	}
	else if (document.getElementById("correo").value.length == 0) { // Comprobación de introducción del correo electrónico.
		$('#correo').css('background-color', '#FADBD8');
		document.getElementById("correo").placeholder = "Obligatorio";
		setTimeout(function() {
			document.getElementById("correo").placeholder = "Correo electrónico";
			$("#correo").css('background-color', '#FFFFFF');
		}, 1500);
		return false;
	}
	else if (!(/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(document.getElementById("correo").value))) {
		document.getElementById("correo").value = "";
		$('#correo').css('background-color', '#FADBD8');
		document.getElementById("correo").placeholder = "Formato incorrecto";
		setTimeout(function() {
			document.getElementById("correo").placeholder = "Correo electrónico";
			$('#correo').css('background-color', '#FFFFFF');
		}, 1500);
		return false;
	}
	else if (document.getElementById("contrasena").value.length == 0) { // Comprobación de introducción de la contraseña.
		$('#contrasena').css('background-color', '#FADBD8');
		document.getElementById("contrasena").placeholder = "Obligatorio";
		setTimeout(function() {
			document.getElementById("contrasena").placeholder = "Contraseña";
			$("#contrasena").css('background-color', '#FFFFFF');
		}, 1500);
		return false;
	}
	else if (document.getElementById("repetir-contrasena").value.length == 0) { // Comprobación de introducción de la repetición de la contraseña.
		$('#repetir-contrasena').css('background-color', '#FADBD8');
		document.getElementById("repetir-contrasena").placeholder = "Obligatorio";
		setTimeout(function() {
			document.getElementById("repetir-contrasena").placeholder = "Repetir contraseña";
			$("#repetir-contrasena").css('background-color', '#FFFFFF');
		}, 1500);
		return false;
	}
	else if (contrasena != repetir_contrasena) {
		document.getElementById("repetir-contrasena").value = "";
		$('#repetir-contrasena').css('background-color', '#FADBD8');
		document.getElementById("repetir-contrasena").placeholder = "No coinciden";
		setTimeout(function() {
			$('#repetir-contrasena').css('background-color', '#FFFFFF');
			document.getElementById("repetir-contrasena").placeholder = "Repetir contraseña";
		}, 1500);
		return false;
	}
	return true;
}

function comprobar_datos_empresa() { // Función para validar los datos de creación de empresa.
	var contrasena = document.getElementById("contrasena-empresa").value;
	var repetir_contrasena = document.getElementById("repetir-contrasena-empresa").value;
	if (document.getElementById("nombre-empresa").value.length == 0) { // Comprobación de introducción del nombre de empresa.
		$('#nombre-empresa').css('background-color', '#FADBD8');
		document.getElementById("nombre-empresa").placeholder = "Obligatorio";
			setTimeout(function() {
				document.getElementById("nombre-empresa").placeholder = "Nombre";
			$('#nombre-empresa').css('background-color', '#FFFFFF');
		}, 1500);
		return false;
	}
	else if (document.getElementById("direccion").value.length == 0) { // Comprobación de introducción de la dirección.
		$('#direccion').css('background-color', '#FADBD8');
		document.getElementById("direccion").placeholder = "Obligatorio";
		setTimeout(function() {
				document.getElementById("direccion").placeholder = "Dirección";
			$("#direccion").css('background-color', '#FFFFFF');
		}, 1500);
		return false;
	}
	else if (document.getElementById("telefono").value.length == 0) { // Comprobación de introducción del teléfono.
		$('#telefono').css('background-color', '#FADBD8');
		document.getElementById("telefono").placeholder = "Obligatorio";
		setTimeout(function() {
			document.getElementById("telefono").placeholder = "Teléfono";
			$("#telefono").css('background-color', '#FFFFFF');
		}, 1500);
		return false;
	}
	else if (document.getElementById("poblacion").value.length == 0) { // Comprobación de introducción de la población.
		$('#poblacion').css('background-color', '#FADBD8');
		document.getElementById("poblacion").placeholder = "Obligatorio";
		setTimeout(function() {
			document.getElementById("poblacion").placeholder = "Población";
			$("#poblacion").css('background-color', '#FFFFFF');
		}, 1500);
		return false;
	}
	else if (document.getElementById("codigo-postal").value.length == 0) { // Comprobación de introducción del codigo postal.
		$('#codigo-postal').css('background-color', '#FADBD8');
		document.getElementById("codigo-postal").placeholder = "Obligatorio";
		setTimeout(function() {
			document.getElementById("codigo-postal").placeholder = "Código postal";
			$("#codigo-postal").css('background-color', '#FFFFFF');
		}, 1500);
		return false;
	}
	else if (document.getElementById("contrasena-empresa").value.length == 0) { // Comprobación de introducción de la contraseña.
		$('#contrasena-empresa').css('background-color', '#FADBD8');
		document.getElementById("contrasena-empresa").placeholder = "Obligatorio";
		setTimeout(function() {
			document.getElementById("contrasena-empresa").placeholder = "Contraseña";
			$("#contrasena-empresa").css('background-color', '#FFFFFF');
		}, 1500);
		return false;
	}
	else if (document.getElementById("repetir-contrasena-empresa").value.length == 0) { // Comprobación de introducción de la repetición de la contraseña.
		$('#repetir-contrasena-empresa').css('background-color', '#FADBD8');
		document.getElementById("repetir-contrasena-empresa").placeholder = "Obligatorio";
		setTimeout(function() {
			document.getElementById("repetir-contrasena-empresa").placeholder = "Repetir contraseña";
			$("#repetir-contrasena-empresa").css('background-color', '#FFFFFF');
		}, 1500);
		return false;
	}
	else if (contrasena != repetir_contrasena) {
		document.getElementById("repetir-contrasena-empresa").value = "";
		$('#repetir-contrasena-empresa').css('background-color', '#FADBD8');
		document.getElementById("repetir-contrasena-empresa").placeholder = "No coinciden";
		setTimeout(function() {
			$('#repetir-contrasena-empresa').css('background-color', '#FFFFFF');
			document.getElementById("repetir-contrasena-empresa").placeholder = "Repetir contraseña";
		}, 1500);
		return false;
	}
	return true;
}

function comprobar_datos_empresa_existente(nombre, contrasena) {
	if (nombre.length == 0) { // Comprobación de introducción del nombre de la empresa existente.
		$('#nombre-existente').css('background-color', '#FADBD8');
		document.getElementById("nombre-existente").placeholder = "Obligatorio";
		setTimeout(function() {
			document.getElementById("nombre-existente").placeholder = "Nombre de la empresa";
			$("#nombre-existente").css('background-color', '#FFFFFF');
		}, 1500);
		return false;
	}
	else if (contrasena.length == 0) { // Comprobación de introducción del contraseña de la empresa existente.
		$('#contrasena-existente').css('background-color', '#FADBD8');
		document.getElementById("contrasena-existente").placeholder = "Obligatorio";
		setTimeout(function() {
			document.getElementById("contrasena-existente").placeholder = "Contraseña de acceso";
			$("#contrasena-existente").css('background-color', '#FFFFFF');
		}, 1500);
		return false;
	}
	return true;
}

function comprobar_contrasena_empresa() { // Función para comprobar la contraseña de unión a una empresa existente.
	var nombre = document.getElementById('nombre-existente').value;
	var contrasena = document.getElementById('contrasena-existente').value;
	if (comprobar_datos_empresa_existente(nombre, contrasena)) {
		obtener_id_nombre_empresa(nombre, contrasena);
	}
}

function cambiar_registro_empresa() { // Función para pasar del registro de usuario al de empresa.
		if (comprobar_datos_personales()) {
			$(".contenedor-datos-personales").fadeOut();
			setTimeout(function() {
				$(".contenedor-datos-empresa").fadeIn(1000);
			}, 300);
			$('#boton-continuar-registro').removeAttr('onclick');
			document.getElementById('boton-continuar-registro').setAttribute("onclick", "registrar_usuario()");
			document.getElementById('boton-continuar-registro').setAttribute("disabled", "true");
			$("#boton-continuar-registro").css('opacity', '0.5');
			document.getElementById('boton-continuar-registro').name = "boton-registro";
			document.getElementById('boton-continuar-registro').value = "Registrarme";
			document.getElementById('boton-continuar-registro').id = "boton-registro";
	 }
}

function marcar_opciones_empresa() { // Función para ir almacenando las opciones en el registro de empresa.
	$("#boton-cliente-particular").click(function() {
		$('#boton-registro').removeAttr('disabled');
		$("#boton-registro").css('opacity', '1.0');
		datos_empresa[0] = CLIENTE_PARTICULAR;
	});
	$("#boton-cliente-empresa").click(function() {
		$('.contenedor-particular-empresa').slideUp();
		$('.contenedor-nueva-existente').slideDown();
		document.getElementById('boton-registro').setAttribute("disabled", "true");
		$("#boton-registro").css('opacity', '0.5');
	});
	$("#boton-empresa-nueva").click(function() {
		$('.contenedor-nueva-existente').slideUp();
		$('.contenedor-empresa-nueva').slideDown();
		$('#boton-registro').removeAttr('disabled');
		$("#boton-registro").css('opacity', '1.0');
		datos_empresa[0] = CLIENTE_EMPRESA; // Tipo de cliente.
		datos_empresa[1] = ADMINISTRADOR; // Rol
	});
	$("#boton-empresa-existente").click(function() {
		$('.contenedor-nueva-existente').slideUp();
		$('.contenedor-empresa-existente').slideDown();
		$('#boton-registro').removeAttr('disabled');
		$("#boton-registro").css('opacity', '1.0');
		datos_empresa[0] = CLIENTE_EMPRESA; // Tipo de cliente.
		datos_empresa[1] = TRABAJADOR; // Rol
	});
}

function registrar_usuario() { // Función que registra al usuario y muestra la interacción.
	if (datos_empresa.length == 1) { // Si es un usuario PARTICULAR.
		document.getElementById("boton-registro").value = "Registrando...";
		enviar_registro_usuario(null); // Pasamos null como código de empresa.
		setTimeout(function() {
			document.getElementById("boton-registro").value = "Registrado";
		}, 2000);
		setTimeout(function(){
			location.reload(true);
		}, 3000);
	}
	else if (datos_empresa.length == 2) { // Si es un usuario EMPRESA.
		if (datos_empresa[1] == ADMINISTRADOR) { // Si es una nueva empresa y administrador.
			if (comprobar_datos_empresa()) {
				document.getElementById("boton-registro").value = "Registrando...";
				enviar_registro_empresa();
				setTimeout(function(){
					document.getElementById("boton-registro").value = "Registrado";
				}, 2000);
				setTimeout(function(){
					location.reload(true);
				}, 3000);
			}
		}
		else if (datos_empresa[1] == TRABAJADOR) { // Si es una empresa existente y trabajador.
			comprobar_contrasena_empresa();
		}
	}
}

function enviar_registro_usuario(codigo_empresa) { // Función para enviar los datos del registro.
    var nombre       = $("#nombre").val();
    var apellidos    = $("#apellidos").val();
    var usuario      = $("#usuario").val();
    var correo       = $("#correo").val();
    var contrasena   = $("#contrasena").val();
		var tipo         = datos_empresa[0];
		var empresa      = codigo_empresa;
		var rol          = datos_empresa[1];
    $.ajax({
        type: 'POST',
        url: 'http://localhost/Fadming/Web/php/registrar_usuario.php',
        data: "nombre="+nombre+"&apellidos="+apellidos+"&usuario="+usuario+"&correo="+correo+"&contrasena="+contrasena+"&tipo="+tipo+"&empresa="+empresa+"&rol="+rol,
        dataType: 'json'
    });
}

function enviar_registro_empresa() { // Función para enviar los datos del registro.
		var codigo;
    var nombre       = $("#nombre-empresa").val();
    var direccion    = $("#direccion").val();
    var poblacion    = $("#poblacion").val();
    var telefono     = $("#telefono").val();
    var cp           = $("#codigo-postal").val();
		var contrasena   = $("#contrasena-empresa").val();
    $.ajax({
        type: 'POST',
        url: 'http://localhost/Fadming/Web/php/registrar_empresa.php',
        data: "nombre="+nombre+"&direccion="+direccion+"&poblacion="+poblacion+"&cp="+cp+"&telefono="+telefono+"&contrasena="+contrasena,
        dataType: 'json',
				success: function(datos) {
						$(datos).each(function(i, valor) {
								var codigo = valor.codigo;
								enviar_registro_usuario(codigo);
						});
				}
    });
}

function obtener_id_nombre_empresa(nombre_empresa, contrasena_empresa) { // Función para obtener el id y el nombre de empresa.
	$.ajax({
			type: 'POST',
			url: 'http://localhost/Fadming/Web/php/obtener_id_nombre_empresa.php',
			data: "nombre="+nombre_empresa+"&contrasena="+contrasena_empresa,
			dataType: 'json',
			success: function(datos) {
					$(datos).each(function(i, valor) {
						realizar_interaccion_contrasena(valor.respuesta, valor.codigo);
					});
			}
	});
}

function realizar_interaccion_contrasena(respuesta, codigo_empresa) { // Función para realizar la interacción de comprobación de empresa.
	if (respuesta == DATOS_ERROR) {
		$('.contenedor-empresa-existente').css('background-color', '#9E3232');
		document.getElementById("boton-registro").value = "Datos incorrectos";
		setTimeout(function() {
			document.getElementById("nombre-existente").value = "";
			document.getElementById("contrasena-existente").value = "";
			$('.contenedor-empresa-existente').css('background-color', '#2A2B2A');
			document.getElementById("boton-registro").value = "Registrarme";
		}, 1500);
	}
	else if (respuesta == DATOS_CORRECTO) {
		document.getElementById("boton-registro").value = "Registrando...";
		enviar_registro_usuario(codigo_empresa);
		setTimeout(function() {
			location.reload();
		}, 1000);
	}
}
