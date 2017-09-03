<?php
    require("conectar_basedatos.php");
    $codigo_estado = $_POST['estado'];

    $consulta = "DELETE FROM `ESTADO`
                 WHERE `ESTADO`.`CODIGO` = '$codigo_estado';";

    mysql_query($consulta);
?>
