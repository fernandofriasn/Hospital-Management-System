<?php   
session_start(); //to ensure you are using same session
session_destroy(); //destroy the session
?>
<script>
	alert(" Cierre de Sesion Completado. ");
	window.location.assign("index.php");
</script>