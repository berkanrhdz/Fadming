<?php
	@session_start();
	session_destroy();
	header("Location: http://localhost/GricApp/Web/index.php");
?>