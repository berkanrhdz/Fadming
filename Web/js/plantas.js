// DOCUMENTO JAVASCRIPT DE plantas.php

$(document).ready(function() {
	obtener_fincas_usuario();
	cambiar_color_botones();
	validar_selector_finca();
});

function cambiar_color_botones() {
	$("#flecha-izquierda").hover(
			function() {
				$(this).css('background-image', 'url("images/iconos/negro/flecha-izquierda.png")');
				$(this).css('cursor', 'pointer');
			}, function() {
				$(this).css('background-image', 'url("images/iconos/blanco/flecha-izquierda.png")');
			}
	);
	$("#flecha-derecha").hover(
			function() {
				$(this).css('background-image', 'url("images/iconos/negro/flecha-derecha.png")');
				$(this).css('cursor', 'pointer');
			}, function() {
				$(this).css('background-image', 'url("images/iconos/blanco/flecha-derecha.png")');
			}
	);
	$(".contenedor-huerto").hover(
			function() {
				$(this).css('background-color', '#F7DB5C');
				$(this).css('color', '#2A2B2A');
				$(this).css('cursor', 'pointer');
			}, function() {
				$(this).css('background-color', '#2A2B2A');
				$(this).css('color', '#FFFFFF');
			}
	);
}

function obtener_fincas_usuario() {
	$.ajax({
        type: 'POST',
        url: 'http://localhost/GricApp/Web/php/obtener_fincas_usuario.php',
				dataType: 'json',
				success: function(datos) {
						$(datos).each(function(i, valor) {
							insertar_finca_formato(valor.codigo, valor.nombre);
						});
        }
    });
}

function insertar_finca_formato(codigo, nombre) { // Funcion para dar el formato a la información.
		var formato_finca = "<option value='" + codigo + "'>" + nombre + "</option>";
		document.getElementById('selector-finca').innerHTML += formato_finca;
}

function validar_selector_finca() {
	document.getElementById('selector-finca').onchange = function() {
		alert("si");
	};
}
