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
        <script src="js/estados.js"></script>
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
                    <div id="titulo-pagina">Gestión de estados</div>
                </div>
                <div class="contenedor-contenido">
                    <div class="contenedor-informacion-pagina">
                        <div class="contenedor-mensaje-ayuda">Añade nuevos estados para cada una de las plantas de tu
                                                              cultivo. Puedes almacenarlas por grupos, y luego agregarlos
                                                              de forma conjunta a aquellas que tengan un tratamiento similar.</div>
                        <div class="contenedor-gestion-estados">
                            <div class="contenedor-lista-estados">
                                <div class="lista-estados">
                                  <div id="titulo-estados">Lista de estados disponibles</div>
                                  <div class="cabecera-estados">
                                      <div id="cabecera-nombre">Nombre</div>
                                      <div id="cabecera-descripcion">Descripción</div>
                                  </div>
                                  <div id="lista"></div>
                                </div>
                            </div>
                            <div class="contenedor-nuevo-grupos">
                                <div class="nuevo-grupos">
                                    <div id="boton-titulo-nuevo">Añadir nuevo estado</div>
                                    <div class="contenedor-informacion-nuevo">
                                        <div class="contenedor-input-nombre">
                                            <div id="label-nombre"><label type="text">Nombre</label></div>
                                            <div id="input-nombre">
                                                <input id="nombre_estado" name="nombre_estado" type="text" autocomplete="off" placeholder="Máx. 35 caracteres"></input>
                                            </div>
                                        </div>
                                        <div class="contenedor-input-descripcion">
                                            <div id="label-descripcion"><label type="text">Descripción</label></div>
                                            <div id="input-descripcion">
                                                <textarea id="descripcion_estado" name="descripcion_estado" type="text" autocomplete="off" placeholder="Máx. 150 caracteres"></textarea>
                                            </div>
                                        </div>
                                        <div class="contenedor-boton-estado">
                                            <div class="contenedor-boton">
                                                <input id="boton-nuevo-estado" name="boton-nuevo-estado" type="submit" value="Añadir estado"></input>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="boton-titulo-grupos">Añadir nuevo grupo</div>
                                    <div class="contenedor-informacion-grupos">
                                        <div id="mensaje-grupos-seleccion">Seleccione los estados que desea añadir al grupo</div>
                                        <div class="contenedor-grupos-seleccion" id="grupos-seleccion"></div>
                                        <div class="contenedor-input-boton-grupo">
                                          <div class="contenedor-input-nombre-grupo">
                                            <div id="input-nombre-grupo">
                                              <input id="nombre_grupo" name="nombre_grupo" type="text" autocomplete="off" placeholder="Nombre del grupo"></input>
                                            </div>
                                          </div>
                                          <div class="contenedor-boton-grupo">
                                            <div id="boton-anadir-grupo">
                                              <input id="boton_grupo" name="boton_grupo" type="submit" value="Añadir" onclick="seleccion_grupo_estados()"></input>
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
    	</div>
    </body>
</html>
