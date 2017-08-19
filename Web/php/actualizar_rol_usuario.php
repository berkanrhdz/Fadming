<?php
    require("conectar_basedatos.php");

    $identificador = $_POST['identificador'];
    $rol = $_POST['rol'];

    $consulta = "UPDATE `USUARIO`
                 SET `ROL`= '$rol'
                 WHERE `ID_USUARIO` = '$identificador';";

    mysql_query($consulta);
?>
