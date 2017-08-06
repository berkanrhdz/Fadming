<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Fadming</title>
        <link href="images/favicon.png" rel='shortcut icon' type='image/png'/>
        <link rel="stylesheet" type="text/css" href="css/general.css">
        <script src="js/jquery-3.2.1.min.js"></script>
        <script src="js/general.js"></script>
        <script src="js/empresas.js"></script>
    </head>

    <body>
    	<div class="barra-superior">
    		<div class="contenedor-logo"></div>
    		<div class="contenedor-informacion-usuario">
    			<div id="nombre-usuario"><?php echo $_SESSION['usuario']?></div>
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
                    <div id="titulo-pagina">Empresas</div>
                </div>
                <div class="contenedor-contenido">
                    <div class="contenedor-informacion-pagina">
                        <div class="contenedor-empresas-boton">
                            <div class="contenedor-boton">
                                <div id="boton-nueva-empresa">Añadir una nueva empresa</div>
                            </div>
                            <div class="contenedor-empresas-estadisticas">
                                <div class="contenedor-empresas">
                                    <div class="empresa" id="empresa-1">
                                        <div id="imagen-empresa"></div>
                                        <div class="informacion-empresa">
                                            <div id="nombre-empresa">Cultivos La Candelaria</div>
                                            <div id="lugar-empresa">Santa Cruz de Tenerife 38009</div>
                                            <div id="calle-empresa">Robayna Almentara 97</div>
                                            <div class="contenedor-telefono">
                                                <div id="icono-telefono"></div><div id="telefono-empresa">902519811</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="empresa" id="empresa-2">
                                        <div id="imagen-empresa"></div>
                                        <div class="informacion-empresa">
                                            <div id="nombre-empresa">Agrupación de Agricultores Ecológicos de Canarias</div>
                                            <div id="lugar-empresa">Arafo 38550</div>
                                            <div id="calle-empresa">Pérez Carmona 18</div>
                                            <div class="contenedor-telefono">
                                                <div id="icono-telefono"></div><div id="telefono-empresa">922514811</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="contenedor-paginas-empresa"></div>
                                </div>
                                <div class="contenedor-estadisticas"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    	</div>
    </body>
</html>
