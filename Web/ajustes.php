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
        <script src="js/ajustes.js"></script>
    </head>

    <body>
    	<div class="barra-superior">
    		<div class="contenedor-logo"></div>
    		<div class="contenedor-informacion-usuario">
    			<div id="nombre-usuario"><?php error_reporting(0); echo $_SESSION['usuario']?></div>
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
                    <div id="titulo-pagina">Ajustes de cuenta</div>
                </div>
                <div class="contenedor-contenido">
                    <div class="contenedor-informacion-pagina">
                        <div class="contenedor-izquierdo-informacion">
                            <div class="contenedor-label">
                                <label type="text">Nombre</label>
                            </div>
                            <div class="contenedor-input">
                                <input id="nombre" name="nombre" type="text" autocomplete="off"></input>
                            </div>
                            <div class="contenedor-label">
                                <label type="text">Apellidos</label>
                            </div>
                            <div class="contenedor-input">
                                <input id="apellidos" name="apellidos" type="text" autocomplete="off"></input>
                            </div>
                            <div class="contenedor-label">
                                <label type="text">Nombre de usuario</label>
                            </div>
                            <div class="contenedor-input">
                                <input id="username" name="username" type="text" autocomplete="off"></input>
                            </div>
                            <div class="contenedor-label">
                                <label type="text">Correo electrónico</label>
                            </div>
                            <div class="contenedor-input">
                                <input id="correo" name="correo" type="text" autocomplete="off"></input>
                            </div>
                            <div class="contenedor-input">
                                <div class="contenedor-boton-actualizar">
                                    <input id="boton-actualizar" name="boton-actualizar" type="submit" value="Actualizar perfil"></input>
                                </div>
                            </div>
                        </div>
                        <div class="contenedor-derecho-informacion">
                            <div class="contenedor-foto-registro">
                                <div class="contenedor-fecha-rol">
                                    <div class="contenedor-fecha">
                                        <div class="contenedor-titulo-fecha">
                                            <div id="titulo-fecha">En Fadming desde...</div>
                                        </div>
                                        <div class="contenedor-fecha-registro">
                                            <div id="fecha-registro"></div>
                                        </div>
                                    </div>
                                    <div class="contenedor-rol">
                                        <div class="contenedor-titulo-rol">
                                            <div id="titulo-rol">Rol de usuario</div>
                                        </div>
                                        <div class="contenedor-rol-usuario">
                                            <div id="rol-usuario"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="contenedor-foto-perfil">
                                    <div id="foto-perfil"></div>
                                    <div class="contenedor-boton">
                                        <div class="contenedor-boton-foto-perfil">
                                          <form method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="MAX_FILE_SIZE" value="2000000" />
                                            <input type="file" name="imagen" id="imagen" />
                                            <input type="submit" name="subirBtn" id="subirBtn" value="Subir imagen" />
                                          </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="contenedor-cambio-contrasena">
                                <div class="contenedor-label-contrasena">
                                    <label type="text">Cambiar contraseña</label>
                                </div>
                                <div class="contenedor-boton-contrasena">
                                    <input id="nueva-contrasena" name="nueva-contrasena" type="password" placeholder="Nueva contraseña"></input>
                                    <input id="boton-cambiar-contrasena" name="boton-cambiar-contrasena" type="submit" value="Establecer nueva contraseña"></input>
                                </div>
                            </div>
                            <div class="contenedor-borrar-cuenta">
                                <div class="contenedor-mensaje-advertencia">
                                    <div id="boton-advertencia">Eliminar cuenta</div>
                                    <div id="mensaje-advertencia">Tenga en cuenta que se borrarán todos los datos almacenados y los
                                                                  registros de su empresas y fincas</div>
                                </div>
                                <div class="contenedor-boton-borrar-cuenta">
                                    <div id="boton-borrar-cuenta">
                                        <input id="boton-borrar" name="boton-borrar" type="submit" value="Borrar cuenta"></input>
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
