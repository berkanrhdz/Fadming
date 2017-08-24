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
        <script src="js/huertos.js"></script>
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
                    <div id="titulo-pagina">Huertos</div>
                </div>
                <div class="contenedor-contenido">
                    <div class="contenedor-informacion-pagina">
                      <div class="contenedor-huertos-usuarios">
                        <div class="contenedor-usuarios">
                          <div class="gestion-usuarios-huerto">
                            <div id="titulo-usuarios-huerto">PERMISOS DE USUARIOS</div>
                            <div id="lista-usuarios-huerto">
                              <div id="nombre-huerto-permisos"></div>
                              <div class="contenedor-usuarios-permisos">
                                <div id="mensaje-ayuda-permisos"><b>Pulse sobre el nombre de un huerto.</b></br>
                                                                    Luego, elija entre los usuarios de la empresa, aquellos con <b>permiso para escanear los códigos QR</b> del huerto seleccionado</div>
                                <div id="usuarios-permisos"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="contenedor-huertos">
                          <div class="gestion-huertos">
                            <div class="titulo-finca" id="titulo-finca">
                              <div id="flecha-izquierda"></div>
                              <div id="flecha-derecha"></div>
                            </div>
                            <div id="lista-huertos"></div>
                            <div class="contenedor-anadir-huerto">
                              <div id="titulo-anadir-huerto"></div>
                              <div class="contenido-anadir-huerto">
                                <div class="fila-input">
                                  <input id="nombre_huerto" name="nombre_huerto" type="text" autocomplete="off" placeholder="Nombre del nuevo huerto"></input>
                                  <input id="boton_anadir_huerto" name="boton_anadir_huerto" type="submit" value="Añadir huerto" onclick="anadir_nuevo_huerto()"></input>
                                </div>
                              </div>
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
