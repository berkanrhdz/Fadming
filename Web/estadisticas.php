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
                                  <select id="select-individual" required onchange="obtener_estadistica(this.id)">
                                    <option value="" disabled selected hidden>Seleccione una opción...</option>
                                    <?php require("php/opciones_select_simple.php"); ?>
                                  </select>
                                </div>
                                <div id="respuesta-select-individual"></div>
                              </div>
                            </div>
                          </div>
                          <div class="contenedor-estadistiscas-grupal">
                            <div id="estadisticas-grupal">
                              <div id="titulo-estadisticas-grupal">ESTADÍSTICAS MÚLTIPLES</div>
                              <div class="contenido-estadisticas-grupal"></div>
                            </div>
                          </div>
                        </div>
                        <div class="contenedor-estadisticas-graficas">
                          <div id="estadisticas-graficas">
                            <div id="titulo-estadisticas-graficas">GRÁFICAS</div>
                            <div class="contenido-estadisticas-graficas"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
    	</div>
    </body>
</html>
