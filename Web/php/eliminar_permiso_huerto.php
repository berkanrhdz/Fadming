<?php
    require("conectar_basedatos.php");
    $codigo_huerto = $_POST['huerto'];
    $codigo_usuario = $_POST['usuario'];

    $consulta = "DELETE FROM `HUERTO_PERMISO`
                 WHERE `HUERTO_PERMISO`.`CODIGO_HUERTO` = '$codigo_huerto' AND `HUERTO_PERMISO`.`CODIGO_USUARIO` = '$codigo_usuario';";

    mysql_query($consulta);
?>
