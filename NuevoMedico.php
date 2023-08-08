<!DOCTYPE html>
<html lang="en">
<script src="js/jquery.min.js"></script>
<?php
include "config.php";

$Nombre = $_POST['Nombre'];
$Apellido = $_POST['Apellido'];
$Nacimiento = $_POST['Nacimiento'];
$Telefono = $_POST['Telefono'];

$queryInsertMedico = "INSERT INTO Medicos (Nombre, Apellido, Dianacimiento, Telefono) VALUES ( '" .$Nombre ."','".$Apellido ."','" .$Nacimiento."','" .$Telefono."');";

$query = $conn->query($queryInsertMedico);
if($query){
	?>
	<script>
		alert(" Medico Agregado !");
		window.location.assign("admin.php");
	</script>

	<?php
}
?>
</html>