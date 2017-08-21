<?php
    require("conectar_basedatos.php");
    define('TRABAJADOR', 2);
    $codigo_rol = $_POST['rol'];

    $consulta = "DELETE
                 FROM `ROL`
                 WHERE `ROL`.`VALOR` = '$codigo_rol';";

    mysql_query($consulta);

    $consulta = "UPDATE USUARIO
                 SET ROL = 2
                 WHERE ((ROL IS NULL) AND (EMPRESA IS NOT NULL));";

    mysql_query($consulta);
?>
