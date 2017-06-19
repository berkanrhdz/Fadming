// DOCUMENTO JAVASCRIPT DE perfil.php

$(document).ready(function() {
	comprobacion_datos();
});

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