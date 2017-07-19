<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>GricApp</title>
        <link href="images/favicon.png" rel='shortcut icon' type='image/png'/>
        <link rel="stylesheet" type="text/css" href="css/general.css">
        <script src="js/jquery-3.2.1.min.js"></script>
        <script src="js/general.js"></script>
        <script src="js/plantas.js"></script>
    </head>
    <body>
    	<div class="barra-superior">
    		<div class="contenedor-logo"></div>
    		<div class="contenedor-informacion-usuario">
    			<div id="nombre-usuario"><?php echo $_SESSION['usuario'] ?></div>
          <div id="icono-ajustes"><a href="ajustes.php"></a></div>
    			<div id="icono-cerrar-sesion"><a href="php/cerrar_sesion.php"></a></div>
    		</div>
    	</div>
    	<div class="contenedor-principal">
    		<div class="barra-lateral-izquierda">
    			<div class="fila-acceso" id="empresa">
            <a href="empresas.php"><div id="icono-empresa"></div><div class="nombre-acceso" id="texto-empresa">Empresas</div></a>
    			</div>
    			<div class="fila-acceso" id="usuario">
    				<div id="icono-usuario"></div><div class="nombre-acceso" id="texto-usuario">Usuarios</div>
    			</div>
    			<div class="fila-acceso" id="estado">
            <a href="estados.php"><div id="icono-estado"></div><div class="nombre-acceso" id="texto-estado">Estados</div></a>
    			</div>
    			<div class="fila-acceso" id="finca">
    				<div id="icono-finca"></div><div class="nombre-acceso" id="texto-finca">Fincas</div>
    			</div>
    			<div class="fila-acceso" id="huerto">
    				<div id="icono-huerto"></div><div class="nombre-acceso" id="texto-huerto">Huertos</div>
    			</div>
    			<div class="fila-acceso" id="planta">
    				<a href="plantas.php"><div id="icono-planta"></div><div class="nombre-acceso" id="texto-planta">Plantas</div></a>
    			</div>
    		</div>
    		<div class="contenedor-informacion">
                <div class="contenedor-titulo-pagina">
                    <div id="titulo-pagina">Control de plantas y códigos QR</div>
                </div>
                <div class="contenedor-contenido">
                    <div class="contenedor-informacion-pagina">
                        <div class="contenedor-gestion-plantas">
                            <div class="gestion-plantas">
                              <div class="contenedor-titulo-plantas">Selección de plantas</div>
                              <div class="contenedor-finca-huertos-plantas" id="contenedor-finca-huertos-plantas">
                                <div class="contenedor-seleccion-finca">
                                  <select id="selector-finca" required>
                                    <option value="" disabled selected hidden>Seleccione una finca...</option>
                                  </select>
                                </div>
                                <div class="contenedor-seleccion-huerto">
                                  <select id="selector-huerto" onchange="validar_selector_huertos()" required></select>
                                </div>
                                <div class="contenedor-mensaje-cargando"><div id="texto-cargando">Cargando...</div></div>
                                <div class="contenedor-seleccion-plantas" id="seleccion-plantas"></div>
                              </div>
                            </div>
                        </div>
                        <div class="contenedor-estados-codigos">
                          <div class="contenedor-anadir-estados-planta">
                            <div class="titulo-anadir-estados-planta">En primer lugar, añada los estados a sus plantas</div>
                            <div id="nombre-planta-seleccionada"></div>
                            <div class="estados-planta-seleccionada" id="estados-planta-seleccionada"></div>
                          </div>
                          <div class="contenedor-generar-codigo-qr"></div>
                        </div>
                    </div>
                </div>
            </div>
    	</div>
    </body>
</html>
