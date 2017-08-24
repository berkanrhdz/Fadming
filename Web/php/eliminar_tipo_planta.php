<?php
    require("conectar_basedatos.php");
    $codigo_tipo = $_POST['tipo'];

    $consulta = "DELETE FROM `TIPOS_PLANTA`
                 WHERE `TIPOS_PLANTA`.`CODIGO` = '$codigo_tipo';";

    mysql_query($consulta);
?>
