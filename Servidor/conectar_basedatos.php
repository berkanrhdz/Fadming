<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$databasename = "FADMING";

	// CONEXIÓN SERVIDOR
	$link = mysql_connect($servername, $username, $password);
	mysql_set_charset("utf8", $link);
	$conexion = mysql_select_db($databasename, $link);

	if($conexion == false) {
		die("No se ha podido realizar la conexión. ERROR: " . mysql_error());
	}
?>
