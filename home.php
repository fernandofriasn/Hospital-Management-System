<?php
include "header.php";
include "config.php";
session_start();
if($_SESSION["IDUsuario"] > 0){
    $queryUsuario = "SELECT * FROM Usuario 
    WHERE Usuario.IDUsuario = " .$_SESSION["IDUsuario"] .";";
    $query = $conn->query($queryUsuario);
    if($query->num_rows){
        $arrayUtente = mysqli_fetch_array($query, MYSQLI_ASSOC);
    }
    //Informacion sobre habitacion reservada
    $infoReserv = "SELECT * FROM Reservaciones r, Medicos m 
    WHERE r.IDMedico =  m.IDMedico AND r.Confirmacion = 1 ORDER BY Diainicio;";
    $queryPren = $conn->query($infoReserv);
    $arrayPren = mysqli_fetch_all($queryPren, MYSQLI_ASSOC);

    //Informacion sobre el Medico
    $infoDottori = "SELECT * FROM Medicos m;";
    $queryInfoDottori = $conn->query($infoDottori);
    $arrayDottori = mysqli_fetch_all($queryInfoDottori, MYSQLI_ASSOC);
    
    //Informacion sobre las habitaciones
    $infoCamere = "SELECT * FROM Habitaciones c;";
    $queryInfoCamere = $conn->query($infoCamere);
    $arrayCamere = mysqli_fetch_all($queryInfoCamere, MYSQLI_ASSOC);
    ?>
    <body>
        <div class="container">
            <br>
            <div class="box">
                <h1 align="center"> 
                    Panel de Control de Usuario 
                    <img src="img/user.png" class="img-responsive center-block" height="80" width="80" alt="user"> 
                </h1>
                <h3> <?php
                    echo "&nbsp; Bienvenido " . ucfirst($arrayUtente['Username']);
                    ?>
                    <a href="logout.php" class="btn btn-primary btn-sm">
                        <span class="glyphicon glyphicon-log-out"></span> Log out
                    </a>
                </h3>
                <div id="exTab2">
                    <ul class="nav nav-tabs">
                        <li>
                            <a href="#1" data-toggle="tab"> Ver Reservas </a>
                        </li>
                        <li>
                            <a href="#2" data-toggle="tab"> Realizar Reserva </a>
                        </li>
                    </ul>

                    <div class="tab-content ">
                        <div class="tab-pane" id="1">
                            <h3> Habitaciones Reservadas  </h3>
                            <table class="table">
                                <thead class="thead-inverse">
                                    <tr>
                                        <th>ID Reserva</th>
                                        <th>Fecha inicio</th>
                                        <th>Fecha termino</th>
                                        <th>ID Habitacion</th>
                                        <th>Medico</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    for($x = 0; $x < sizeof($arrayPren); $x++){
                                        ?>
                                        <tr>
                                            <th scope="row"><?php echo $arrayPren[$x]["IDReserva"] ?></th>
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
                                        <label for="Habitaciones"> Habitaciones </label>
                                        <select name="Habitaciones" class="form-control" id="Habitaciones">
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
                                            <label for="example-date-input" class="col-xs-2 col-form-label">Dia Inicio</label>
                                            <div class="col-xs-10">
                                                <input name="DataInizio" class="form-control" type="date" value="2022-10-04" id="example-date-input">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="example-date-input" class="col-xs-2 col-form-label">Dia Fin</label>
                                            <div class="col-xs-10">
                                                <input name="DataFine" class="form-control" type="date" value="2022-10-04" id="example-date-input">
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Enviar Reserva</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <br>
                    </div>
                    <br>
                </div> <!-- container -->
            </body>

            <?php


        }
        else{
            header("location: index.php");
        }
        ?>