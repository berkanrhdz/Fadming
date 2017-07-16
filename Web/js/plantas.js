// DOCUMENTO JAVASCRIPT DE plantas.php

$(document).ready(function() {
	cambiar_color_botones();
	obtener_fincas_usuario();
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
								insertar_estado_formato(valor.codigo, valor.nombre, valor.descripcion);
						});
        }
    });
}

function insertar_estado_formato(indice, nombre, descripcion) { // Funcion para dar el formato a los estados.
		var formato_lista = "<div class='estado'>" +
	               		    	"<div class='contenedor-nombre-estado'><div id='nombre-estado'>" + nombre + "</div></div>" +
	                  			"<div class='contenedor-descripcion-estado'><div id='descripcion-estado'>" + descripcion + "</div></div>" +
	               				"</div>";
		var formato_grupo	= "<div class='contenedor-estado-seleccion'>" +
													"<div id='nombre-estado-seleccion'>" + nombre + "</div>" +
													"<div id='checkbox'><input id='" + indice + "' type='checkbox'></input></div>" +
												"</div>";
		document.getElementById('lista').innerHTML += formato_lista;
		document.getElementById('grupos-seleccion').innerHTML += formato_grupo;
}
