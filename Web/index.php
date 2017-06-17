<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link href="images/favicon.png" rel='shortcut icon' type='image/png'/>
        <link rel="stylesheet" type="text/css" href="css/index.css">
        <title>GricApp</title>
    </head>

    <body>
        <div class="contenedor-principal">
            <div class="contenedor-izquierdo">
                <div class="contenedor-informacion-registro">
                    <div class="titulo-informacion-registro">Actualiza tu cultivo y disfruta de todas las ventajas</div>
                    <div class="contenedor-informacion"></div>
                    <div class="contenedor-registro">
                        <div class="fila-registro">
                            <div class="inputs-nombre">
                                <input id="nombre" name="nombre" type="text" placeholder="Nombre">
                                <input id="apellido1" name="apellido1" type="text" placeholder="Apellido 1">
                                <input id="apellido2" name="apellido2" type="text" placeholder="Apellido 2">
                            </div>
                        </div>
                        <div class="fila-registro">
                            <div class="inputs-datos-personales">
                                <input id="dni" name="dni" type="text" placeholder="DNI">
                                <input id="telefono" name="telefono" type="text" placeholder="Teléfono">
                                <input id="correo" name="correo" type="text" placeholder="Correo electrónico">
                            </div>
                        </div>
                        <div class="fila-registro">
                            <div class="inputs-cuenta">
                                <input id="usuario" name="usuario" type="text" placeholder="Nombre de usuario">
                                <input id="contrasena" name="contrasena" type="password" placeholder="Contraseña">
                                <input id="repetir-contrasena" name="repetir-contrasena" type="password" placeholder="Repetir contraseña">
                            </div>
                        </div>
                        <div class="fila-registro">
                            <div class="contenedor-boton-registro">
                                <button id="boton-registro" name="boton-registro">Registrarse</button>
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
                                <input id="usuario" name="usuario" type="text" placeholder="Usuario">
                                <input id="contrasena" name="contrasena" type="password" placeholder="Contraseña">
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