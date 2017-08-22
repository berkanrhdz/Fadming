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
        <script src="js/fincas.js"></script>
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
                    <div id="titulo-pagina">Fincas</div>
                </div>
                <div class="contenedor-contenido">
                    <div class="contenedor-informacion-pagina">
                      <div class="contenedor-slide-anadir-finca">
                        <div class="contenedor-slide-fincas">
                          <div id="slide-fincas">
                            <div id="flecha-izquierda"></div>
                            <div id="fichas-finca"></div>
                            <div id="flecha-derecha"></div>
                          </div>
                        </div>
                        <div class="contenedor-anadir-tipos-finca">
                          <div class="contenedor-anadir-finca">
                            <div id="titulo-anadir-finca">Añadir nueva finca</div>
                            <div class="anadir-finca">
                              <div class="fila-input">
                                <div id="input-nombre-finca">
                                  <input id="nombre_finca" name="nombre_finca" type="text" autocomplete="off" placeholder="Nombre de la finca"></input>
                                </div>
                              </div>
                              <div class="fila-input">
                                <div id="input-seleccionar-imagen">
                                  <input id="boton-seleccionar-imagen" name="seleccionar-imagen-finca" type="submit" value="Seleccionar imagen"></input>
                                </div>
                              </div>
                              <div class="fila-input">
                                <div id="input-boton-anadir">
                                  <input id="boton-anadir-finca" name="boton-anadir-finca" type="submit" value="Añadir finca" onclick='almacenar_finca()'></input>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="contenedor-tipos-plantas">
                            <div id="titulo-tipos-plantas"></div>
                            <div class="tipos-anadir-plantas">
                              <div id="tipos-plantas"></div>
                              <div class="contenedor-anadir-tipos">
                                <div class="fila-input-tipos">
                                  <input id="nombre_tipo" name="nombre_tipo" type="text" autocomplete="off" placeholder="Nombre del tipo"></input>
                                  <input id="boton-anadir-tipo" name="boton-anadir-tipo" type="submit" value="Añadir tipo"></input>
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
