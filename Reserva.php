<!DOCTYPE html>
<html lang="en">
<script src="js/jquery.min.js"></script>
<?php
include "config.php";

	session_start();//da usare per fare il relocation ad admin-utente
	$user = $_SESSION["IDUsuario"];
	//variabili per query
	$Medico = $_POST['Medico'];
	$Habitacion = $_POST['Habitacion'];
	$Fechainicio = $_POST['Fechainicio'];
	$Fechatermino = $_POST['Fechatermino'];

	$queryReserva = "INSERT INTO Reservaciones (Diainicio, DiaFin, IDHabitacion, IDMedico) VALUE( '" .$Fechainicio ."','".$Fechatermino ."','" .$Habitacion."','" .$Medico."');";

	$query = $conn->query($queryReserva);
	if($query){
		?>
		<script>
			alert(" Reserva Enviada!");
	var usuario = "<?php echo $user; ?>"; 
	if(usuario != 1) window.location.assign("home.php");
	else window.location.assign("admin.php");
</script>

<?php
}
?>
</html>