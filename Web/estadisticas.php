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
        <script src="js/highcharts.js"></script>
        <script src="js/estadisticas.js"></script>
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
                    <div id="titulo-pagina">Estadísticas de Fadming</div>
                </div>
                <div class="contenedor-contenido">
                    <div class="contenedor-informacion-pagina">
                      <div class="contenedor-estadisticas-general">
                        <div class="contenedor-estadisticas-concretas">
                          <div class="contenedor-estadistiscas-individual">
                            <div id="estadisticas-individual">
                              <div id="titulo-estadisticas-individual">ESTADÍSTICAS SIMPLES</div>
                              <div class="contenido-estadisticas-individual">
                                <div class="contenedor-select-individual">
                                  <div class="contenedor-select-no-estado">
                                    <select id="select-individual" required onchange="obtener_estadistica(this.id)">
                                      <option value="" disabled selected hidden>Seleccione una opción...</option>
                                      <?php require("php/opciones_select_simple.php"); ?>
                                    </select>
                                  </div>
                                  <div class="contenedor-select-estado">
                                    <select id="select-estado-individual" required onchange="enviar_opcion_estadistica_simple(null)">
                                      <option value="" disabled selected hidden>SELECCIONE UN ESTADO...</option>
                                    </select>
                                  </div>
                                </div>
                                <div id="respuesta-select-individual"></div>
                              </div>
                            </div>
                          </div>
                          <div class="contenedor-estadistiscas-grupal">
                            <div id="estadisticas-grupal">
                              <div id="titulo-estadisticas-grupal">ESTADÍSTICAS DETALLADAS</div>
                              <div class="contenido-estadisticas-grupal">
                                <div class="contenedor-select-grupal">
                                  <div class="contenedor-select-no-estado">
                                    <select id="select-grupal" required onchange="obtener_estadistica(this.id)">
                                      <option value="" disabled selected hidden>Seleccione una opción...</option>
                                      <?php require("php/opciones_select_detalle.php"); ?>
                                    </select>
                                  </div>
                                  <div class="contenedor-select-estado">
                                    <select id="select-estado-grupal" required onchange="enviar_opcion_estadistica_detalle(null)">
                                      <option value="" disabled selected hidden>SELECCIONE UN ESTADO...</option>
                                    </select>
                                  </div>
                                </div>
                                <div id="respuesta-select-grupal">
                                  <div class="contenedor-cantidades" id="contenedor-cantidades"></div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="contenedor-estadisticas-graficas">
                          <div id="estadisticas-graficas">
                            <div id="titulo-estadisticas-graficas">GRÁFICAS</div>
                            <div class="contenido-estadisticas-graficas">
                              <div class="contenedor-nombre-grafica">
                                <div id="flecha-izquierda"></div>
                                <div class="nombre-grafica">
                                  <div class="nombre" id="nombre-grafica-1">Porcentaje de plantas finalizadas por finca</div>
                                  <div class="nombre" id="nombre-grafica-2" style="display: none">Porcentaje de plantas finalizadas por huerto</div>
                                  <div class="nombre" id="nombre-grafica-3" style="display: none">Plantas añadidas por meses</div>
                                  <div class="nombre" id="nombre-grafica-4" style="display: none">Plantas por finca respecto al total</div>
                                  <div class="nombre" id="nombre-grafica-5" style="display: none">Gráfica 5</div>
                                </div>
                                <div id="flecha-derecha"></div>
                              </div>
                              <div class="contenedor-grafica">
                                <div class="graficas">
                                  <div id="grafica"></div>
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
