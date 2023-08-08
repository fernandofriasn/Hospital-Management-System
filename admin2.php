<?php
include "header.php";
include "config.php";
session_start();
	if($_SESSION["IDUsuario"] == 1){ //Informazioni utente loggato, 1 = root
		$queryUtente = "SELECT * FROM Usuario 
    WHERE Usuario.IDUsuario = " .$_SESSION["IDUsuario"] .";";
		$query = $conn->query($queryUsuario); //manda la query al DB
		if($query->num_rows){
      $arrayUtente = mysqli_fetch_array($query, MYSQLI_ASSOC);
    }

    //Informazioni relative alle camere prenotate
    $infoPren = "SELECT * FROM Reservaciones p, Medicos d 
    WHERE p.IDMedico =  d.IDMedico AND p.Confirmacion = 1 ORDER BY Fechainicio;";
    $queryPren = $conn->query($infoPren);
    $arrayPren = mysqli_fetch_all($queryPren, MYSQLI_ASSOC);

    //Informazioni relative alle camere NON prenotate
    $infoNotPren = "SELECT * FROM Reservaciones p, Medicos d 
    WHERE p.IDMedico =  d.IDMedico AND p.Confirmacion = 0 ORDER BY Fechainicio;";
    $queryNotPren = $conn->query($infoNotPren);
    $arrayNotPren = mysqli_fetch_all($queryNotPren, MYSQLI_ASSOC);

    //Informazioni relative ai dottori
    $infoDottori = "SELECT * FROM Medicos d;";
    $queryInfoDottori = $conn->query($infoDottori);
    $arrayDottori = mysqli_fetch_all($queryInfoDottori, MYSQLI_ASSOC);
    
    //Informazioni relative alle camere
    $infoCamere = "SELECT * FROM Habitaciones c;";
    $queryInfoCamere = $conn->query($infoCamere);
    $arrayCamere = mysqli_fetch_all($queryInfoCamere, MYSQLI_ASSOC);
    ?>


    <body>
      <div class="container-fluid">
        <br>
        <div class="box">
         <h1 align="center"> 
          Panel de Control admin
          <img src="img/admin.png" class="img-responsive center-block" height="80" width="80" alt="admin"> 
        </h1>
        <h3> 
          <?php
          echo "&nbsp; Bienvenido " . ucfirst($arrayUtente['Username']);
          ?>
          <a href="logout.php" class="btn btn-primary btn-sm">
            <span class="glyphicon glyphicon-log-out"></span> Log out
          </a>
        </h3>


        <div id="exTab2">  
          <ul class="nav nav-tabs">
            <li>
              <a href="#1" data-toggle="tab"> Visualizar Reserva </a>
            </li>
            <li>
              <a href="#2" data-toggle="tab"> Solicitar Reserva </a>
            </li>
            <li>
              <a href="#3" data-toggle="tab"> Confirmar Reserva </a>
            </li>   
            <li>
              <a href="#4" data-toggle="tab"> Nuevo Doctor </a>
            </li>          
            <li>
              <a href="#5" data-toggle="tab"> Nueva Habitacion </a>
            </li>
          </ul>

          <div class="tab-content ">
            <div class="tab-pane" id="1">
             <h3> Camere prenotate. </h3>
             <table class="table table-striped">
              <thead class="thead-inverse">
                <tr>
                  <th>IDReserva</th>
                  <th>Fechainicio</th>
                  <th>Fechafin</th>
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
                    <td><?php echo $arrayPren[$x]["Fechainicio"] ?></td>
                    <td><?php echo $arrayPren[$x]["Fechafin"] ?></td>
                    <td><?php echo $arrayPren[$x]["IDHabitacion"] ?></td>
                    <td><?php echo $arrayPren[$x]["Nombre"] . " ". $arrayPren[$x]["Apellido"] ?></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>

            <div class="tab-pane" id="2">
              <form method="POST" action="ConfirmaciondeReserva.php">
                <div class="form-group">
                  <label for="Dottori"> Medico </label>
                  <select name ="Dottori" class="form-control" id="Dottori">
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
                    <label for="Camere"> Habitaciones </label>
                    <select name="Camere" class="form-control" id="Camere">
                     <?php
                     for($x = 0; $x < sizeof($arrayCamere); $x++){
                      ?>
                      <option value=<?php echo $arrayCamere[$x]["IDHabitacion"] ?>>

                        <?php echo " IDCamera ".$arrayCamere[$x]["IDHabitacion"] . " - Camas ". $arrayCamere[$x]["Camas"] ?>
                        
                      </option>
                      <?php } ?>
                    </select>  
                  </div>
                  <div class="form-group row">
                    <label for="example-date-input" class="col-xs-2 col-form-label">Dia Inicio</label>
                    <div class="col-xs-10">
                      <input name="DataInizio" class="form-control" type="date" value="2022-11-02" id="example-date-input">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="example-date-input" class="col-xs-2 col-form-label">Dia Fin</label>
                    <div class="col-xs-10">
                      <input name="DataFine" class="form-control" type="date" value="2022-11-03" id="example-date-input">
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary">Enviar Reserva</button>
                </form>
              </div>

              <div class="tab-pane" id="3">
               <h3> Camere in attesa di conferma di prenotazione. </h3>
               <table class="table table-striped">
                <thead class="thead-inverse">
                  <tr>
                    <th>IDPrenotazione</th>
                    <th>DataInizio</th>
                    <th>DataFine</th>
                    <th>IDCamera</th>
                    <th>Dottore</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  for($x = 0; $x < sizeof($arrayNotPren); $x++){
                    ?>
                    <tr>
                      <th scope="row"><?php echo $arrayNotPren[$x]["IDPrenotazione"] ?></th>
                      <td><?php echo $arrayNotPren[$x]["DataInizio"] ?></td>
                      <td><?php echo $arrayNotPren[$x]["DataFine"] ?></td>
                      <td><?php echo $arrayNotPren[$x]["IDCamera"] ?></td>
                      <td><?php echo $arrayNotPren[$x]["Nome"] . " ". $arrayNotPren[$x]["Cognome"] ?></td>
                      <td>
                        <a href="confermaPrenotazione.php?ID=<?php echo $arrayNotPren[$x]["IDPrenotazione"] ?> ">
                          <button type="submit" class="btn btn-primary"> Conferma </button>
                        </a>
                        
                        <a href="rifiutaPrenotazione.php?ID=<?php echo $arrayNotPren[$x]["IDPrenotazione"] ?> ">
                          <button type="submit" class="btn btn-danger"> Rifiuta </button>
                        </a>
                      </td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>

              <div class="tab-pane" id="4">
                <form method="POST" action="nuovoDottore.php">
                  <div class="form-group row">
                    <br>
                    <label for="Nome" class="col-xs-2 col-form-label">Nome</label>
                    <div class="col-xs-10">
                      <input class="form-control" name="Nome" type="text" id="Nome">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="Dottore-Cognome" class="col-xs-2 col-form-label"> Cognome </label>
                    <div class="col-xs-10">
                      <input class="form-control" type="text" name="Cognome" id="Dottore-Cognome">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="Dottore-Nascita" class="col-xs-2 col-form-label"> Data di nascita </label>
                    <div class="col-xs-10">
                      <input class="form-control" name="Nascita" type="date" value="2016-10-20" id="Dottore-Nascita">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="Dottore-Telefono" class="col-xs-2 col-form-label">Telefono</label>
                    <div class="col-xs-10">
                      <input class="form-control" name="Telefono" type="tel" value="30" id="Dottore-Telefono">
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary"> Inserisci nuovo Dottore </button>
                </form>
              </div>

              <div class="tab-pane" id="5">
                <form method="POST" action="nuovaCamera.php">
                  <div class="form-group row">
                    <br>
                    <label for="Camera" class="col-xs-2 col-form-label">Camera</label>
                    <div class="col-xs-10">
                      <input class="form-control" name="Camera" type="text" id="Camera">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="PostiLetto" class="col-xs-2 col-form-label">PostiLetto</label>
                    <div class="col-xs-10">
                      <input class="form-control" name="PostiLetto" type="number" value="20" id="PostiLetto">
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary"> Inserisci nuova Camera </button>
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