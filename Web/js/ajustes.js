// DOCUMENTO JAVASCRIPT DE ajustes.php

$(document).ready(function() {
	cambiar_colores_iconos();
	cambiar_colores_accesos();
	obtener_datos_usuario();
	mostrar_nueva_contrasena();
	$("#boton-actualizar").click(function() {
		document.getElementById("boton-actualizar").value = "Actualizando...";
		actualizar_datos_usuario();
	});
	mostrar_borrar_cuenta();
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
	$("#boton-advertencia").hover(
  		function() {
  			document.getElementById("boton-advertencia").innerHTML = "Entendido, deseo eliminarla";
			$(this).css('background-color', '#F7DB5C');
			$(this).css('color', '#000000');
    		$(this).css('cursor', 'pointer');
  		}, function() {
  			document.getElementById("boton-advertencia").innerHTML = "Eliminar cuenta";
  			$(this).css('background-color', '#2A2B2A');
			$(this).css('color', '#FFFFFF');
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

function actualizar_datos_usuario() {
	var nombre       = $("#nombre").val(); 
	var apellidos    = $("#apellidos").val();
	var usuario      = $("#username").val();
	var correo       = $("#correo").val();
	$.ajax({
	    type: 'POST',
	    url: 'http://localhost/GricApp/Web/php/actualizar_datos_usuario.php',
	    success: cambiar_boton_actualizar(),
	    data: "nombre="+nombre+"&apellidos="+apellidos+"&usuario="+usuario+"&correo="+correo,
	    dataType: 'json'
	});
}

function cambiar_boton_actualizar() {
	setTimeout(function(){ 
		document.getElementById("boton-actualizar").value = "Actualizado";
	}, 2000);
	setTimeout(function(){ 
		document.getElementById("boton-actualizar").value = "Actualizar perfil";
	}, 3000);
}

function mostrar_borrar_cuenta() {
	$("#boton-advertencia").click(function() {
		$(".contenedor-borrar-cuenta").animate({'height': '30%'}, "slow");
		setTimeout(function() { 
			$(".contenedor-mensaje-advertencia").css('height', '65%');
		}, 150);
		$(".contenedor-boton-borrar-cuenta").fadeIn();
		document.getElementById("boton-advertencia").id = "titulo-advertencia";
  		$("#titulo-advertencia").css('background-color', '#2A2B2A');
		$("#titulo-advertencia").css('color', '#FFFFFF');
		$("#titulo-advertencia").css('cursor', 'default');
	});
}
