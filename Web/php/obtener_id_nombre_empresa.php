<?php
  require("conectar_basedatos.php");
  define('DATOS_CORRECTO', '1');
  define('DATOS_ERROR', '-1');

  $nombre = $_POST['nombre'];
	$contrasena = $_POST['contrasena'];

  $clave = 'gricapp, una aplicación del futuro';
  $contrasena_encriptada = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($clave), $contrasena, MCRYPT_MODE_CBC, md5(md5($clave))));

	$consulta = "SELECT CODIGO
							 FROM EMPRESA
							 WHERE ((NOMBRE = '$nombre') AND (CONTRASENA = '$contrasena_encriptada'));";

	$resultado_consulta = mysql_query($consulta);
  $datos = mysql_fetch_array($resultado_consulta);

  if(!is_null($datos[0])) {
      $informacion[] = array('respuesta'=> DATOS_CORRECTO,
                             'codigo'=> $datos[0]);
  }
  else {
    $informacion[] = array('respuesta'=> DATOS_ERROR);
  }
  echo json_encode($informacion);
?>
