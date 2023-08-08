<!DOCTYPE html>
<html lang="en">
<script src="js/jquery.min.js"></script>
<?php
	include "config.php";
	$IDReserva = $_GET['IDReservacion'];
	$queryConfirmacion =  "UPDATE Reservaciones SET Confirmacion = 1
						WHERE Reservaciones.Confirmacion = 0 AND Reservaciones.IDReservacion = " .$IDReserva.";";
	$query = $conn->query($queryConfirmacion);
	if($query){
?>
	<script>
  	alert(" Confirmacion Completada !");
	window.location.assign("admin.php");
  	</script>
<?php
}
?>
</html>