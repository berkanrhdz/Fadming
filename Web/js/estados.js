// DOCUMENTO JAVASCRIPT DE estados.php

$(document).ready(function() {
	$("#estado #icono-seleccion").fadeIn("fast");
	mostrar_lista_estados();
	interaccion_nuevo_grupos();
	insertar_nuevo_estado();
});

function mostrar_lista_estados() {
	$.ajax({
        type: 'POST',
        url: 'http://localhost/Fadming/Web/php/obtener_lista_estados.php',
				dataType: 'json',
				success: function(datos) {
						$(datos).each(function(i, valor) {
								insertar_estado_formato(valor.codigo, valor.nombre, valor.descripcion);
						});
        }
    });
}

function insertar_estado_formato(indice, nombre, descripcion) { // Funcion para dar el formato a los estados.
		var formato_lista = "<div class='estado' id='estado-" + indice + "'>" +
	               		    	"<div class='contenedor-nombre-estado'><div id='nombre-estado'>" + nombre + "</div></div>" +
	                  			"<div class='contenedor-descripcion-estado'><div id='descripcion-estado'>" + descripcion + "</div></div>" +
													"<div id='eliminar-estado' onclick='borrar_estado(" + indice + ")'></div>" +
												"</div>";
		var formato_grupo	= "<div class='contenedor-estado-seleccion'>" +
													"<div id='nombre-estado-seleccion'>" + nombre + "</div>" +
													"<div id='checkbox'><input id='" + indice + "' type='checkbox'></input></div>" +
												"</div>";
		document.getElementById('lista').innerHTML += formato_lista;
		document.getElementById('grupos-seleccion').innerHTML += formato_grupo;
}

function borrar_estado(codigo) {
	$.ajax({
				type: 'POST',
				url: 'http://localhost/Fadming/Web/php/eliminar_estado.php',
				dataType: 'json',
				data: 'estado='+codigo,
				success: location.reload()
		});
}

function interaccion_nuevo_grupos() {
		$("#boton-titulo-nuevo").click(function() {
				$(".contenedor-informacion-grupos").fadeOut();
				setTimeout(function(){
					$(".contenedor-informacion-nuevo").slideDown(100);
					$(".contenedor-informacion-nuevo").animate({'height': '75.7%'}, "slow");
				}, 300);
				setTimeout(function(){
					 $(".contenedor-informacion-grupos").css("display", "none");
				}, 500);
				$("#boton-titulo-grupos").css("border-bottom-left-radius", "0.2em");
				$("#boton-titulo-grupos").css("border-bottom-right-radius", "0.2em");
		});
		$("#boton-titulo-grupos").click(function() {
				$(".contenedor-informacion-nuevo").animate({'height': '0%'}, "slow");
				setTimeout(function(){
					 $(".contenedor-informacion-nuevo").css("display", "none");
					 $(".contenedor-informacion-nuevo").css("height", "0%");
				}, 500);
				$(".contenedor-informacion-grupos").animate({"height": "75.7%"}, "slow");
				$(".contenedor-informacion-grupos").fadeIn("100");
				$(this).css("border-bottom-left-radius", "0em");
				$(this).css("border-bottom-right-radius", "0em");
		});
}

function insertar_nuevo_estado() {
		$("#boton-nuevo-estado").click(function() {
				document.getElementById("boton-nuevo-estado").value = "Añadiendo...";
				var nombre       = $("#nombre_estado").val();
				var descripcion  = $("#descripcion_estado").val();
				$.ajax({
		    		type: 'POST',
		    		url: 'http://localhost/Fadming/Web/php/almacenar_estado.php',
		    		success: cambiar_nuevo_estado(),
		    		data: "nombre="+nombre+"&descripcion="+descripcion,
		    		dataType: 'json'
				});
		});
}

function cambiar_nuevo_estado() {
		setTimeout(function(){
				document.getElementById("boton-nuevo-estado").value = "Añadido";
		}, 1500);
		setTimeout(function(){
				location.reload();
				document.getElementById("boton-nuevo-estado").value = "Añadir estado";
				document.getElementById("nombre_estado").value = "";
				document.getElementById("descripcion_estado").value = "";
		}, 2500);
}

function seleccion_grupo_estados() {
		var estados_seleccionados = "";
	  document.getElementById("boton_grupo").value = "Añadidendo...";
		contenedor = document.getElementById('grupos-seleccion');
		checkboxs = contenedor.getElementsByTagName('input');
		for (var i = 0; i < checkboxs.length; i++) {
    	if(checkboxs[i].checked == true) {
        estados_seleccionados += $(checkboxs[i]).attr('ID') + " ";
    	}
		}
		estados_seleccionados = estados_seleccionados.slice(0, estados_seleccionados.length - 1);
		enviar_estados_grupos(estados_seleccionados);
}

function enviar_estados_grupos(estados_seleccionados) {
	var nombre_grupo = $("#nombre_grupo").val();
	$.ajax({
			type: 'POST',
			url: 'http://localhost/Fadming/Web/php/almacenar_grupo_estados.php',
			success: cambiar_grupo_estados(),
			data: "nombre="+nombre_grupo+"&estados="+estados_seleccionados,
			dataType: 'json'
	});
}

function cambiar_grupo_estados() {
		setTimeout(function(){
				document.getElementById("boton_grupo").value = "Añadido";
		}, 1500);
		setTimeout(function(){
				document.getElementById("boton_grupo").value = "Añadir";
				document.getElementById("nombre_grupo").value = "";
				contenedor = document.getElementById('grupos-seleccion');
				checkboxs = contenedor.getElementsByTagName('input');
				for (var i = 0; i < checkboxs.length; i++) {
					if(checkboxs[i].checked == true) {
							checkboxs[i].checked = false;
					}
				}
		}, 2500);
}
