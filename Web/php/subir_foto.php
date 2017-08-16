<?php

$binario_nombre_temporal = $_FILES['imagen']['tmp_name'];
$binario_contenido = addslashes(fread(fopen($binario_nombre_temporal, "rb"), filesize($binario_nombre_temporal)));

$informacion[] = array('respuesta'=> 'eduardo');
echo json_encode($informacion);

?>
