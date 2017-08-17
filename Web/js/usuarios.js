// DOCUMENTO JAVASCRIPT DE usuarios.php

$(document).ready(function() {
	obtener_usuarios_empresa();
});

function obtener_usuarios_empresa() {
	$.ajax({
        type: 'POST',
        url: 'http://localhost/Fadming/Web/php/obtener_usuarios_empresa.php',
				dataType: 'JSON',
				success: function(datos) {
					insertar_usuarios(datos[0], datos[1]);
        }
    });
}

function insertar_usuarios(roles, usuarios) {
	$(usuarios).each(function(i, valor) {
		alert(valor.nombre);
	});
	//var nombre_completo = nombre + " " + apellidos;
	/*var formato_usuario = "<div class='contenedor-usuario-lista' id='" + codigo + "'>" +
	                       		"<div id='foto-usuario'><img src='data:image/png;base64," + imagen + "'></div>" +
	                          "<div id='nombre-completo-usuario'>" + nombre_completo + "</div>" +
	                          "<div id='rol-usuario-empresa'>" +
	                           		"<select class='selector-rol' id='selector-rol-'" + i + "' required></select>" +
	                          "</div>" +
	                      "</div>";
	document.getElementById('lista-usuarios').innerHTML += formato_usuario;*/
}

function insertar_select_formato(codigo, nombre) {
	var formato_option = "<option value='" + codigo + "'>" + nombre.toUpperCase() + "</option>";
	document.getElementById('selector-rol-1').innerHTML += formato_option;
	document.getElementById('selector-rol-2').innerHTML += formato_option;
}
