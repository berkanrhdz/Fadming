<?php
	session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>GricApp</title>
        <link href="images/favicon.png" rel='shortcut icon' type='image/png'/>
        <link rel="stylesheet" type="text/css" href="css/general.css">
        <script src="js/jquery-3.2.1.min.js"></script>
        <script src="js/perfil.js"></script>
    </head>

    <body>
    	<div class="barra-superior">
    		<div class="contenedor-logo"></div>
    		<div class="contenedor-informacion-usuario">
    			<div id="nombre-usuario"><?php echo $_SESSION['nombre'] . ' ' . $_SESSION['apellido1'] ?></div>
    			<div id="icono-ajustes"></div>
    			<div id="icono-cerrar-sesion"><a href="actions/cerrar_sesion.php"></a></div>
    		</div>
    	</div>
    	<div class="contenedor-principal">
    		<div class="barra-lateral-izquierda">
    			<div class="fila-acceso" id="fila-acceso-empresa">
    				<div id="icono-empresa"></div><div class="nombre-acceso">Empresas</div>
    			</div>
    			<div class="fila-acceso" id="fila-acceso-usuario">
    				<div id="icono-usuario"></div><div class="nombre-acceso">Usuarios</div>
    			</div>
    			<div class="fila-acceso" id="fila-acceso-estado">
    				<div id="icono-estado"></div><div class="nombre-acceso">Estados</div>
    			</div>
    			<div class="fila-acceso" id="fila-acceso-finca">
    				<div id="icono-finca"></div><div class="nombre-acceso">Fincas</div>
    			</div>
    			<div class="fila-acceso" id="fila-acceso-huerto">
    				<div id="icono-huerto"></div><div class="nombre-acceso">Huertos</div>
    			</div>
    			<div class="fila-acceso" id="fila-acceso-planta">
    				<div id="icono-planta"></div><div class="nombre-acceso">Plantas</div>
    			</div>
    		</div>
    		<div class="contenedor-informacion"></div>
    	</div>
    </body>
</html>