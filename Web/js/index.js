// DOCUMENTO JAVASCRIPT DE index.php

$(document).ready(function() {
	acciones_slide();
	cambiar_color_registro();
	mostrar_ocultar_registro();
	comprobacion_datos();
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
		$("#formulario-registro").fadeIn(500);
	});
	$(".ocultar-registro").click(function() {
		$("#formulario-registro").fadeOut();
		$(".desplegar-registrar").slideDown(500);
	});
}

function comprobacion_datos() { // Función para la validación del formulario de registro.
	$("#correo").change(function() {
		if ((/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(document.getElementById("correo").value))) {
			$('#correo').css('background-color', '#9DE2AC');

    	}
    	else {
    		$("#correo").css('background-color', '#F1B5B4');
    		document.getElementById("correo").innerHTML = "Formato incorrecto";
	    	setTimeout(function(){ 
				$("#correo").text("");
			}, 1500);
	    }
	});
	/*else if (!(/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(document.getElementById("input_email").value))) {
		alert("Debe rellenar con formato el campo EMAIL");
		return false;
	}
	/*if(document.getElementById("name").value.length == 0) {
		alert("Debe rellenar el campo NOMBRE");
		return false;
	}
	else if(document.getElementById("input_surname").value.length == 0) {
		alert("Debe rellenar el campo APELLIDOS");
		return false;
	}
	else if(!document.getElementById("radio_male").checked && !document.getElementById("radio_female").checked) {
		alert("Debe marcar alguna de las opciones del campo SEXO");
		return false;
	}
	else if (!(/^\d{2}\/\d{2}\/\d{4}$/.test(document.getElementById("input_date").value))) {
		alert("Debe rellenar con formato el campo FECHA DE NACIMIENTO");
		return false;
	}
	else if (!(/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(document.getElementById("input_email").value))) {
		alert("Debe rellenar con formato el campo EMAIL");
		return false;
	}*/
	return true;
}
