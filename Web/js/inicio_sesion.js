// DOCUMENTO JAVASCRIPT DE index.php

$(document).ready(function() {
	iniciar_sesion_usuario();
});

function comprobar_datos_inicio() { // Función para la validación de los datos de inicio de sesión.
	if (document.getElementById("usuario_inicio").value.length == 0) { // Comprobación de introducción del nombre.
		$('#usuario_inicio').css('background-color', '#FADBD8');
		document.getElementById("usuario_inicio").placeholder = "Obligatorio";
	    setTimeout(function() { 
	    	document.getElementById("usuario_inicio").placeholder = "Nombre";
			$('#usuario_inicio').css('background-color', '#FFFFFF');
		}, 1500);
		return false;
	}
	else if (document.getElementById("contrasena_inicio").value.length == 0) { // Comprobación de introducción de los apellidos.
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
			enviar_datos_iniciar_sesion();
			vaciar_formulario_inicio();
			window.location.assign('perfil.php');
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
        url: 'http://localhost/GricApp/Web/php/iniciar_sesion.php',
        data: "usuario="+usuario+"&contrasena="+contrasena,
        dataType: 'json'
    });
}