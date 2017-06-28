// DOCUMENTO JAVASCRIPT GENERAL.

$(document).ready(function() {
	cambiar_colores_iconos();
	cambiar_colores_accesos();
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