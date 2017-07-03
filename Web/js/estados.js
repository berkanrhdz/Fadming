// DOCUMENTO JAVASCRIPT DE estados.php

$(document).ready(function() {

});

function mostrar_lista_estados() {
	$.ajax({
        type: 'POST',
        url: 'http://localhost/GricApp/Web/php/mostrar_datos_usuario.php',
        success: function(datos) {
					var JSON_datos = JSON.parse(datos);
    				document.getElementById("nombre").value = JSON_datos[0].nombre;
    				document.getElementById("apellidos").value = JSON_datos[0].apellidos;
    				document.getElementById("correo").value = JSON_datos[0].correo;
    				document.getElementById("username").value = JSON_datos[0].usuario;
    				document.getElementById("fecha-registro").innerHTML = JSON_datos[0].fecha_registro;
    				document.getElementById("rol-usuario").innerHTML = JSON_datos[0].rol;
        }
    });
}
