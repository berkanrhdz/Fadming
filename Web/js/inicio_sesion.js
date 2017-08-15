// DOCUMENTO JAVASCRIPT DE index.php

// DECLARACIÓN DE CONSTANTES.
const ERROR_LOGIN = -1;
const LOGIN_CORRECTO = 1;

$(document).ready(function() {
	iniciar_sesion_usuario();
});

function comprobar_datos_inicio() { // Función para la validación de los datos de inicio de sesión.
	if (document.getElementById("usuario_inicio").value.length == 0) { // Comprobación de introducción del usuario.
		$('#usuario_inicio').css('background-color', '#FADBD8');
		document.getElementById("usuario_inicio").placeholder = "Obligatorio";
	    setTimeout(function() {
	    	document.getElementById("usuario_inicio").placeholder = "Nombre";
			$('#usuario_inicio').css('background-color', '#FFFFFF');
		}, 1500);
		return false;
	}
	else if (document.getElementById("contrasena_inicio").value.length == 0) { // Comprobación de introducción de la contraseña.
		$('#contrasena_inicio').css('background-color', '#FADBD8');
		document.getElementById("contrasena_inicio").placeholder = "Obligatorio";
		setTimeout(function() {
		    document.getElementById("contrasena_inicio").placeholder = "Apellidos";
			$("#contrasena_inicio").css('background-color', '#FFFFFF');
		}, 1500);
		return false;
	}
	return true;
}

function iniciar_sesion_usuario() {
	$("#boton-iniciar-sesion").click(function() {
		if (comprobar_datos_inicio()) {
			document.getElementById("boton-iniciar-sesion").value = "Iniciando...";
			setTimeout(function() {
				enviar_datos_iniciar_sesion();
			}, 1000);
		}
	});
}

function vaciar_formulario_inicio() {
	document.getElementById("usuario_inicio").value = "";
	document.getElementById("contrasena_inicio").value = "";
}

function enviar_datos_iniciar_sesion() { // Función para enviar los datos del registro.
    var usuario      = $("#usuario_inicio").val();
    var contrasena   = $("#contrasena_inicio").val();
    $.ajax({
        type: 'POST',
        url: 'http://localhost/Fadming/Web/php/iniciar_sesion.php',
        data: "usuario="+usuario+"&contrasena="+contrasena,
        dataType: 'json',
				success: function(datos) {
						$(datos).each(function(i, valor) {
								if (valor.respuesta == ERROR_LOGIN) {
									realizar_interaccion_error();
								}
								else if (valor.respuesta == LOGIN_CORRECTO) {
									window.location.href = "http://localhost/Fadming/Web/plantas.php";
								}
						});
				}
    });
}

function realizar_interaccion_error() {
	setTimeout(function() {
		document.getElementById("boton-iniciar-sesion").value = "Login incorrecto";
		$('.contenedor-inicio-sesion').css('background-color', '#9E3232');
	}, 1000);
	setTimeout(function() {
		vaciar_formulario_inicio();
		document.getElementById("boton-iniciar-sesion").value = "Iniciar sesión";
		$('.contenedor-inicio-sesion').css('background-color', '#76A06B');
	}, 2000);
}
