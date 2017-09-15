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
        <script src="js/usuarios.js"></script>
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
                    <div id="titulo-pagina">Usuarios</div>
                </div>
                <div class="contenedor-contenido">
                    <div class="contenedor-informacion-pagina">
                      <div class="contenedor-gestion-usuarios">
                        <div class="contenedor-lista-usuarios">
                          <div id="titulo-lista-usuarios">Usuarios en Cultivos Platanera</div>
                          <div class="contenedor-seleccion-tabs">
                            <div id="seleccion-tab-usuarios">Gestión de roles</div>
                            <div id="seleccion-tab-roles">Creación de roles</div>
                          </div>
                          <div id="lista-usuarios"></div>
                          <div class="contenedor-gestion-roles">
                            <div id="lista-roles"></div>
                            <div class="contenedor-anadir-nuevo-rol">
                              <div id="titulo-anadir-rol">Añadir un nuevo rol a la empresa</div>
                              <div class="contenedor-inputs-rol">
                                <div class="contenedor-inputs">
                                  <input id="nombre_rol" name="nombre_rol" type="text" autocomplete="off" placeholder="Nombre del nuevo rol"></input>
                                  <input id="boton_rol" name="boton_rol" type="submit" value="Añadir rol" onclick="anadir_nuevo_rol()"></input>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="contenedor-informacion-usuario">
                          <div id="mensaje-ayuda-usuarios">Pulse sobre el nombre de un usuario para acceder a su ficha y consultar sus datos en la empresa</div>
                          <div class="contenedor-ficha-usuario">
                            <div class="contenedor-imagen-perfil">
                              <div id="imagen-perfil"></div>
                            </div>
                            <div class="contenedor-datos-usuario">
                              <div class="datos-usuario">
                                <div id="dato-usuario-nombre"></div>
                                <div class="dato-usuario-correo">
                                  <div id="icono-correo"></div>
                                  <div id="usuario-correo"></div>
                                </div>
                                <div class="dato-usuario-usuario">
                                  <div id="icono-usuario"></div>
                                  <div id="usuario-usuario"></div>
                                </div>
                              </div>
                            </div>
                            <div class="contenedor-datos-usuario-empresa">
                              <div class="contenedor-union-empresa">
                                <div id="union-empresa"></div>
                                <div id="ultimo-estado"></div>
                              </div>
                              <div class="contenedor-boton-eliminar-usuario">
                                <div id="contenedor-input-eliminar"></div>
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
