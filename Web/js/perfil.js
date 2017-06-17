// DOCUMENTO JAVASCRIPT DE perfil.php

$(document).ready(function() {

	cambiar_colores_iconos();
});

function cambiar_colores_iconos() { // Función para cambiar los colores de los iconos al pasar por encima.

	$("#icono-ajustes").hover(
  		function() {
    		$(this).css('background-image', 'url("images/iconos/blanco/ajustes.png")');
    		$(this).css('cursor', 'pointer');
  		}, function() {
    		$(this).css('background-image', 'url("images/iconos/negro/ajustes.png")');
  		}
	);

	$("#icono-cerrar-sesion").hover(
  		function() {
    		$(this).css('background-image', 'url("images/iconos/blanco/cerrar-sesion.png")');
    		$(this).css('cursor', 'pointer');
  		}, function() {
    		$(this).css('background-image', 'url("images/iconos/negro/cerrar-sesion.png")');
  		}
	);
}
