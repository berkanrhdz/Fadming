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
        <script type="text/javascript" src="js/kjua-0.1.1.min.js"></script>
        <script type="text/javascript" src="js/FileSaver.min.js"></script>
        <script type="text/javascript" src="js/zlib.js"></script>
        <script type="text/javascript" src="js/png.js"></script>
        <script type="text/javascript" src="js/jspdf.debug.js"></script>
        <script src="js/plantas.js"></script>
        <script>
          $('#empresa').css('display', 'none');
        </script>
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
                    <div id="titulo-pagina">Control de plantas y códigos QR</div>
                </div>
                <div class="contenedor-contenido">
                    <div class="contenedor-informacion-pagina">
                        <div class="contenedor-gestion-plantas">
                            <div class="gestion-plantas">
                              <div class="contenedor-titulo-plantas">Gestión de plantas</div>
                              <div class="contenedor-finca-huertos-plantas" id="contenedor-finca-huertos-plantas">
                                <div class="contenedor-seleccion-finca">
                                  <select id="selector-finca" required>
                                    <option value="" disabled selected hidden>Seleccione una finca...</option>
                                  </select>
                                </div>
                                <div class="contenedor-seleccion-huerto">
                                  <select id="selector-huerto" onchange="validar_selector_huertos()" required></select>
                                </div>
                                <div class="contenedor-mensaje-cargando"><div id="texto-cargando">Cargando...</div></div>
                                <div class="contenedor-anadir-seleccion">
                                  <div id="seleccion-plantas"></div>
                                  <div class="contenedor-anadir-gestionar">
                                    <div class="contenedor-gestionar-botones">
                                      <div class="fila-input-gestionar">
                                        <input id="boton-marcar-todo" name="boton-marca-todo" type="submit" value="Marcar todo" onclick="opciones_checkbox(1)"></input>
                                        <input id="boton-desmarcar-todo" name="boton-anadir-planta" type="submit" value="Desmarcar todo" onclick="opciones_checkbox(0)"></input>
                                        <input id="boton-eliminar-planta" name="boton-eliminar-planta" type="submit" value="Borrar" onclick="borrar_planta()"></input>
                                        <input id="boton-gestionar-planta" name="boton-gestionar-planta" type="submit" value="Gestionar estados" onclick="gestionar_estados_planta()"></input>
                                      </div>
                                    </div>
                                    <div id="titulo-anadir-planta"></div>
                                    <div class="contenido-anadir-planta">
                                      <div class="fila-input">
                                        <select id="select-planta" name="select-planta">
                                          <option value="" disabled selected hidden>Tipo de planta</option>
                                        </select>
                                        <input id="cantidad-planta" name="cantidad-planta" type="number" placeholder="Cantidad" min="1" max="1000"></input>
                                        <input id="boton-anadir-planta" name="boton-anadir-planta" type="submit" value="Añadir" onclick="anadir_planta()"></input>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                        </div>
                        <div class="contenedor-estados-codigos">
                          <div class="titulo-anadir-estados-planta">Generación de códigos QR</div>
                          <div class="contenedor-contenido-estados">
                            <div class="contenedor-mensaje-explicacion">En primer lugar, seleccione las plantas y gestione los estados.
                                                                        </br><b>Finalmente genere su código QR y descárguelo.</b></div>
                            <div class="nombre-planta-seleccionada" id="nombre-planta-seleccionada">
                              <div id="nombre-seleccionada"></div>
                            </div>
                            <div class="estados-botones-seleccionada">
                              <div id="estados-planta-seleccionada"></div>
                              <div class="contenedor-botones-gestionar">
                                <div class="contenedor-select-grupos">
                                  <div class="fila-input-estados">
                                    <select id="select-estado" required>
                                      <option value="" disabled selected hidden>Seleccione un estado o grupo...</option>
                                      <optgroup label="Estados" id="estados-select"></optgroup>
                                      <optgroup label="Grupos" id="grupos-select"></optgroup>
                                  </select>
                                  </div>
                                </div>
                                <div class="contenedor-botones">
                                  <div class="fila-input-estados">
                                    <input id="boton-anadir-estado" name="boton-anadir-estado" type="submit" value="Añadir" onclick="accion_boton_anadir_estado()"></input>
                                    <input id="boton-eliminar-todo" name="boton-eliminar-todo" type="submit" value="Borrar todo" onclick="eliminar_todo_estados()"></input>
                                    <input id="boton-generar-codigo" name="boton-generar-codigo" type="submit" value="Generar códigos QR" onclick="accion_generar_qr()"></input>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="generacion-codigos-qr">
                              <div class="contenedor-mensaje-qr">
                                <div id="mensaje-qr">Generando códigos QR...</div>
                              </div>
                              <div class="contenedor-boton-descargar">
                                <div id="boton-descargar-pdf" onclick="generar_codigos_qr()">
                                  <div id="icono-descargar"></div>
                                  <div id="texto-descargar">Descargar códigos QR</div>
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
