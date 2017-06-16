<?php
	session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link href="images/favicon.png" rel='shortcut icon' type='image/png'/>
        <link rel="stylesheet" type="text/css" href="css/general.css">
        <title>GricApp</title>
    </head>

    <body>
    	<div class="barra-superior">
    		<div class="contenedor-logo"></div>
    		<div class="contenedor-informacion-usuario">
    			<div id="nombre-usuario"><?php echo $_SESSION['nombre'] . ' ' . $_SESSION['apellido1'] ?></div>
    			<div id="icono-cerrar-sesion"></div>
    			<div id="icono-ajustes"></div>
    		</div>
    	</div>
    	<div class="contenedor-principal">
    		<div class="barra-lateral-izquierda"></div>
    		<div class="contenedor-informacion"></div>
    	</div>
    </body>
</html>