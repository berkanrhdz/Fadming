<?php
	session_start();
  require("conectar_basedatos.php");

  $identificador = $_SESSION['identificador'];
  $nombre        = $_POST['nombre'];
  $apellidos     = $_POST['apellidos'];
  $usuario       = $_POST['usuario'];
  $correo        = $_POST['correo'];

  $consulta = "UPDATE `USUARIO`
               SET `NOMBRE` = '$nombre', `APELLIDOS` = '$apellidos', `CORREO` = '$correo', `NOMBRE_USUARIO` = '$usuario'
               WHERE `ID_USUARIO` = '$identificador';";

	mysql_query($consulta);
?>
