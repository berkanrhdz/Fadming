<?php
    require("conectar_basedatos.php");
    $codigo_finca = $_POST['finca'];

    $consulta = "DELETE FROM `FINCA`
                 WHERE `FINCA`.`CODIGO` = '$codigo_finca';";

    mysql_query($consulta);
?>
