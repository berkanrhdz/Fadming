<?php
  require("conectar_basedatos.php");

  $identificador  = 1;//$_POST['identificador'];
  $ruta_imagen    = 'empresa1.png';//$_POST['imagen'];

  $consulta_identificador = "SELECT EMPRESA
                             FROM USUARIO
                             WHERE (ID_USUARIO = '$identificador');";

  $resultado_consulta = mysql_query($consulta_identificador);
  $datos = mysql_fetch_row($resultado_consulta);
  $codigo_empresa = $datos[0];

  $foto = mysql_real_escape_string(file_get_contents($ruta_imagen));

  $consulta_imagen = "UPDATE EMPRESA
                      SET LOGO = $foto
                      WHERE (CODIGO = '$codigo_empresa');";

  mysql_query($consulta_imagen);
?>
