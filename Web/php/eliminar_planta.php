<?php
    require("conectar_basedatos.php");
    $codigo_planta = $_POST['planta'];

    $consulta = "DELETE FROM `PLANTA`
                 WHERE `PLANTA`.`CODIGO` = '$codigo_planta';";

    mysql_query($consulta);
?>
