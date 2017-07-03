<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>GricApp</title>
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
    			<div id="nombre-usuario"><?php echo $_SESSION['usuario']?></div>
          <div id="icono-ajustes"><a href="ajustes.php"></a></div>
    			<div id="icono-cerrar-sesion"><a href="php/cerrar_sesion.php"></a></div>
    		</div>
    	</div>
    	<div class="contenedor-principal">
    		<div class="barra-lateral-izquierda">
    			<div class="fila-acceso" id="empresa">
            <a href="empresas.php"><div id="icono-empresa"></div><div class="nombre-acceso" id="texto-empresa">Empresas</div></a>
    			</div>
    			<div class="fila-acceso" id="usuario">
    				<div id="icono-usuario"></div><div class="nombre-acceso" id="texto-usuario">Usuarios</div>
    			</div>
    			<div class="fila-acceso" id="estado">
    				<a href="estados.php"><div id="icono-estado"></div><div class="nombre-acceso" id="texto-estado">Estados</div></a>
    			</div>
    			<div class="fila-acceso" id="finca">
    				<div id="icono-finca"></div><div class="nombre-acceso" id="texto-finca">Fincas</div>
    			</div>
    			<div class="fila-acceso" id="huerto">
    				<div id="icono-huerto"></div><div class="nombre-acceso" id="texto-huerto">Huertos</div>
    			</div>
    			<div class="fila-acceso" id="planta">
    				<div id="icono-planta"></div><div class="nombre-acceso" id="texto-planta">Plantas</div>
    			</div>
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
                                  <div id="lista">
                                      <div class="estado" id="estado-1">
                                        <div class="contenedor-nombre-estado"><div id="nombre-estado">Abono 4B57X</div></div>
                                        <div class="contenedor-descripcion-estado"><div id="descripcion-estado">Echar el abono en las raices, con un porcentaje del 30% en máquina</div></div>
                                      </div>
                                      <div class="estado" id="estado-2">
                                        <div class="contenedor-nombre-estado"><div id="nombre-estado">Cortar hojas laterales</div></div>
                                        <div class="contenedor-descripcion-estado"><div id="descripcion-estado">Echar el abono en las raices, con un porcentaje del 30% en máquina</div></div>
                                      </div>
                                      <div class="estado" id="estado-3"></div>
                                      <div class="estado" id="estado-4"></div>
                                      <div class="estado" id="estado-5"></div>
                                      <div class="estado" id="estado-6"></div>
                                      <div class="estado" id="estado-7"></div>
                                  </div>
                                </div>
                            </div>
                            <div class="contenedor-nuevo-grupos"></div>
                        </div>
                    </div>
                </div>
            </div>
    	</div>
    </body>
</html>
