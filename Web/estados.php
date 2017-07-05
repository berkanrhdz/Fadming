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
                                                <input id="nombre-estado" name="nombre-estado" type="text" autocomplete="off" placeholder="Máx. 35 caracteres"></input>
                                            </div>
                                        </div>
                                        <div class="contenedor-input-descripcion">
                                            <div id="label-descripcion"><label type="text">Descripción</label></div>
                                            <div id="input-descripcion">
                                                <textarea id="descripcion-estado" name="descripcion-estado" type="text" autocomplete="off" placeholder="Máx. 150 caracteres"></textarea>
                                            </div>
                                        </div>
                                        <div class="contenedor-boton-estado">
                                            <div class="contenedor-boton">
                                                <input id="boton-nuevo-estado" name="boton-nuevo-estado" type="submit" value="Añadir estado"></input>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="boton-titulo-grupos">Añadir nuevo grupo</div>
                                    <div class="contenedor-informacion-grupos"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    	</div>
    </body>
</html>
