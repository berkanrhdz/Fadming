// DOCUMENTO JAVASCRIPT DE index.php

$(document).ready(function() {
	acciones_slide();
	cambiar_color_registro();
	mostrar_ocultar_registro();
	registrar_usuario();
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
	$("#boton-registro").hover(
		function() {
			$(this).css('background-color', '#F7DB5C');
			$(this).css('cursor', 'pointer');
			$(this).css('color', '#000000');
	  	}, function() {
			$(this).css('background-color', 'transparent');
			$(this).css('color', '#FFFFFF');
	  	}
	);
}

function mostrar_ocultar_registro() {
	$(".desplegar-registrar").click(function() {
		$(this).slideUp();
		$(".formulario-registro").fadeIn(500);
	});
	$(".ocultar-registro").click(function() {
		$(".formulario-registro").fadeOut();
		$(".desplegar-registrar").slideDown(500);
	});
}

function comprobar_datos() { // Función para la validación del formulario de registro.
	var contrasena = document.getElementById("contrasena").value;
	var repetir_contrasena = document.getElementById("repetir-contrasena").value;
	if (document.getElementById("nombre").value.length == 0) { // Comprobación de introducción del nombre.
		$('#nombre').css('background-color', '#F3DEDE');
		document.getElementById("nombre").placeholder = "Obligatorio";
	    setTimeout(function() { 
	    	document.getElementById("nombre").placeholder = "Nombre";
			$('#nombre').css('background-color', '#FFFFFF');
		}, 1500);
		return false;
	}
	else if (document.getElementById("apellidos").value.length == 0) { // Comprobación de introducción de los apellidos.
		$('#apellidos').css('background-color', '#F3DEDE');
		document.getElementById("apellidos").placeholder = "Obligatorio";
		setTimeout(function() { 
		    document.getElementById("apellidos").placeholder = "Apellidos";
			$("#apellidos").css('background-color', '#FFFFFF');
		}, 1500);
		return false;
	}
	else if (document.getElementById("usuario").value.length == 0) { // Comprobación de introducción del nombre de usuario.
		$('#usuario').css('background-color', '#F3DEDE');
		document.getElementById("usuario").placeholder = "Obligatorio";
		setTimeout(function() { 
			document.getElementById("usuario").placeholder = "Nombre de usuario";
			$("#usuario").css('background-color', '#FFFFFF');
		}, 1500);
		return false;
	}
	else if (document.getElementById("correo").value.length == 0) { // Comprobación de introducción del correo electrónico.
		$('#correo').css('background-color', '#F3DEDE');
		document.getElementById("correo").placeholder = "Obligatorio";
		setTimeout(function() { 
			document.getElementById("correo").placeholder = "Correo electrónico";
			$("#correo").css('background-color', '#FFFFFF');
		}, 1500);
		return false;
	}
	else if (!(/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(document.getElementById("correo").value))) {
		document.getElementById("correo").value = "";
		$('#correo').css('background-color', '#F3DEDE');
		document.getElementById("correo").placeholder = "Formato incorrecto";
		setTimeout(function() { 
			document.getElementById("correo").placeholder = "Correo electrónico";
			$('#correo').css('background-color', '#FFFFFF');
		}, 1500);
		return fa
	}
	else if (document.getElementById("contrasena").value.length == 0) { // Comprobación de introducción de la contraseña.
		$('#contrasena').css('background-color', '#F3DEDE');
		document.getElementById("contrasena").placeholder = "Obligatorio";
		setTimeout(function() { 
			document.getElementById("contrasena").placeholder = "Contraseña";
			$("#contrasena").css('background-color', '#FFFFFF');
		}, 1500);
		return false;
	}
	else if (document.getElementById("repetir-contrasena").value.length == 0) { // Comprobación de introducción de la repetición de la contraseña.
		$('#repetir-contrasena').css('background-color', '#F3DEDE');
		document.getElementById("repetir-contrasena").placeholder = "Obligatorio";
		setTimeout(function() { 
			document.getElementById("repetir-contrasena").placeholder = "Repetir contraseña";
			$("#repetir-contrasena").css('background-color', '#FFFFFF');
		}, 1500);
		return false;
	}
	else if (contrasena != repetir_contrasena) {
		document.getElementById("repetir-contrasena").value = "";
		$('#repetir-contrasena').css('background-color', '#F3DEDE');
		document.getElementById("repetir-contrasena").placeholder = "No coinciden";
		setTimeout(function() { 
			$('#repetir-contrasena').css('background-color', '#FFFFFF');
			document.getElementById("repetir-contrasena").placeholder = "Repetir contraseña";
		}, 1500);
		return false;
	}
	return true;
}

function registrar_usuario() {
	$("#boton-registro").click(function() {
		if (comprobar_datos()) {
			document.getElementById("boton-registro").value = "Registrando...";
			enviar_datos_registrar();
			setTimeout(function(){ 
				document.getElementById("boton-registro").value = "Registrado";
			}, 2000);
			setTimeout(function(){ 
				vaciar_formulario();
				document.getElementById("boton-registro").value = "Registrarme";
			}, 3000);
		}
	});
}

function vaciar_formulario() {
	document.getElementById("nombre").value = "";
	document.getElementById("apellidos").value = "";
	document.getElementById("usuario").value = "";
	document.getElementById("correo").value = "";
	document.getElementById("contrasena").value = "";
	document.getElementById("repetir-contrasena").value = "";
}

function enviar_datos_registrar() { // Función para enviar los datos del registro.
    var nombre       = $("#nombre").val(); 
    var apellidos    = $("#apellidos").val();
    var usuario      = $("#usuario").val();
    var correo       = $("#correo").val();
    var contrasena   = $("#contrasena").val();
    $.ajax({
        type: 'POST',
        url: 'http://localhost/GricApp/Web/php/registrar_usuario.php',
        data: "nombre="+nombre+"&apellidos="+apellidos+"&usuario="+usuario+"&correo="+correo+"&contrasena="+contrasena,
        dataType: 'json'
    });
}
