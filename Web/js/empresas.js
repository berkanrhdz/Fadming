// DOCUMENTO JAVASCRIPT DE empresas.php

$(document).ready(function() {
	obtener_informacion_empresa();
	cambiar_contrasena_acceso();
});

function obtener_informacion_empresa() {
	$.ajax({
				type: 'POST',
				url: 'http://localhost/Fadming/Web/php/obtener_datos_empresa.php',
				dataType: 'json',
				success: function(datos) {
						$(datos).each(function(i, valor) {
								insertar_informacion(valor.nombre, valor.direccion, valor.poblacion, valor.cp, valor.telefono, valor.imagen);
						});
				}
		});
}

function insertar_informacion(nombre, direccion, poblacion, cp, telefono, imagen) {
	var formato_imagen = "<img src='data:image/png;base64," + imagen + "'>";
	var formato_direccion = direccion + ", " + poblacion + " " + cp;
	document.getElementById('nombre-empresa').innerHTML = nombre;
	document.getElementById('direccion').innerHTML = formato_direccion;
	document.getElementById('telefono').innerHTML = telefono;
	document.getElementById('logo-empresa').innerHTML = formato_imagen;
}

function comprobar_cambio_contrasena() {
	var contrasena = document.getElementById("nueva-contrasena").value;
	var repetir_contrasena = document.getElementById("repetir-nueva-contrasena").value;
	if (document.getElementById("nueva-contrasena").value.length == 0) { // Comprobación de introducción de la contraseña.
		$('#nueva-contrasena').css('background-color', '#FADBD8');
		document.getElementById("nueva-contrasena").placeholder = "Obligatorio";
		setTimeout(function() {
			document.getElementById("nueva-contrasena").placeholder = "Nueva contraseña";
			$("#nueva-contrasena").css('background-color', '#FFFFFF');
		}, 1500);
		return false;
	}
	else if (document.getElementById("repetir-nueva-contrasena").value.length == 0) { // Comprobación de introducción de la repetición de la contraseña.
		$('#repetir-nueva-contrasena').css('background-color', '#FADBD8');
		document.getElementById("repetir-nueva-contrasena").placeholder = "Obligatorio";
		setTimeout(function() {
			document.getElementById("repetir-nueva-contrasena").placeholder = "Repetir contraseña";
			$("#repetir-nueva-contrasena").css('background-color', '#FFFFFF');
		}, 1500);
		return false;
	}
	else if (contrasena != repetir_contrasena) {
		document.getElementById("repetir-nueva-contrasena").value = "";
		$('#repetir-nueva-contrasena').css('background-color', '#FADBD8');
		document.getElementById("repetir-nueva-contrasena").placeholder = "No coinciden";
		setTimeout(function() {
			$('#repetir-nueva-contrasena').css('background-color', '#FFFFFF');
			document.getElementById("repetir-nueva-contrasena").placeholder = "Repetir contraseña";
		}, 1500);
		return false;
	}
	return true;
}

function vaciar_formulario_contrasena() {
	document.getElementById('nueva-contrasena').value = "";
	document.getElementById('repetir-nueva-contrasena').value = "";
}

function cambiar_contrasena_acceso() {
	$('#boton-cambiar-contrasena').click(function() {
		$('#boton-cambiar-contrasena').fadeOut(function() {
			$('.contenedor-input-nueva').fadeIn();
		});
	});
	$('#boton-atras').click(function() {
		$('.contenedor-input-nueva').fadeOut(function() {
			vaciar_formulario_contrasena();
			$('#boton-cambiar-contrasena').fadeIn();
		});
	});
	$('#boton-nueva-contrasena').click(function() {
		if (comprobar_cambio_contrasena()) {
			document.getElementById("boton-nueva-contrasena").value = "Actualizando...";
			enviar_nueva_contrasena();
			setTimeout(function() {
				document.getElementById("boton-nueva-contrasena").value = "Actualizado";
			}, 1500);
			setTimeout(function() {
				vaciar_formulario_contrasena();
				document.getElementById("boton-nueva-contrasena").value = "Actualizar";
				$('.contenedor-input-nueva').fadeOut(function() {
					$('#boton-cambiar-contrasena').fadeIn();
				});
			}, 2500);
		}
	});
}


function enviar_nueva_contrasena() {
	var contrasena = document.getElementById('nueva-contrasena').value;
	$.ajax({
				type: 'POST',
				url: 'http://localhost/Fadming/Web/php/cambiar_contrasena_empresa.php',
				data: 'contrasena='+contrasena,
				dataType: 'json',
		});
}
