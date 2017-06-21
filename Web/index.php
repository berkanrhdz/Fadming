<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link href="images/favicon.png" rel='shortcut icon' type='image/png'/>
        <link rel="stylesheet" type="text/css" href="css/index.css">
        <script src="js/jquery-3.2.1.min.js"></script>
        <script src="js/index.js"></script>
        <title>GricApp</title>
    </head>

    <body>
        <div class="contenedor-principal">
        	<div class="contenedor-izquierdo">
                <div class="contenedor-informacion-registro">
                    <div class="titulo-informacion-registro">
                        <div class="contenedor-texto-titulo">Actualiza tu cultivo y disfruta de todas sus ventajas</div>
                        <div class="contenedor-android">
                            <div id="imagen-android"></div>
                            <div id="texto-android">Aplicación displonible para Android</div>
                        </div>
                    </div>
                    <div class="contenedor-informacion">
                        <div class="contenedor-flecha-izquierda">
                            <div id="flecha-izquierda"></div>
                        </div>
                        <div class="contenedor-informacion-imagen"></div>
                        <div class="contenedor-flecha-derecha">
                            <div id="flecha-derecha"></div>
                        </div>
                    </div>
                    <div class="contenedor-registro">
                        <div class="desplegar-registrar">Regístrate</div>
                        <div class="formulario-registro">
                            <div class="ocultar-registro"></div>
                            <div class="fila-registro">
                                <div class="inputs-nombre">
                                    <input id="nombre" name="nombre" type="text" autocomplete="off" placeholder="Nombre"></input>
                                    <input id="apellidos" name="apellidos" type="text" autocomplete="off" placeholder="Apellidos"></input>
                                    <input id="usuario" name="usuario" type="text" autocomplete="off" placeholder="Nombre de usuario"></input>
                                </div>
                            </div>
                            <div class="fila-registro">
	                            <div class="inputs-cuenta">
	                                <input id="correo" name="correo" type="text" autocomplete="off" placeholder="Correo electrónico"></input>
	                                <input id="contrasena" name="contrasena" type="password" autocomplete="off" placeholder="Contraseña"></input>
	                                <input id="repetir-contrasena" name="repetir-contrasena" type="password" autocomplete="off" placeholder="Repetir contraseña"></input>
	                            </div>
                            </div>
                            <div class="fila-registro-boton">
                            	<div class="contenedor-boton-registro">
                                    <input type="submit" name="boton-registro" id="boton-registro" value="Registrarme"></input>
                            	</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="contenedor-derecho">
                <div class="contenedor-login">
                    <div class="contenedor-logo"></div>
                    <div class="contenedor-inicio-sesion">
                        <form method="POST">
                            <div class="input-usuario-contrasena">
                                <input id="usuario" name="usuario" type="text" autocomplete="off" placeholder="Usuario">
                                <input id="contrasena" name="contrasena" type="password" autocomplete="off" placeholder="Contraseña">
                            </div>
                            <div class="boton-inicio">
                            	<input type="submit" name="boton-iniciar-sesion" id="boton-iniciar-sesion" value="Iniciar sesión"></input>
                            </div>
                        </form>
                        <?php
                            if(isset($_POST['boton-iniciar-sesion'])) {
                                require("php/iniciar_sesion.php");
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="pie-pagina"></div>
    </body>
</html>