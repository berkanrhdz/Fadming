<?php
  require("conectar_basedatos.php");

	$nombre      = $_POST['nombre'];
	$direccion   = $_POST['direccion'];
	$poblacion   = $_POST['poblacion'];
	$cp     	   = $_POST['cp'];
  $telefono    = $_POST['telefono'];
  $contrasena  = $_POST['contrasena'];

  $clave = 'gricapp, una aplicación del futuro';
  $contrasena_encriptada = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($clave), $contrasena, MCRYPT_MODE_CBC, md5(md5($clave))));

  $consulta = "INSERT INTO `EMPRESA` (`CODIGO`, `NOMBRE`, `DIRECCION`, `POBLACION`, `CODIGO_POSTAL`, `TELEFONO`, `CONTRASENA`, `FECHA_REGISTRO`)
               VALUES (NULL, '$nombre', '$direccion', '$poblacion', '$cp', '$telefono', '$contrasena_encriptada', CURRENT_TIMESTAMP);";

	mysql_query($consulta);

  $consulta_codigo = "SELECT CODIGO
                      FROM EMPRESA
                      ORDER BY CODIGO DESC
                      LIMIT 1;";
  $resultado_consulta = mysql_query($consulta_codigo);
  $datos = mysql_fetch_array($resultado_consulta);

  if(!is_null($datos[0])) {
      $informacion[] = array('codigo'=> $datos[0]);
  }
  echo json_encode($informacion);
?>
