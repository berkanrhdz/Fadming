// DOCUMENTO JAVASCRIPT DE estados.php

$(document).ready(function() {
	mostrar_lista_estados();
	interaccion_nuevo_grupos();
	insertar_nuevo_estado();
});

function mostrar_lista_estados() {
	$.ajax({
        type: 'POST',
        url: 'http://localhost/GricApp/Web/php/mostrar_lista_estados.php',
				dataType: 'json',
				success: function(datos) {
						$(datos).each(function(i, valor) {
								insertar_estado_formato(i + 1, valor.nombre, valor.descripcion);
						});
        }
    });
}

function insertar_estado_formato(indice, nombre, descripcion) { // Funcion para dar el formato a los estados.
		var formato = "<div class='estado' id='estado-" + indice + "'>" +
	               		"<div class='contenedor-nombre-estado'><div id='nombre-estado'>" + nombre + "</div></div>" +
	                  "<div class='contenedor-descripcion-estado'><div id='descripcion-estado'>" + descripcion + "</div></div>" +
	               "</div>";
		document.getElementById('lista').innerHTML += formato;
}

function interaccion_nuevo_grupos() {
		$("#boton-titulo-nuevo").click(function() {
				$(".contenedor-informacion-nuevo").slideDown(100);
				$(".contenedor-informacion-nuevo").animate({'height': '75.7%'}, "slow");
				$(".contenedor-informacion-grupos").animate({'height': '0%'}, "slow");
				setTimeout(function(){
					 $(".contenedor-informacion-grupos").css("display", "none");
				}, 500);
		});
		$("#boton-titulo-grupos").click(function() {
				$(".contenedor-informacion-nuevo").animate({'height': '0%'}, "slow");
				setTimeout(function(){
					 $(".contenedor-informacion-nuevo").css("display", "none");
					 $(".contenedor-informacion-nuevo").css("height", "0%");
				}, 500);
				$(".contenedor-informacion-grupos").fadeIn();
				$(".contenedor-informacion-grupos").animate({"height": "75.7%"}, "slow");
		});
}

function insertar_nuevo_estado() {
		$("#boton-nuevo-estado").click(function() {
				document.getElementById("boton-nuevo-estado").value = "Añadiendo...";
				var nombre       = $("#nombre_estado").val();
				var descripcion  = $("#descripcion_estado").val();
				$.ajax({
		    		type: 'POST',
		    		url: 'http://localhost/GricApp/Web/php/almacenar_estado.php',
		    		success: cambiar_nuevo_estado(),
		    		data: "nombre="+nombre+"&descripcion="+descripcion,
		    		dataType: 'json'
				});
		});
}

function cambiar_nuevo_estado() {
		setTimeout(function(){
				document.getElementById("boton-nuevo-estado").value = "Añadido";
				location.reload();
		}, 2000);
		setTimeout(function(){
				document.getElementById("boton-nuevo-estado").value = "Añadir estado";
				document.getElementById("nombre_estado").value = "";
				document.getElementById("descripcion_estado").value = "";
		}, 3000);
}
