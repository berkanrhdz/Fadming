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
          <?php require("php/barra_lateral_izquierda.php"); ?>
    		</div>
    		<div class="contenedor-informacion">
                <div class="contenedor-titulo-pagina">
                    <div id="titulo-pagina">Empresa</div>
                </div>
                <div class="contenedor-contenido">
                    <div class="contenedor-informacion-pagina">
                        <div class="contenedor-empresas-nombre">
                            <div class="contenedor-nombre" id="nombre-empresa"></div>
                            <div class="contenedor-empresas-estadisticas">
                                <div class="contenedor-empresas">
                                  <div class="contenedor-logo-mapa">
                                    <div class="contenedor-logo">
                                      <div id="logo-empresa"></div>
                                    </div>
                                    <div class="contenedor-mapa"></div>
                                  </div>
                                  <div class="contenedor-informacion-empresa">
                                    <div class="contenedor-direccion">
                                      <div id="icono-direccion"></div>
                                      <div id="direccion">Calle Ecuador 11, Güímar 38500</div>
                                    </div>
                                    <div class="contenedor-telefono">
                                      <div id="icono-telefono"></div>
                                      <div id="telefono">922510012</div>
                                    </div>
                                    <div class="contenedor-cambiar-contrasena">
                                      <div id="boton-cambiar-contrasena">Cambiar contraseña acceso</div>
                                      <div class="contenedor-input-nueva">
                                        <div class="contenedor-input-cambio">
                                          <div class="contenedor-inputs">
                                            <input type="submit" id="boton-atras" value=" "></input>
                                            <input id="nueva-contrasena" name="nueva-contrasena" type="password" autocomplete="off" placeholder="Nueva contraseña"></input>
                                            <input id="repetir-nueva-contrasena" name="repetir-nueva-contrasena" type="password" autocomplete="off" placeholder="Repetir contraseña"></input>
                                            <input type="submit" id="boton-nueva-contrasena" value="Actualizar"></input>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
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
