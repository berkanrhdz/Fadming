<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link href="images/favicon.png" rel='shortcut icon' type='image/png'/>
        <link rel="stylesheet" type="text/css" href="css/index.css">
        <script src="js/jquery-3.2.1.min.js"></script>
        <script src="js/index.js"></script>
        <script src="js/registro.js"></script>
        <script src="js/inicio_sesion.js"></script>
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
        <title>Fadming</title>
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
                        <div class="contenedor-imagen"></div>
                        <div class="contenedor-informacion-imagen"></div>
                        <div class="contenedor-flecha-derecha">
                            <div id="flecha-derecha"></div>
                        </div>
                    </div>
                    <div class="contenedor-registro">
                        <div class="desplegar-registrar">Regístrate</div>
                        <div class="contenedor-codigo-qr">
                            <div class="contenedor-codigo">
                                <div id="codigo-qr"></div>
                            </div>
                            <div class="contenedor-informacion-codigo">
                                <div class="contenedor-titulo-codigo">Accede al desarrollo de Fadming</div>
                                <div class="contenedor-informacion-qr">Escanea el siguiente código QR y visita el desarrollo del proyecto.
                                                                       Puedes dejarnos tus sugerencias y aquellos contenidos que crees
                                                                       que ayudará a mejorar.</div>
                            </div>
                        </div>
                        <div class="formulario-registro">
                            <div class="ocultar-registro"></div>
                            <div class="contenedor-registro-personal-empresa">
                              <div class="contenedor-datos-personales">
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
                              </div>
                              <div class="contenedor-datos-empresa">
                                <div class="contenedor-particular-empresa">
                                  <div id="boton-cliente-particular" class="boton-empresa">Particular</div>
                                  <div id="boton-cliente-empresa" class="boton-empresa">Empresa</div>
                                </div>
                                <div class="contenedor-nueva-existente">
                                  <div id="boton-empresa-nueva" class="boton-empresa">Crear una nueva empresa</div>
                                  <div id="boton-empresa-existente" class="boton-empresa">Unirme a una empresa existente</div>
                                </div>
                                <div class="contenedor-empresa-nueva">
                                  <div class="fila-empresa-nueva">
                                    <div class="input-nombre-empresa">
                                      <input id="nombre-empresa" name="nombre-empresa" type="text" autocomplete="off" placeholder="Nombre"></input>
                                      <input id="direccion" name="direccion" type="text" autocomplete="off" placeholder="Dirección"></input>
                                      <input id="telefono" name="telefono" type="text" autocomplete="off" placeholder="Teléfono"></input>
                                    </div>
                                  </div>
                                  <div class="fila-empresa-nueva">
                                    <div class="input-contrasena-empresa">
                                      <input id="poblacion" name="poblacion" type="text" autocomplete="off" placeholder="Población"></input>
                                      <input id="codigo-postal" name="codigo-postal" type="text" autocomplete="off" placeholder="Código postal"></input>
                                      <input id="contrasena-empresa" name="contrasena-empresa" type="password" autocomplete="off" placeholder="Contraseña"></input>
                                      <input id="repetir-contrasena-empresa" name="repetir-contrasena-empresa" type="password" autocomplete="off" placeholder="Repetir contraseña"></input>
                                    </div>
                                  </div>
                                </div>
                                <div class="contenedor-empresa-existente">
                                  <div class="fila-empresa-existente">
                                    <label id="label-existente">Ingrese la contraseña de la empresa</label>
                                  </div>
                                  <div class="fila-empresa-existente">
                                    <div class="input-contrasena-existente">
                                      <input id="contrasena-existente" name="contrasena-existente" type="password" autocomplete="off"></input>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="fila-registro-boton">
                            	<div class="contenedor-boton-registro">
                                    <input type="submit" name="boton-continuar-registro" id="boton-continuar-registro" value="Continuar" onclick="cambiar_registro_empresa()"></input>
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
                        <div class="input-usuario-contrasena">
                            <input id="usuario_inicio" name="usuario_inicio" type="text" autocomplete="off" placeholder="Usuario">
                            <input id="contrasena_inicio" name="contrasena_inicio" type="password" autocomplete="off" placeholder="Contraseña">
                        </div>
                        <div class="boton-inicio">
                            <input type="submit" name="boton-iniciar-sesion" id="boton-iniciar-sesion" value="Iniciar sesión"></input>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="pie-pagina"></div>
    </body>
</html>
