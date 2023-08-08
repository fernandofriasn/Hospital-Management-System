<!DOCTYPE html>
<html lang="en">
<script src="js/jquery.min.js"></script>
<?php
include "config.php";
$IDReserva = $_GET['ID'];
$queryRechazado =  "DELETE FROM Reserva
WHERE Reserva.IDReserva = " .$IDReserva.";";
$query = $conn->query($queryRechazado);
if($query){
	?>
	<script>
		alert(" Reserva Eliminada !");
		window.location.assign("admin.php");
	</script>
	<?php
}
?>
</html>
