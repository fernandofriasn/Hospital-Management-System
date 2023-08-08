<?php
include "header.php";
include "config.php";
session_start();
	if($_SESSION["IDUsuario"] == 1){ //Informacion de inicio de sesion, 1 = root
		$queryUsuario = "SELECT * FROM Usuario 
    WHERE Usuario.IDUsuario = " .$_SESSION["IDUsuario"] .";";
		$query = $conn->query($queryUsuario); //manda la query al DB
		if($query->num_rows){
      $arrayUtente = mysqli_fetch_array($query, MYSQLI_ASSOC);
    }

    //Informacion sobre las habitaciones reservadas 
    $infoReserva = "SELECT * FROM Reservaciones r, Medicos m 
    WHERE r.IDMedico =  m.IDMedico AND r.Confirmacion = 1 ORDER BY Diainicio;";
    $queryReserva = $conn->query($infoReserva);
    $arrayReserva = mysqli_fetch_all($queryReserva, MYSQLI_ASSOC);

    //Informacion sobre las habitacion no reservadas 
    $infoNotReserva = "SELECT * FROM Reservaciones r, Medicos m 
    WHERE r.IDMedico =  m.IDMedico AND r.Confirmacion = 0 ORDER BY Diainicio;";
    $queryNotReserva = $conn->query($infoNotReserva);
    $arrayNotReserva = mysqli_fetch_all($queryNotReserva, MYSQLI_ASSOC);

    //Informacion sobre los doctores
    $infoMedico = "SELECT * FROM Medicos m;";
    $queryInfoMedico = $conn->query($infoMedico);
    $arrayInfoMedico = mysqli_fetch_all($queryInfoMedico, MYSQLI_ASSOC);
    
    //Informacion sobre las habitaciones
    $infoHabitacion = "SELECT * FROM Habitaciones h;";
    $queryInfoHabitacion = $conn->query($infoHabitacion);
    $arrayHabitacion = mysqli_fetch_all($queryInfoHabitacion, MYSQLI_ASSOC);
    ?>


    <body>
      <div class="container-fluid">
        <br>
        <div class="box">
         <h1 align="center"> 
          Panel de Control Admin
          <img src="img/admin.png" class="img-responsive center-block" height="80" width="80" alt="admin"> 
        </h1>
        <h3> 
          <?php
          echo "&nbsp; Bienvenido " . ucfirst($arrayUsuario['Username']);
          ?>
          <a href="logout.php" class="btn btn-primary btn-sm">
            <span class="glyphicon glyphicon-log-out"></span> Log out
          </a>
        </h3>


        <div id="exTab2">  
          <ul class="nav nav-tabs">
            <li>
              <a href="#1" data-toggle="tab"> Ver Reservas</a>
            </li>
            <li>
              <a href="#2" data-toggle="tab"> Solicitar Reserva </a>
            </li>
            <li>
              <a href="#3" data-toggle="tab"> Confirmar Reserva </a>
            </li>   
            <li>
              <a href="#4" data-toggle="tab"> Nuevo Medico </a>
            </li>          
            <li>
              <a href="#5" data-toggle="tab"> Nueva Habitacion </a>
            </li>
          </ul>

          <div class="tab-content ">
            <div class="tab-pane" id="1">
             <h3> Habitaciones Reservadas </h3>
             <table class="table table-striped">
              <thead class="thead-inverse">
                <tr>
                  <th>IDResevacion</th>
                  <th>Diainicio</th>
                  <th>Diafin</th>
                  <th>IDHabitacion</th>
                  <th>Medico</th>
                </tr>
              </thead>
              <tbody>
                <?php
                for($x = 0; $x < sizeof($arrayPren); $x++){
                  ?>
                  <tr>
                    <th scope="row"><?php echo $arrayPren[$x]["IDReservacion"] ?></th>
                    <td><?php echo $arrayPren[$x]["Diainicio"] ?></td>
                    <td><?php echo $arrayPren[$x]["Diafin"] ?></td>
                    <td><?php echo $arrayPren[$x]["IDHabitacion"] ?></td>
                    <td><?php echo $arrayPren[$x]["Nombre"] . " ". $arrayPren[$x]["Apellido"] ?></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>

            <div class="tab-pane" id="2">
              <form method="POST" action="Reserva.php">
                <div class="form-group">
                  <label for="Medico"> Medico </label>
                  <select name ="Medico" class="form-control" id="Medico">
                    <?php
                    for($x = 0; $x < sizeof($arrayDottori); $x++){
                      ?>
                      <option value=<?php echo $arrayDottori[$x]["IDMedico"] ?>>

                        <?php echo $arrayDottori[$x]["Nombre"] . " ". $arrayDottori[$x]["Apellido"] ?>

                      </option>
                      <?php } ?>

                    </select>
                  </div>
                  <div class="form-group">
                    <label for="Habitacion"> Habitaciones </label>
                    <select name="Habitacion" class="form-control" id="Habitacion">
                     <?php
                     for($x = 0; $x < sizeof($arrayCamere); $x++){
                      ?>
                      <option value=<?php echo $arrayCamere[$x]["IDHabitacion"] ?>>

                        <?php echo " IDHabitacion ".$arrayCamere[$x]["IDHabitacion"] . " - Camas ". $arrayCamere[$x]["Camas"] ?>
                        
                      </option>
                      <?php } ?>
                    </select>  
                  </div>
                  <div class="form-group row">
                    <label for="example-date-input" class="col-xs-2 col-form-label">Diainicio</label>
                    <div class="col-xs-10">
                      <input name="DataInizio" class="form-control" type="date" value="2022-11-02" id="example-date-input">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="example-date-input" class="col-xs-2 col-form-label">Diafin</label>
                    <div class="col-xs-10">
                      <input name="DataFine" class="form-control" type="date" value="2022-11-03" id="example-date-input">
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary">Enviar Reserva</button>
                </form>
              </div>

              <div class="tab-pane" id="3">
               <h3> Habitaciones en espera de confirmacion </h3>
               <table class="table table-striped">
                <thead class="thead-inverse">
                  <tr>
                    <th>IDReservacion</th>
                    <th>Diainicio</th>
                    <th>Diafin</th>
                    <th>IDHabitacion</th>
                    <th>Medico</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  for($x = 0; $x < sizeof($arrayNotPren); $x++){
                    ?>
                    <tr>
                      <th scope="row"><?php echo $arrayNotPren[$x]["IDReservacion"] ?></th>
                      <td><?php echo $arrayNotPren[$x]["Diainicio"] ?></td>
                      <td><?php echo $arrayNotPren[$x]["DiaFin"] ?></td>
                      <td><?php echo $arrayNotPren[$x]["IDHabitacion"] ?></td>
                      <td><?php echo $arrayNotPren[$x]["Nombre"] . " ". $arrayNotPren[$x]["Apellido"] ?></td>
                      <td>
                        <a href="ConfirmaciondeReserva.php?ID=<?php echo $arrayNotPren[$x]["IDReservacion"] ?> ">
                          <button type="submit" class="btn btn-primary"> Enviar </button>
                        </a>
                        
                        <a href="RechazarReserva.php?ID=<?php echo $arrayNotPren[$x]["IDReservacion"] ?> ">
                          <button type="submit" class="btn btn-danger"> Eliminar </button>
                        </a>
                      </td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>

              <div class="tab-pane" id="4">
                <form method="POST" action="nuevoMedico.php">
                  <div class="form-group row">
                    <br>
                    <label for="Nombre" class="col-xs-2 col-form-label">Nombre</label>
                    <div class="col-xs-10">
                      <input class="form-control" name="Nombre" type="text" id="Nombre">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="Medico-Apellido" class="col-xs-2 col-form-label"> Apellido </label>
                    <div class="col-xs-10">
                      <input class="form-control" type="text" name="Apellido" id="Medico-Apellido">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="Medico-Dianacimiento" class="col-xs-2 col-form-label"> Dia de Nacimiento </label>
                    <div class="col-xs-10">
                      <input class="form-control" name="Nascita" type="date" value="2016-10-20" id="Medico-Dianacimiento">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="Medico-Telefono" class="col-xs-2 col-form-label">Telefono</label>
                    <div class="col-xs-10">
                      <input class="form-control" name="Telefono" type="tel" value="30" id="Medico-Telefono">
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary"> Insertar nuevo Medico </button>
                </form>
              </div>

              <div class="tab-pane" id="5">
                <form method="POST" action="NuevoCuarto.php">
                  <div class="form-group row">
                    <br>
                    <label for="Habitacion" class="col-xs-2 col-form-label">Habitacion</label>
                    <div class="col-xs-10">
                      <input class="form-control" name="Habitacion" type="text" id="Habitacion">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="Camas" class="col-xs-2 col-form-label">Camas</label>
                    <div class="col-xs-10">
                      <input class="form-control" name="Camas" type="number" value="20" id="Camas">
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary"> Insertar Nueva Habitacion </button>
                </form>
              </div>

              <br>
            </div>
          </div>

        </div>
        <br>
      </div>
    </body>

    <?php


  }

  else{
   header("location: index.php");
 }
 ?>