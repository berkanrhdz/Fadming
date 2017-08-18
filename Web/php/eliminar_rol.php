<?php
    require("conectar_basedatos.php");

    $codigo_rol = $_POST['rol'];

    $consulta = "DELETE
                 FROM `ROL`
                 WHERE `ROL`.`VALOR` = '$codigo_rol';";

    mysql_query($consulta);
?>
