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
        <script src="js/plantas.js"></script>
        <script type="text/javascript" src="js/kjua-0.1.1.min.js"></script>
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
                                  <div class="contenedor-anadir-plantas">
                                    <div id="titulo-anadir-planta"></div>
                                    <div class="contenido-anadir-planta">
                                      <div class="fila-input">
                                        <select id="select-planta" name="select-planta">
                                          <option value="" disabled selected hidden>Tipo de planta</option>
                                        </select>
                                        <input id="cantidad-planta" name="cantidad-planta" type="number" placeholder="Cantidad" min="1" max="1000"></input>
                                        <input id="boton-anadir-planta" name="boton-anadir-planta" type="submit" value="Añadir"></input>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                        </div>
                        <div class="contenedor-estados-codigos">
                          <div class="contenedor-anadir-estados-planta">
                            <div class="titulo-anadir-estados-planta">Generación de códigos QR</div>
                            <div class="contenedor-mensaje-explicacion">En primer lugar, seleccione una planta y gestione los estados.
                                                                        </br><b>Finalmente genere su código QR y descárguelo.</b></div>
                            <div class="contenedor-nombre-planta-seleccionada">
                              <div id="nombre-planta-seleccionada"><div id="nombre-seleccionada"></div></div>
                            </div>
                            <div class="seleccion-estados-planta-seleccionada">
                              <div class="estados-planta-seleccionada" id="estados-planta-seleccionada"></div>
                              <div class="anadir-estados-seleccionada">
                                <div class="contenedor-selector">
                                  <select id="selector-estado" required>
                                      <option value="" disabled selected hidden>Seleccione un estado o grupo...</option>
                                      <optgroup label="Estados" id="estados-select"></optgroup>
                                      <optgroup label="Grupos" id="grupos-select"></optgroup>
                                  </select>
                                </div>
                                <div class="contenedor-botones-anadir-borrar-generar">
                                  <div class="contenedor-boton-anadir">
                                    <div id="boton-anadir">
                                      <button id="boton_anadir_estado" name="boton_anadir_estado">Añadir</button>
                                    </div>
                                  </div>
                                  <div class="contenedor-boton-borrar">
                                    <div id="boton-borrar">
                                      <button id="boton_borrar_todo" name="boton_borrar_todo">Borrar todo</button>
                                    </div>
                                  </div>
                                  <div class="contenedor-boton-generar">
                                    <div id="boton-generar">
                                      <button id="boton_generar_codigo" name="boton_generar_codigo">Generar código QR</button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="contenedor-generar-codigo-qr">
                            <div class="contenedor-mensaje-cargando-qr">
                              <div id="mensaje-cargando-qr">Generando código QR...</div>
                            </div>
                            <div class="contenedor-codigo-qr">
                              <div id="codigo-qr"></div>
                            </div>
                            <div class="contenedor-botones-imprimir">
                              <div class="contenedor-boton-descargar">
                                <div id="boton-descargar">
                                  <button id="boton_descargar_imagen" name="boton_descargar_imagen"></button>
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
