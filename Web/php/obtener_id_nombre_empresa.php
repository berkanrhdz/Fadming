<?php
  require("conectar_basedatos.php");
  define('CONTRASENA_CORRECTA', '1');
  define('ERROR_CONTRASENA', '-1');

	$contrasena = $_POST['contrasena'];

  $clave = 'gricapp, una aplicación del futuro';
  $contrasena_encriptada = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($clave), $contrasena, MCRYPT_MODE_CBC, md5(md5($clave))));

	$consulta = "SELECT CODIGO, NOMBRE
							 FROM EMPRESA
							 WHERE (CONTRASENA = '$contrasena_encriptada');";

	$resultado_consulta = mysql_query($consulta);
  $datos = mysql_fetch_array($resultado_consulta);

  if(!is_null($datos[0])) {
      $informacion[] = array('respuesta'=> CONTRASENA_CORRECTA,
                             'codigo'=> $datos[0],
                             'nombre'=> $datos[1]);
  }
  else {
    $informacion[] = array('respuesta'=> ERROR_CONTRASENA);
  }
  echo json_encode($informacion);
?>
