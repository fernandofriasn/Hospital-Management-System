<!DOCTYPE html>
<html lang="en">
<script src="js/jquery.min.js"></script>
<?php
include "config.php";

	//variabili per query
$Habitacion = $_POST['Habitacion'];
$Camas = $_POST['Camas'];

$queryInsertCamera = "INSERT INTO Habitaciones (IDHabitacion, Camas) VALUE( '" .$Habitacion ."','".$Camas."');";

$query = $conn->query($queryInsertHabitacion);
if($query){
	?>
	<script>
		alert(" Habitacion Agregada !");
		window.location.assign("admin.php");
	</script>

	<?php
}
else{
	?>
	<script>
		alert(" ERROR: Habitacion ya Existe.");
		window.location.assign("admin.php");
	</script>

	<?php
}


?>

</html>