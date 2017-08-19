<?php
    require("conectar_basedatos.php");

    $identificador = $_POST['identificador'];

    $consulta = "DELETE
                 FROM USUARIO
                 WHERE USUARIO.ID_USUARIO = '$identificador';";

    mysql_query($consulta);
?>
