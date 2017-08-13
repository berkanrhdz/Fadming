<?php
	@session_start();
	session_destroy();
	header("Location: http://localhost/Fadming/Web/index.php");
?>
