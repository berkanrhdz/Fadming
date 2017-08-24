<?php
    require("conectar_basedatos.php");
    $codigo_huerto = $_POST['huerto'];

    $consulta = "DELETE
                 FROM `HUERTO`
                 WHERE `HUERTO`.`CODIGO` = '$codigo_huerto';";

    mysql_query($consulta);
?>
