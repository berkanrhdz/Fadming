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
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAYwGv9189KZ_NuUnVwQvmmzQyu39Xwp70&callback=obtener_informacion_empresa"></script>
    </head>

    <body>
    	<div class="barra-superior">
    		<div class="contenedor-logo"></div>
    		<div class="contenedor-informacion-usuario">
    			<div id="nombre-usuario"><?php error_reporting(0); echo $_SESSION['usuario']?></div>
          <div class="contenedor-foto-superior"><div id="foto-perfil-superior"><img src='data:image/png;base64,<?php error_reporting(0); echo $_SESSION['imagen']?>'></div></div>
    			<div id="icono-ajustes"><a href="ajustes.php"></a></div>
    			<div id="icono-cerrar-sesion"><a href="php/cerrar_sesion.php"></a></div>
    		</div>
    	</div>
    	<div class="contenedor-principal">
    		<div class="barra-lateral-izquierda">
          <?php require("php/barra_lateral_izquierda.php"); ?>
    		</div>
    		<div class="contenedor-informacion">
                <div class="contenedor-titulo-pagina">
                    <div id="titulo-pagina">Empresa</div>
                </div>
                <div class="contenedor-contenido">
                    <div class="contenedor-informacion-pagina">
                        <div class="contenedor-empresa-nombre">
                            <div class="contenedor-nombre" id="nombre-empresa"></div>
                            <div class="contenedor-empresa-datos">
                                <div class="contenedor-empresa">
                                  <div class="contenedor-logo-telefono">
                                    <div class="contenedor-logo">
                                      <div id="logo-empresa"></div>
                                    </div>
                                    <div class="contenedor-datos-informacion">
                                      <div class="contenedor-datos-telefono">
                                        <div class="contenedor-telefono">
                                          <div id="icono-telefono"></div>
                                          <div id="telefono"></div>
                                        </div>
                                        <div class="contenedor-administrador">
                                          <div id="texto-administrador">ADMINISTRADOR</div>
                                          <div id="administrador"></div>
                                        </div>
                                        <div class="contenedor-boton-estadisticas">
                                          <div id="icono-estadisticas"></div>
                                          <div id="estadisticas">Consultar estadísticas</div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="contenedor-informacion-empresa">
                                    <div class="contenedor-direccion">
                                      <div id="icono-direccion"></div>
                                      <div id="direccion"></div>
                                    </div>
                                    <?php require('php/rol_empresa.php'); ?>
                                  </div>
                                </div>
                                <div class="contenedor-datos">
                                  <div class="contenedor-titulo-datos">Datos de la empresa</div>
                                  <div class="contenedor-contenido-datos">
                                    <div class="contenedor-registros" id="contenedor-registros"></div>
                                    <div class="contenedor-fecha" id="fecha-registro-empresa"></div>
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    	</div>
    </body>
</html>
