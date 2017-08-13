// DOCUMENTO JAVASCRIPT DE index.php

$(document).ready(function() {
	acciones_slide();
	cambiar_color_registro();
	mostrar_ocultar_registro();
});

function acciones_slide() { // Método para realizar las acciones del slide de imágenes.
	var contadorSlide = 1;
	var nombreImagen;
	$("#flecha-izquierda").hover(
		function() {
			$(this).css('background-image', 'url("images/iconos/naranja/flecha-izquierda.png")');
			$(this).css('cursor', 'pointer');
	  	}, function() {
			$(this).css('background-image', 'url("images/iconos/negro/flecha-izquierda.png")');
	  	}
	);
	$("#flecha-derecha").hover(
		function() {
			$(this).css('background-image', 'url("images/iconos/naranja/flecha-derecha.png")');
			$(this).css('cursor', 'pointer');
	  	}, function() {
			$(this).css('background-image', 'url("images/iconos/negro/flecha-derecha.png")');
	  	}
	);
	$("#flecha-izquierda").click(function() {
		contadorSlide--;
		if (contadorSlide < 1) {
			contadorSlide = 4;
		}
		nombreImagen = 'url("images/slide/' + contadorSlide + '.png")';
		$(".contenedor-informacion").css('background-image', nombreImagen);
	});
	$("#flecha-derecha").click(function() {
		contadorSlide++;
		if (contadorSlide > 4) {
			contadorSlide = 1;
		}
		nombreImagen = 'url("images/slide/' + contadorSlide + '.png")';
		$(".contenedor-informacion").css('background-image', nombreImagen);
	});
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
