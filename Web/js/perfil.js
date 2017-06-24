// DOCUMENTO JAVASCRIPT DE perfil.php

$(document).ready(function() {
	cambiar_colores_iconos();
	cambiar_colores_accesos();
	obtener_datos_usuario();
	mostrar_nueva_contrasena();
});

function cambiar_colores_iconos() { // Función para cambiar los colores de los iconos al pasar por encima.
	$("#icono-ajustes").hover(
  		function() {
    		$(this).css('background-image', 'url("images/iconos/negro/ajustes.png")');
    		$(this).css('cursor', 'pointer');
  		}, function() {
    		$(this).css('background-image', 'url("images/iconos/blanco/ajustes.png")');
  		}
	);
	$("#icono-cerrar-sesion").hover(
  		function() {
    		$(this).css('background-image', 'url("images/iconos/negro/cerrar-sesion.png")');
    		$(this).css('cursor', 'pointer');
  		}, function() {
    		$(this).css('background-image', 'url("images/iconos/blanco/cerrar-sesion.png")');
  		}
	);
}

function cambiar_colores_accesos() { // Función para cambiar los colores de los accesos de la barra lateral al pasar por encima.
	var identificador;
	$(".fila-acceso").hover(
		function() {
			identificador = $(this).attr('ID');
			$('#' + identificador).css('background-color', '#F7DB5C');
			$('#' + identificador).css('cursor', 'pointer');
			$('#texto-' + identificador).css('color', '#000000');
			$('#icono-' + identificador).css('background-image', 'url("images/iconos/negro/' + identificador + '.png")');
	  	}, function() {
			identificador = $(this).attr('ID');
			$('#' + identificador).css('background-color', '#2A2B2A');
			$('#texto-' + identificador).css('color', '#FFFFFF');
			$('#icono-' + identificador).css('background-image', 'url("images/iconos/blanco/' + identificador + '.png")');
	  	}
	);
}

function obtener_datos_usuario() {
	$.ajax({
        type: 'POST',
        url: 'http://localhost/GricApp/Web/php/mostrar_datos_usuario.php',
        success: function(datos) {
			var JSON_datos = JSON.parse(datos);
    		document.getElementById("nombre").value = JSON_datos[0].nombre;
    		document.getElementById("apellidos").value = JSON_datos[0].apellidos;
    		document.getElementById("correo").value = JSON_datos[0].correo;
    		document.getElementById("username").value = JSON_datos[0].usuario;
    		document.getElementById("fecha-registro").innerHTML = JSON_datos[0].fecha_registro;
    		document.getElementById("rol-usuario").innerHTML = JSON_datos[0].rol;
        }
    });
}

function mostrar_nueva_contrasena() {
	$("#boton-cambiar-contrasena").click(function() {
		document.getElementById("boton-cambiar-contrasena").value = "Cambiar contrasena";
		$("#boton-cambiar-contrasena").css('width', '35%');
		$("#nueva-contrasena").slideDown(500);
		$("#nueva-contrasena").animate({'width': '60%'}, "slow");
	});
}
