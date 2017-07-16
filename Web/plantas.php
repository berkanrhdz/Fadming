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
    			<div id="icono-ajustes"></div>
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
                              <div class="contenedor-titulo-plantas">Plantas en cada huerto</div>
                              <div class="contenedor-huertos-plantas">
                                <div class="contenedor-cambiar-finca">
                                  <div id="flecha-izquierda"></div>
                                  <div id="nombre-finca-cambiar">Los Pelados</div>
                                  <div id="flecha-derecha"></div>
                                </div>
                                <div class="contenedor-huerto" id="huerto-identificador-1">Huerto 1</div>
                                <div class="contenedor-plantas" id="plantas-1">
                                  <div class="planta" id="planta-identificador-1">
                                    <div class="nombre-planta-identificador">Planta 1</div>
                                    <div class="icono-codigo-qr"></div>
                                  </div>
                                  <div class="planta" id="planta-identificador-2">
                                    <div class="nombre-planta-identificador">Planta 2</div>
                                    <div class="icono-codigo-qr"></div>
                                  </div>
                                  <div class="planta" id="planta-identificador-3">
                                    <div class="nombre-planta-identificador">Planta 3</div>
                                    <div class="icono-codigo-qr"></div>
                                  </div>
                                  <div class="planta" id="planta-identificador-4">
                                    <div class="nombre-planta-identificador">Planta 4</div>
                                    <div class="icono-codigo-qr"></div>
                                  </div>
                                  <div class="planta" id="planta-identificador-5">
                                    <div class="nombre-planta-identificador">Planta 5</div>
                                    <div class="icono-codigo-qr"></div>
                                  </div>
                                  <div class="planta" id="planta-identificador-6">
                                    <div class="nombre-planta-identificador">Planta 6</div>
                                    <div class="icono-codigo-qr"></div>
                                  </div>
                                </div>
                              </div>
                            </div>
                        </div>
                        <div class="contenedor-anadir-codigos">
                          <div class="contenedor-anadir-nueva-planta"></div>
                          <div class="contenedor-generar-codigo-qr"></div>
                        </div>
                    </div>
                </div>
            </div>
    	</div>
    </body>
</html>
