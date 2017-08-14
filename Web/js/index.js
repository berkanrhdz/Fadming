// DOCUMENTO JAVASCRIPT DE index.php

// DECLARACIÓN DE CONSTANTES.
const MAX_SLIDE = 3;

// DECLARACIÓN DE VARIABLES GLOBALES.
var contadorSlide = 1;

$(document).ready(function() {
	acciones_slide();
	cambiar_color_registro();
	mostrar_ocultar_registro();
	transiciones_slide(contadorSlide);
});

function acciones_slide() { // Método para realizar las acciones del slide de imágenes.
	var nombreImagen;
	$("#flecha-izquierda").hover(
		function() {
			$(this).css('opacity', '1.0');
			$(this).css('cursor', 'pointer');
	  	}, function() {
				$(this).css('opacity', '0.6');
	  	}
	);
	$("#flecha-derecha").hover(
		function() {
			$(this).css('opacity', '1.0');
			$(this).css('cursor', 'pointer');
	  	}, function() {
				$(this).css('opacity', '0.6');
	  	}
	);
	$("#flecha-izquierda").click(function() {
		contadorSlide--;
		if (contadorSlide < 1) {
			contadorSlide = MAX_SLIDE;
		}
		nombreImagen = 'url("images/slide/' + contadorSlide + '.png")';
		$(".contenedor-informacion").css('background-image', nombreImagen);
	});
	$("#flecha-derecha").click(function() {
		contadorSlide++;
		if (contadorSlide > MAX_SLIDE) {
			contadorSlide = 1;
		}
		nombreImagen = 'url("images/slide/' + contadorSlide + '.png")';
		$(".contenedor-informacion").css('background-image', nombreImagen);
	});
}

function transiciones_slide(imagen) {
	nombreImagen = 'url("images/slide/' + imagen + '.png")';
	$(".contenedor-informacion").css('background-image', nombreImagen);
	contadorSlide++;
	if (contadorSlide > MAX_SLIDE) {
		contadorSlide = 1;
	}
	setTimeout(function() {
		transiciones_slide(contadorSlide);
	}, 8000);
}

function cambiar_color_registro() { // Función para cambiar el color del div de acceso al registro.
	$(".desplegar-registrar").hover(
		function() {
			$(this).css('background', '#F7DB5C');
			$(this).css('cursor', 'pointer');
			$(this).css('color', '#000000');
	  	}, function() {
			$(this).css('background-color', 'transparent');
			$(this).css('color', '#FFFFFF');
	  	}
	);
	$(".ocultar-registro").hover(
		function() {
			$(this).css('cursor', 'pointer');
			$(this).css('background-image', 'url("images/iconos/naranja/flecha-abajo.png")');
	  	}, function() {
			$(this).css('background-image', 'url("images/iconos/blanco/flecha-abajo.png")');
	  	}
	);
}

function mostrar_ocultar_registro() {
	$(".desplegar-registrar").click(function() {
		$(this).slideUp();
		$(".contenedor-codigo-qr").slideUp(500);
		setTimeout(function(){
			$(".formulario-registro").fadeIn(500);
		}, 200);
	});
	$(".ocultar-registro").click(function() {
		$(".formulario-registro").fadeOut();
		setTimeout(function(){
			$(".contenedor-codigo-qr").slideDown(500);
		}, 200);
		$(".desplegar-registrar").slideDown(500);
	});
}
