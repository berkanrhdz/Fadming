<?php
  require("conectar_basedatos.php");
  define('PARTICULAR', '1');
  define('EMPRESA', '2');

	$nombre      = $_POST['nombre'];
	$apellidos   = $_POST['apellidos'];
	$usuario     = $_POST['usuario'];
	$correo 	   = $_POST['correo'];
  $contrasena  = $_POST['contrasena'];
  $tipo        = $_POST['tipo'];
  $empresa     = $_POST['empresa'];
  $rol         = $_POST['rol'];

  $clave = 'gricapp, una aplicación del futuro';
  $contrasena_encriptada = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($clave), $contrasena, MCRYPT_MODE_CBC, md5(md5($clave))));

  if ($tipo == PARTICULAR) {
    $consulta = "INSERT INTO `USUARIO` (`ID_USUARIO`, `NOMBRE`, `APELLIDOS`, `CORREO`, `NOMBRE_USUARIO`, `CONTRASENA`, `FECHA_REGISTRO`, `TIPO`, `EMPRESA`, `ROL`)
                 VALUES (NULL, '$nombre', '$apellidos', '$correo', '$usuario', '$contrasena_encriptada', CURRENT_TIMESTAMP, '1', NULL, NULL);";
    mysql_query($consulta);
  }
  else if ($tipo == EMPRESA) {
    $consulta = "INSERT INTO `USUARIO` (`ID_USUARIO`, `NOMBRE`, `APELLIDOS`, `CORREO`, `NOMBRE_USUARIO`, `CONTRASENA`, `FECHA_REGISTRO`, `TIPO`, `EMPRESA`, `ROL`)
                 VALUES (NULL, '$nombre', '$apellidos', '$correo', '$usuario', '$contrasena_encriptada', CURRENT_TIMESTAMP, '2', '$empresa', '$rol');";
    mysql_query($consulta);
    $consulta_codigo = "SELECT ID_USUARIO
                        FROM USUARIO
                        ORDER BY ID_USUARIO DESC
                        LIMIT 1;";
    $resultado_consulta = mysql_query($consulta_codigo);
    $datos = mysql_fetch_array($resultado_consulta);
    if(!is_null($datos[0])) {
      $consulta = "INSERT INTO `ESTADO_USUARIO` (`CODIGO_USUARIO`, `ESTADOS_REALIZADO`, `ULTIMO_ESTADO`)
                   VALUES ('$datos[0]', '0', NULL)";
      mysql_query($consulta);
    }
}

?>
