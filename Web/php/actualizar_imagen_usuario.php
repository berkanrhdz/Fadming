<?php
  require("conectar_basedatos.php");

  $identificador = $_SESSION['identificador'];

  $ruta_imagen = "Fotos/1.jpg";
  $imagen = imagecreatefromjpeg($ruta_imagen); // Crear una nueva imagen a partir de un archivo o URL (.png)
	ob_start(); // Inicia el almacenamiento en el búfer de salida.
	imagepng($imagen); // Producir la salida de una imagen al navegador o a un archivo.
	$foto = ob_get_contents(); // Devolver el contenido del búfer de salida.
	ob_end_clean(); // Limpia y termina el almacenamiento en el búfer de salida.

	$foto = str_replace('##','##',mysql_escape_string($foto)); // Reemplazar carácteres.

	$consulta = "UPDATE USUARIO
               SET IMAGEN = $foto
               WHERE (ID_USUARIO = '$identificador');";

	mysql_query($consulta);
?>
