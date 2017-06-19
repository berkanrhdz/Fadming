<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link href="images/favicon.png" rel='shortcut icon' type='image/png'/>
        <link rel="stylesheet" type="text/css" href="css/index.css">
        <script src="js/jquery-3.2.1.min.js"></script>
        <script src="js/index.js"></script>
        <script src="js/registro.js"></script>
        <title>GricApp</title>
    </head>

    <body>
        <div class="contenedor-principal">
            <div class="contenedor-izquierdo">
                <div class="contenedor-informacion-registro">
                    <div class="titulo-informacion-registro">
                        <div id="imagen-titulo"></div>
                        <div id="texto-titulo"></div>
                    </div>
                    <div class="contenedor-informacion"></div>
                    <div class="contenedor-registro">
                        <form method="POST">
                            <div class="fila-registro">
                                <div class="inputs-nombre">
                                    <input id="nombre" name="nombre" type="text" autocomplete="off" placeholder="Nombre">
                                    <input id="apellidos" name="apellidos" type="text" autocomplete="off" placeholder="Apellidos">
                                    <input id="usuario" name="usuario" type="text" autocomplete="off" placeholder="Nombre de usuario">
                                </div>
                            </div>
                            <div class="fila-registro">
                                <div class="inputs-cuenta">
                                    <input id="correo" name="correo" type="text" autocomplete="off" placeholder="Correo electrónico">
                                    <input id="contrasena" name="contrasena" type="password" autocomplete="off" placeholder="Contraseña">
                                    <input id="repetir-contrasena" name="repetir-contrasena" type="password" autocomplete="off" placeholder="Repetir contraseña">
                                </div>
                            </div>
                            <div class="fila-registro">
                                <div class="contenedor-boton-registro">
                                    <button id="boton-registro" name="boton-registro">Registrarse</button>
                                </div>
                            </div>
                        </form>
                        <?php
                            if(isset($_POST['boton-registro'])) {
                                require("actions/registrar_usuario.php");
                            }
                        ?>
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
                                <button id="boton-iniciar-sesion" name="boton-iniciar-sesion">Iniciar sesión</button>
                            </div>
                        </form>
                        <?php
                            if(isset($_POST['boton-iniciar-sesion'])) {
                                require("actions/iniciar_sesion.php");
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="pie-pagina"></div>
    </body>
</html>