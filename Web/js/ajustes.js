// DOCUMENTO JAVASCRIPT DE ajustes.php

$(document).ready(function() {
	obtener_datos_usuario();
	mostrar_nueva_contrasena();
	actualizar_datos_usuario();
	mostrar_borrar_cuenta();
});

function obtener_datos_usuario() {
	$.ajax({
        type: 'POST',
        url: 'http://localhost/Fadming/Web/php/obtener_datos_usuario.php',
        success: function(datos) {
					var JSON_datos = JSON.parse(datos);
    				document.getElementById("nombre").value = JSON_datos[0].nombre;
    				document.getElementById("apellidos").value = JSON_datos[0].apellidos;
    				document.getElementById("correo").value = JSON_datos[0].correo;
    				document.getElementById("username").value = JSON_datos[0].usuario;
    				document.getElementById("fecha-registro").innerHTML = JSON_datos[0].fecha_registro;
    				document.getElementById("rol-usuario").innerHTML = JSON_datos[0].rol;
						document.getElementById("foto-perfil").innerHTML = "<img src='data:image/png;base64," + JSON_datos[0].imagen + "'>";
        }
    });
}

function mostrar_nueva_contrasena() {
	$("#boton-cambiar-contrasena").click(function() {
		document.getElementById("boton-cambiar-contrasena").value = "Cambiar contrasena";
		$("#boton-cambiar-contrasena").css('width', '35%');
		$("#nueva-contrasena").slideDown(500);
		$("#nueva-contrasena").animate({'width': '60%'}, "slow");
		document.getElementById("boton-cambiar-contrasena").id = "boton-nueva-contrasena";
	});
}

function actualizar_datos_usuario() {
	$("#boton-actualizar").click(function() {
		document.getElementById("boton-actualizar").value = "Actualizando...";
		var nombre       = $("#nombre").val();
		var apellidos    = $("#apellidos").val();
		var usuario      = $("#username").val();
		var correo       = $("#correo").val();
		$.ajax({
		    type: 'POST',
		    url: 'http://localhost/Fadming/Web/php/actualizar_datos_usuario.php',
		    success: cambiar_boton_actualizar(),
		    data: "nombre="+nombre+"&apellidos="+apellidos+"&usuario="+usuario+"&correo="+correo,
		    dataType: 'json'
		});
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
		$(".contenedor-mensaje-advertencia").css('height', '65%');
		$(".contenedor-boton-borrar-cuenta").fadeIn();
		document.getElementById("boton-advertencia").id = "titulo-advertencia";
  		$("#titulo-advertencia").css('background-color', '#2A2B2A');
		$("#titulo-advertencia").css('color', '#FFFFFF');
		$("#titulo-advertencia").css('cursor', 'default');
	});
}
